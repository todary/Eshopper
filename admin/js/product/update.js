$(function()
{
	console.log("hereeeeeeeeeeee");

	// var x=$('#sel1').val();
var id_categories; // public id
var id_subcategorie
var id_product
var id_subcategorie_update
$('body').on('click','.choice_cat',function() 
{
		// $("#data").show();
		id_categories=$('#sel1').val();
		var mydiv = document.getElementById("div_show");
			var obj_show = new XMLHttpRequest();
			obj_show.onreadystatechange = function() 
			{
				if(obj_show.readyState == 4 &&  obj_show.status == 200)
				{
					// console.log("sssssssss");
					 // console.log(obj_show.responseText);
					 // console.log("sssssssss");
					 
					 // console.log(obj_show.responseText);
					var reslut =JSON.parse(obj_show.responseText);
					console.log(reslut);
					 console.log("sssssssss");
					 if(reslut.data !== 'categories not found')
					 {

						// document.getElementById('names').innerHTML=obj_show.responseText;
						// console.log("ssss");
						var HTMLtxt = '<div class="form-group">';
							HTMLtxt +=' <label for="sel2">Select Sub Categorie:</label>';
							HTMLtxt +='<select class="form-control choice_subcat" id="sel2">';

						$.each (reslut.data,function (index, value)
						{
							HTMLtxt +="<option value="+value.id+">"+value.name+"</option>";

						});
							
						 HTMLtxt +='</select>';
						 mydiv.innerHTML = HTMLtxt;

						 // $('divshow').html("HTMLtxt");
					}

					else
					{
						mydiv.innerHTML ='<h4>sorry you dont have sub categories in this categorie </h4>';
					}
				}
			};
			obj_show.open("GET","http://localhost/Eshopper/server/categorie.php?parent="+id_categories+"",true);
			obj_show.send();



	
});

$('body').on('click','.choice_subcat',function() 
{
	id_subcategorie=$('#sel2').val();

	/*****************************************************************/
	show();

		

	/*****************************************************************/




});


function show()
{

	var mydiv = document.getElementById("div_product");
			var obj_product = new XMLHttpRequest();
			obj_product.onreadystatechange = function() 
			{
				if(obj_product.readyState == 4 &&  obj_product.status == 200)
				{
					
					var reslut =JSON.parse(obj_product.responseText);
					console.log(reslut);
					 console.log("sssssssss");
					 if(reslut.data !== 'categories not found')
					 {


					 	var HTMLtxt = '<table class="center_table table table-bordered table-hover table-striped">';
					 
						HTMLtxt +='<tr>';
						HTMLtxt +='<th>name</th>';
						HTMLtxt +='<th>des_product</th>';
						HTMLtxt +='<th>quantity</th>';
						HTMLtxt +='<th>price</th>';
						HTMLtxt +='<th>image</th>';
						HTMLtxt +='<th>Delete</th>';	
						HTMLtxt +='<th>Update</th>';
						HTMLtxt +='</tr>';
						$.each (reslut.data,function (index, value)
						{
							HTMLtxt +='<tr>';
							HTMLtxt +='<td>'+value.name+'</td>';
							HTMLtxt +='<td>'+value.des_product+'</td>';
							HTMLtxt +='<td>'+value.quantity+'</td>';
							HTMLtxt +='<td>'+value.price+'</td>';
							// HTMLtxt +='<td>'+value.image+'</td>';
							
							HTMLtxt +='<td class="imag_hover"><img style="width: 50%;"   src="'+value.image+'" alt=""></td>';
							// HTMLtxt +='<td><img src="../../image/categories/subcat/as.jpg" alt=""></td>';

							HTMLtxt +="<td><input type='button' value='delete' class='deleterow btn btn-primary ' data-rowid='"+value.id+"'/></td>";
							HTMLtxt +="<td><input type='button' value='update' class='updaterow btn btn-primary ' data-rowid='"+value.id+"'/></td>";			        
							HTMLtxt +='</tr>';

						});
							
						 HTMLtxt +='</table>';
						 mydiv.innerHTML = HTMLtxt;

				
					}

					else
					{
						mydiv.innerHTML ='<h4>sorry you dont have product in this sub categories </h4>';
					}
				}
			};
			obj_product.open("GET","http://localhost/Eshopper/server/product.php?cat_id="+id_subcategorie+"",true);
			obj_product.send();

}




$('body').on('click','.updaterow',function() 
{
	update_mydiv=document.getElementById('data');
	console.log(update_mydiv);
	var row_id = $(this).data('rowid');
	id_product=row_id;
	console.log(row_id);
	var _update = new XMLHttpRequest();
		_update.onreadystatechange = function() 
		{
			if(_update.readyState == 4 &&  _update.status == 200)
			{
				 // console.log(_update.responseText);
				var reslut =JSON.parse(_update.responseText);
				 // console.log(reslut);
				// document.getElementById('names').innerHTML=_update.responseText;
				console.log(reslut);
				var HTMLtxt2; 
				$.each (reslut.data,function (index, value)
				{
					HTMLtxt2='<form role="form" id="pro_data">';
                    HTMLtxt2+='<div class="form-group">';
                    HTMLtxt2+='<label class="margin_top">Product Name</label>';
                    HTMLtxt2+='<input class="form-control" id="name" name="name" value="'+value.name+'" placeholder="Product Name">';
                    HTMLtxt2+='<label class="margin_top">Descraption</label>';
                    HTMLtxt2+='<textarea class="form-control" id="Des"  name="des_product" rows="3">'+value.des_product+'</textarea>';
                    HTMLtxt2+='<label class="margin_top">Quantity</label>';
                    HTMLtxt2+='<input type="number" class="form-control" id="quantity" name="quantity" value="'+value.quantity+'" placeholder="Product Name">';
                    HTMLtxt2+='<label class="margin_top">Price</label>';
                    HTMLtxt2+='<input type="number" class="form-control" id="price" name="price" value="'+value.price+'" placeholder="Product Name">';
                    HTMLtxt2+='<label  class="margin_top">Image</label>';
                    HTMLtxt2+='<input type="file" class="margin_top" id="image" name="image[]" />';
                    HTMLtxt2+='<button type="button" id="add_pro" class="btn btn-primary margin_top ">Done</button>';
                    HTMLtxt2+='</div>' ;
                    HTMLtxt2+='</form>';
                    id_subcategorie_update=value.cat_id;

				});
					
				 update_mydiv.innerHTML = HTMLtxt2;

				 // $('divshow').html("HTMLtxt");
			}
		};
		_update.open("GET","http://localhost/Eshopper/server/product.php?id="+row_id+"",true);
		_update.send();




});



$('body').on('click','#add_pro',function()
	{
		update_mydiv=document.getElementById('data');

		var product = new FormData();
		console.log($("#pro_data").serializeArray());
		$.each($("#pro_data").serializeArray(),function(index,value)
		{

			product.append(""+value.name+"",""+value.value+"");

		});
		product.append("_method","put");
		

		var upload_imag=document.getElementById("image");
		product.append("image[]",upload_imag.files[0]);
	

		$.ajax
		({
			url: 'http://localhost/Eshopper/server/product.php?id='+id_product+'&cat_id='+id_subcategorie_update+'',
			type: 'POST',
			data :product,
			processData: false,  // tell jQuery not to process the data
  			contentType: false,
		    success: function(data)
		    {

		       console.log(data);
		      
		    }
		   
		});

		 update_mydiv.innerHTML = "";

		 show();
	
	});



$('body').on('click','.deleterow',function() 
	{
		var row_id = $(this).data('rowid');
		var bool=true;
		var delete_cat = new XMLHttpRequest();
		delete_cat.onreadystatechange = function() 
		{
			if(delete_cat.readyState == 4 &&  delete_cat.status == 200)
			{
				console.log("dddd");
				var reslut =JSON.parse(delete_cat.responseText);
				console.log(reslut);


			}

		}
		delete_cat.open("POST","http://localhost/Eshopper/server/product.php?id="+row_id+"",true);
		delete_cat.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		delete_cat.send("_method=delete");


		show();

	});







});