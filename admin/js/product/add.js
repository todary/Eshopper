$(function()
{
	console.log("hereeeeeeeeeeee");

	// var x=$('#sel1').val();
var id_categories; // public id
var id_subcategorie
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
	$("#data").show();
	id_subcategorie=$('#sel2').val();

});



$('body').on('click','#add_pro',function() 
	{
		// console.log("todaryyyyyyy");
		// var num=$("#number").val();
		// var name=$("#name").val();
		// var des=$("#Des").val();
		// var img=$("#image").val();
		// console.log(img);


		// var product=new FormData($('#pro_data').serialize());
		var product = new FormData();
		console.log($("#pro_data").serializeArray());
		$.each($("#pro_data").serializeArray(),function(index,value)
		{

			product.append(""+value.name+"",""+value.value+"");

		});

		var upload_imag=document.getElementById("image");
		product.append("image[]",upload_imag.files[0]);
	

		$.ajax
		({
			url: 'http://localhost/Eshopper/server/product.php?cat_id='+id_subcategorie+'',
			type: 'POST',
			data :product,
			processData: false,  // tell jQuery not to process the data
  			contentType: false,
		    success: function(data)
		    {

		       console.log(data);
		       $("#data").hide();
		    }
		   
		});



		

	});








// $('body').on('click','#add_cat',function() 
// 	{
// 		console.log("ssss");
// 		var num=$("#number").val();
// 		var name=$("#name").val();
// 		var des=$("#Des").val();
// 		var subcat={};
// 		subcat.number=num;
// 		subcat.name=name;
// 		subcat.des=des;
// 		subcat.parent=id_categories;

// 		console.log(subcat);


// 		$.ajax
// 		({
// 			url: 'http://localhost/Eshopper/server/categorie.php',
// 			type: 'POST',
// 			data :subcat,
// 		    success: function(data)
// 		    {
// 		       console.log(data);
// 		    }
		   
// 		});

		
// 	});




	

	


});