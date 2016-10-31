$(function()
{
	console.log("hereeeeeeeeeeee");


// var namee=document.getElementsByName("idd");
// console.log(namee[0].value);
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
					 // console.log(obj_show.responseText);
					var reslut =JSON.parse(obj_show.responseText);
					console.log(reslut);
					
					 

					// document.getElementById('names').innerHTML=obj_show.responseText;
					// console.log("ssss");
					
					var HTMLtxt = '<table class="center_table table table-bordered table-hover table-striped">';
					 
					HTMLtxt +='<tr>';
					HTMLtxt +='<th>id</th>';
					HTMLtxt +='<th>name</th>';
					HTMLtxt +='<th>birthday</th>';
					HTMLtxt +='<th>job</th>';
					HTMLtxt +='<th>address</th>';
					HTMLtxt +='<th>username</th>';
					HTMLtxt +='<th>email</th>';
					HTMLtxt +='<th>password</th>';
					HTMLtxt +='<th>credit</th>';
					HTMLtxt +='<th>image</th>';
					HTMLtxt +='<th>type</th>';
					HTMLtxt +='<th>Delete</th>';
					HTMLtxt +='<th>Update</th>';
					HTMLtxt +='</tr>';
					$.each (reslut.data,function (index, value)
					{
						HTMLtxt +='<tr>';
						HTMLtxt +='<td>'+value.id+'</td>';
						HTMLtxt +='<td>'+value.name+'</td>';
						HTMLtxt +='<td>'+value.birthday+'</td>';
						HTMLtxt +='<td>'+value.job+'</td>';
						HTMLtxt +='<td>'+value.address+'</td>';
						HTMLtxt +='<td>'+value.username+'</td>';
						HTMLtxt +='<td>'+value.email+'</td>';
						HTMLtxt +='<td>'+value.password+'</td>';
						HTMLtxt +='<td>'+value.credit+'</td>';
						HTMLtxt +='<td>'+value.image+'</td>';
						HTMLtxt +='<td>'+value.type+'</td>';
						HTMLtxt +="<td><input type='button' value='delete' class='deleterow btn btn-primary ' data-rowid='"+value.id+"'/></td>";
						HTMLtxt +="<td><input type='button' value='update' class='updaterow btn btn-primary ' data-rowid='"+value.id+"'/></td>";			        
						HTMLtxt +='</tr>';

					});
						
					 HTMLtxt +='</table>';
					 mydiv.innerHTML = HTMLtxt;
					
					 // $('divshow').html("HTMLtxt");
				}
			};
			obj_show.open("GET","http://localhost/Eshopper/server/user.php",true);
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




	                        HTMLtxt2+='<label class="margin_top">Name</label>';
	                        HTMLtxt2+='<input class="form-control" id="name" placeholder="Name" value="'+value.name+'"/>';
	                        HTMLtxt2+='<input type="hidden"  id="id_user"  value="'+row_id+'"/>';
	                        HTMLtxt2+='<label class="margin_top">Birthday</label>';
	                        HTMLtxt2+='<input type="data" class="form-control" id="birthday" placeholder="birthday" value="'+value.birthday+'"/>';
	                        HTMLtxt2+='<label class="margin_top">Job</label>';
	                        HTMLtxt2+='<input class="form-control" id="job" placeholder="job" value="'+value.job+'"/>';
	                        HTMLtxt2+='<label class="margin_top">Address</label>';
	                        HTMLtxt2+='<input class="form-control" id="address" placeholder="address" value="'+value.address+'"/>';
							HTMLtxt2+='<label class="margin_top">username</label>';
	                        HTMLtxt2+='<input class="form-control" id="username" placeholder="username" value="'+value.username+'"/>';
	                        HTMLtxt2+='<label class="margin_top">email</label>';
	                        HTMLtxt2+='<input class="form-control" id="email" placeholder="email" value="'+value.email+'"/>';
	                        HTMLtxt2+='<label class="margin_top">Password</label>';
	                        HTMLtxt2+='<input class="form-control" id="password" placeholder="password" value="'+value.password+'"/>';               
	                        HTMLtxt2+='<label class="margin_top">Credit</label>';
	                        HTMLtxt2+='<input type="number" class="form-control" id="credit" placeholder="credit" value="'+value.credit+'"/>';
	                        // HTMLtxt2+='<label class="margin_top">image</label>';
	                        // HTMLtxt2+='<input class="form-control" id="image" placeholder="image" value="'+value.image+'"/>';
	                      	HTMLtxt2+='<label class="margin_top">Type</label>';
	                        HTMLtxt2+='<input class="form-control" id="type" placeholder="type" value="'+value.type+'"/>';
	                      
	                        HTMLtxt2+='<button type="button" id="update_user" class="btn btn-primary margin_top ">Update</button>';

	                        HTMLtxt2+='</div>';
	                       	HTMLtxt2+='</form>';


						});
							
						 update_mydiv.innerHTML = HTMLtxt2;

						 // $('divshow').html("HTMLtxt");
					}
				};
				_update.open("GET","http://localhost/Eshopper/server/user.php?id="+row_id+"",true);
				_update.send();


		});


	show();
	$('body').on('click','#update_user',function()
	{
	
		var name=$("#name").val();
		var birthday=$("#birthday").val();
		var job=$("#job").val();
		var address=$("#address").val();
		var username=$("#username").val();
		var email=$("#email").val();
		var password=$("#password").val();
		var credit=$("#credit").val();
		// var image=$("#image").val();
		var type=$("#type").val();
		var row_id=$("#id_user").val();
		
		console.log(row_id);
		var user={};

		user.name=name;
		user.birthday=birthday;
		user.job=job;
		user.address=address;
		user.username=username;
		user.email=email;
		user.password=password;
		user.credit=credit;
		//  image=$("#image").val();
		user.type=type;
		user._method='put';

		$.ajax
		({
			url: "http://localhost/Eshopper/server/user.php?id="+row_id+"",
			type: 'POST',
			data :user,
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

				// 	console.log(strcmp(value,'Deleted'));
				// if(strcmp(value,'Deleted')==0)
				// 	{

				// 		console.log("dddd");
				// 		bool=false;
				// 	}
				// $.each (reslut.data,function (index, value)
				// {
				// 	console.log("qqqqqqqqqqq");
				// 	console.log(strcmp(value,'Deleted'));

					
				// });

			}

		}
		delete_cat.open("POST","http://localhost/Eshopper/server/user.php?id="+row_id+"",true);
		delete_cat.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		delete_cat.send("_method=delete");




		/////////////////////     Delete sub categories    ////////////////////////////////////


		$.ajax
		({
			url: "http://localhost/Eshopper/server/Delete_subcate.php?id="+row_id+"",
			type: 'POST',
			data: '_method=delete',
			  success: function(data)
			    {
			       console.log(data);
			    }
		});
		
		show();

	});


	
	

	


});