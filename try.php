<?php 
	include("classes/product.php");
	$pro = new Product ;
	$x=$pro->getmaxid();
 	echo "ssssssssssssss";
 	echo "<h1>ddddddd</h1>";

 	print_r($x);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript">
	// 	$(function(){
	// 		$("#submit").click(function(){
	// 			var fd = new FormData();
				
	// 			$.each($("form").serializeArray(),function(index,value){
					
	// 				var obj=$(this)[0];
	// 				console.log(obj);
	// 				console.log(obj.name);
	// 				console.log(obj.value);
	// 				fd.append("'"+obj.name+"'","'"+obj.value+"'");
	// 			});
	// 			var upload_element=document.getElementById("file_input");
	// 			fd.append("file[]",upload_element.files[0]);
	// 			console.log("aaaaaaaaaaaa");
	// 			console.log(fd);
	// 			$.ajax({
	// 			  url: 'http://localhost/Eshopper/server/select_all_subcat.php',
	// 			  type: "POST",
	// 			  data: fd,
	// 			  processData: false,  // tell jQuery not to process the data
 //  					contentType: false,   // tell jQuery not to set contentType
	// 			  success:function(data){
	// 		  		console.log(data);
	// 			  }
	// 			});
	// 			return false;
	// 		});
			
	// 	});
	 </script>
<body>
<form enctype="multipart/form-data" method="post" name="fileinfo">
  <!-- <label>Your email address:</label>
  <input type="email" autocomplete="on" autofocus name="userid" placeholder="email" required size="32" maxlength="64" /><br />
  <label>Custom file label:</label>
  <input type="text" name="filelabel" size="12" maxlength="32" /><br />
  <label>File to stash:</label>
  <input type="file" id="file_input" name="file[]" required />
		  <input id="submit" type="submit" value="Stash the file!" /> -->
</form>
</body>
</html>
