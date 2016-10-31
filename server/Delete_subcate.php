<?php 

include "../classes/categories.php";

$_method = $_SERVER['REQUEST_METHOD'];




if($_method == 'POST') 
{

	if(isset($_POST['_method'])) 
	{
			
		if($_POST['_method']=='delete') 
		{
			$cat = new Categories;
			$id=$_GET['id'];
			$cat->remove_subcate($id);
			// echo "string";		
			// echo $_GET['id'];

		}
	}
}



 ?>