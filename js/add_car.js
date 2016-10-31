$(function()
{


	$('body').on('click','.add_pro',function() 
	{
		var row_id = $(this).data('rowid');
		var user_id =$('#user_id').val();

		var obj={};
		// product.append("_method","put");
		// var obj=new object
		// obj.append("user_id",""+user_id+"");
		obj.user_id=user_id;
		obj.product_id=row_id;
		obj.quantity=1;
		obj.but_not=0;
		console.log(obj);
		 $.ajax
			({
				url: "http://localhost/Eshopper/server/shope_car.php",
				type: 'POST',
				data :obj,
			    success: function(data)
			    {
			    	console.log(data);
			    }
			   
			});

			 // mydiv.innerHTML = HTMLtxt;
		var mydiv = document.getElementById("count_car");
		console.log(mydiv);
		var obj_count={};
		obj_count.user_id=user_id;
		 $.ajax
			({
				url: "http://localhost/Eshopper/server/shope_car.php",
				type: 'GET',
				data :obj_count,
			    success: function(data)
			    {
			    	mydiv.innerHTML=data.data;

			    }
			   
			});


		
		
		// var count_product=
		// $('#count_car').innerHTML=



		// console.log(user_id);

		// var get_cat_id = new XMLHttpRequest();
		// 	get_cat_id.onreadystatechange = function() 
		// 	{
		// 		if(get_cat_id.readyState == 4 &&  get_cat_id.status == 200)
		// 		{
		// 			var reslut =JSON.parse(get_cat_id.responseText);
		// 			console.log(reslut);
		// 		}
		// 	};
		// 	get_cat_id.open("GET","http://localhost/Eshopper/server/product.php?product_id="+row_id+"",true);
		// 	get_cat_id.send();



				// $.ajax
				// ({
				// 	url: "http://localhost/Eshopper/server/product.php?id="+row_id+"",
				// 	type: 'GET',
				// 	data :{},
				//     success: function(data)
				//     {
				//        id_cat_pro=data.data.cat.cat_id;
				     

				//     }
				   
				// });




	});


	
});