$(function()
{
	console.log("hereeeeeeeeeeee");

var id_categories; // public id
	$('body').on('click','.choice_cat',function() 
	{
			// $("#data").show();
			id_categories=$('#sel1').val();
			
show();
			
			/**********************************/




			/*****************************************/



		
	});
	function show()
	{
		
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
						var HTMLtxt = '<table class="center_table table table-bordered table-hover table-striped">';
						 
						HTMLtxt +='<tr>';
						HTMLtxt +='<th>id</th>';
						HTMLtxt +='<th>number</th>';
						HTMLtxt +='<th>name</th>';
						HTMLtxt +='<th>Descraption</th>';
						HTMLtxt +='<th>Delete</th>';
						HTMLtxt +='<th>Update</th>';
						HTMLtxt +='</tr>';
						$.each (reslut.data,function (index, value)
						{
							HTMLtxt +='<tr>';
							HTMLtxt +='<td>'+value.id+'</td>';
							HTMLtxt +='<td>'+value.number+'</td>';
							HTMLtxt +='<td>'+value.name+'</td>';
							HTMLtxt +='<td>'+value.des+'</td>';
							HTMLtxt +="<td><input type='button' value='delete' class='deleterow btn btn-primary ' data-rowid='"+value.id+"'/></td>";
							HTMLtxt +="<td><input type='button' value='update' class='updaterow btn btn-primary ' data-rowid='"+value.id+"'/></td>";			        
							HTMLtxt +='</tr>';

						});
							
						 HTMLtxt +='</table>';
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


	}

	





$('body').on('click','.updaterow',function() 
{
	update_mydiv=document.getElementById('div_updete');
	console.log(update_mydiv);
	var row_id = $(this).data('rowid');
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

					HTMLtxt2='<h2>Form update</h2>'; 
					HTMLtxt2+='<form role="form">';
                    HTMLtxt2+='<div class="form-group">';
                    HTMLtxt2+='<label class="margin_top">Number Categorie</label>';
                    HTMLtxt2+='<input class="form-control" id="number" placeholder="Number Categorie" value="'+value.number+'"/>';
                    HTMLtxt2+='<input type="hidden"  id="id_cat" placeholder="Number Categorie" value="'+row_id+'"/>';
                    HTMLtxt2+='<label class="margin_top">Categorie Name</label>';
                    HTMLtxt2+='<input class="form-control" id="name" placeholder="Categorie Name" value="'+value.name+'"/>';
                    HTMLtxt2+='<label class="margin_top">Descraption</label>';
                    HTMLtxt2+='<textarea class="form-control" id="Des" rows="3" >'+value.des+'</textarea>';
                    HTMLtxt2+='<button type="button" id="update_cat" class="btn btn-primary margin_top ">Update</button>';
                    HTMLtxt2+='</div>';
                   	HTMLtxt2+='</form>';


				});
					
				 update_mydiv.innerHTML = HTMLtxt2;

				 // $('divshow').html("HTMLtxt");
			}
		};
		_update.open("GET","http://localhost/Eshopper/server/categorie.php?id="+row_id+"",true);
		_update.send();


});



$('body').on('click','#update_cat',function()
	{

		console.log("ssss");
		var num=$("#number").val();
		var name=$("#name").val();
		var des=$("#Des").val();
		var row_id=$("#id_cat").val();
		console.log(row_id);
		var cat={};
		cat.number=num;
		cat.name=name;
		cat.des=des;
		cat.parent=id_categories;
		cat._method='put';


		$.ajax
		({
			url: "http://localhost/Eshopper/server/categorie.php?id="+row_id+"",
			type: 'POST',
			data :cat,
		    success: function(data)
		    {
		       console.log(data);
		    }
		   
		});

		update_mydiv=document.getElementById('div_updete');
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

				// if(result=='categories not found')
				// {
				// 	bool=false;
				// }
				// $.each (reslut.data,function (index, value)
				// {
				// 	console.log("qqqqqqqqqqq");
				// 	console.log(strcmp(value,'Deleted'));

					
				// });

			}

		}
		delete_cat.open("POST","http://localhost/Eshopper/server/categorie.php?id="+row_id+"",true);
		delete_cat.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		delete_cat.send("_method=delete");




		/////////////////////     Delete product    ////////////////////////////////////


		// $.ajax
		// ({
		// 	url: "http://localhost/Eshopper/server/Delete_subcate.php?id="+row_id+"",
		// 	type: 'POST',
		// 	data: '_method=delete',
		// 	  success: function(data)
		// 	    {
		// 	       console.log(data);
		// 	    }
		// });
		show();

		// if(bool)
		// {
			
		// }
		
		// else
		// {
		// 	var mydiv = document.getElementById("div_show");
		// 	mydiv.innerHTML = "";
		// }


	});


























});