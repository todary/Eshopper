<?php 

include "../classes/product.php";

print_r($_FILES);
// echo $_FILES['image']['tmp_name'][0];
echo "string";
print_r($_POST["'userid'"]);
// foreach ($_POST as $key => $value) 
// {
// 	echo $key;
// 	echo $value;	
// }

// $_method = $_SERVER['REQUEST_METHOD'];




// if($_method == 'GET') 
// {

// 	$subcat = new Categories;
// 	$id=$_GET['id'];
// 	echo $subcat->subcategories($id);
// 	// echo "string";		
// 	// echo $_GET['id'];
// }

// print_r($_POST);



		// $name_img = $_FILES['file[]']['name'];
		// $type_img = $_FILES['file[]']['type'];
		// $tmp_name_img = $_FILES['file[]']['tmp_name'];


		
		// $pro = new Product ;
		// $pro->name = $_POST['name'];
		// $pro->des_product = $_POST['Des'];
		// $pro->quantity = $_POST['Quantity'];
		// $pro->price = $_POST['price'];

		
		// $pro->id = $pro->insert();	
		
		// echo $_POST['name'];

 ?>