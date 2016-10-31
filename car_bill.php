<?php 
	session_start();
	include('classes/product.php');
	include('classes/categories.php');
	include('classes/users.php');
	include('classes/shope_car.php');
	if(isset($_SESSION['user_id'])) 
	{
		$user= new Users($_SESSION['user_id']);
		
	}
	$sum=0;
	$obj_car=new shope;
	$obj_product=new Product;

	$data=$obj_car->product_car($_SESSION['user_id']);
	// print_r($data);
	foreach ($data as $key => $value) 
	{
		// echo $value['id'];

		$obj_car->update_to_buy($value['id']);
		$sum+=($value['quantity']*$value['price']);
		$quantity=$value['total_quantity']-$value['quantity'];
		$obj_product->update_quantity($value['id_pro'],$quantity);
	}

	$user->credit=$user->credit-$sum;
	$user->update_credit();

		echo "<meta http-equiv='Refresh' content='0; url=home.php' />"; 
		// header ("Location: home.php");	



 ?>