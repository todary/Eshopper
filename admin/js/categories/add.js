$(function()
{
	console.log("hereeeeeeeeeeee");


	function show()
	{
		
			var mydiv = document.getElementById("data");
			var obj_show = new XMLHttpRequest();
			obj_show.onreadystatechange = function() 
			{
				if(obj_show.readyState == 4 &&  obj_show.status == 200)
				{
					console.log("sssssssss");
					 console.log(obj_show.responseText);
					 console.log("sssssssss");
					 
					 // console.log(obj_show.responseText);
					var reslut =JSON.parse(obj_show.responseText);
					console.log(reslut);
					 console.log("sssssssss");
					 

					// document.getElementById('names').innerHTML=obj_show.responseText;
					// console.log("ssss");
					var HTMLtxt = '<table class="center_table table table-bordered table-hover table-striped">';
					 
					HTMLtxt +='<tr>';
					HTMLtxt +='<th>id</th>';
					HTMLtxt +='<th>number</th>';
					HTMLtxt +='<th>name</th>';
					HTMLtxt +='<th>Descraption</th>';
					HTMLtxt +='</tr>';
					$.each (reslut.data,function (index, value)
					{
						HTMLtxt +='<tr>';
						HTMLtxt +='<td>'+value.id+'</td>';
						HTMLtxt +='<td>'+value.number+'</td>';
						HTMLtxt +='<td>'+value.name+'</td>';
						HTMLtxt +='<td>'+value.des+'</td>';
						HTMLtxt +='</tr>';

					});
						
					 HTMLtxt +='</table>';
					 mydiv.innerHTML = HTMLtxt;

					 // $('divshow').html("HTMLtxt");
				}
			};
			obj_show.open("GET","http://localhost/Eshopper/server/categorie.php",true);
			obj_show.send();



		
		// $.ajax
		// ({
		// 	url: 'http://localhost/Eshopper/server/categorie.php',
		// 	type: 'GET',
		// 	data :"",
		//     success: function(data)
		//     {
		//        var reslut =JSON.parse(_ajax.responseText);
		// 			 // console.log(reslut);
		// 			// document.getElementById('names').innerHTML=_ajax.responseText;
		// 			// console.log("ssss");
		// 			var HTMLtxt = '<table class="row">';
					 
		// 			HTMLtxt +='<tr>';
		// 			HTMLtxt +='<th>id</th>';
		// 			HTMLtxt +='<th>number</th>';
		// 			HTMLtxt +='<th>name</th>';
		// 			HTMLtxt +='<th>Descraption</th>';
		// 			HTMLtxt +='</tr>';
		// 			$.each (data,function (index, value)
		// 			{

		// 				HTMLtxt +='<tr>';
		// 				HTMLtxt +='<td>'+value.id+'</td>';
		// 				HTMLtxt +='<td>'+value.number+'</td>';
		// 				HTMLtxt +='<td>'+value.name+'</td>';
		// 				HTMLtxt +='<td>'+value.des+'</td>';
		// 				HTMLtxt +='</tr>';
		// 			});
						
					


		//     }
		   
		// });




	}


	show();



	$('body').on('click','#add_cat',function() 
	{
		console.log("ssss");
		var num=$("#number").val();
		var name=$("#name").val();
		var des=$("#Des").val();
		var cat={};
		cat.number=num;
		cat.name=name;
		cat.des=des;
		cat.parent=0;


		$.ajax
		({
			url: 'http://localhost/Eshopper/server/categorie.php',
			type: 'POST',
			data :cat,
		    success: function(data)
		    {
		       console.log(data);
		    }
		   
		});


		// var add_cat = new XMLHttpRequest();
		// add_cat.onreadystatechange = function() 
		// {
		// 	if(add_cat.readyState == 4 &&  add_cat.status == 200)
		// 	{
		// 		console.log("dddd");
		// 		console.log(add_cat.responseText);
		// 	}

		// }
		// add_cat.open("POST","../server/categorie.php",true);
		// add_cat.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		// add_cat.send(cat);



		
		

			// $.ajax({
			// 	  type: "POST",
			// 	  url: '../server/categorie.php',
			// 	  data: cat,
			// 	  success: "success",
			// 	  dataType: "html"
			// 	});
			
		// $.ajax
		// ({
		//     type: 'POST',
		//     contentType: "application/json; charset=utf-8",
		//     url: '../server/categorie.php',      
		//     data :cat,
		//     success: function(data, textStatus)
		//      {
		//         if (textStatus == "success") {
		//             if (data.d == true) {
		//                 alert('New Item Added');
		//             }
		//         }
		//     },
		//     error: function(data, textStatus) 
		//     {
		//         alert('An error has occured retrieving data!');
		//     }
		// });	

			
			

		// $.ajax({
		// 	url: "../server/categorie.php",  
		// 	type: "POST",
		// 	data: cat,
		// 	success: function (response) {
		// 		//  if(response=="peace"){
		// 		// 	emailerr.html("<b>Email Available</b>");
		// 		// }else{
		// 		// 	emailerr.html("<b>EMAIL NOT Available</b>");
		// 		// }
		// 	},
		// 	error: function (error) {
		// 		console.log(error);
		// 	}
		// });






	 show();


	});

	

	


});