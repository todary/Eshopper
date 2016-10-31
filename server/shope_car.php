<?php 
	
	include("../classes/shope_car.php");

	
	class car_server 
	{
		
		public static $HTTP_STATUS_CODE = array(
			200=>'OK',
			400=>'Bad request',
			401=>'Unauthorized',
			403=>'Forbidden',
			404=>'Not Found',
		);


		public function handle_response($data, $code) 
		{
			$response = array();
			$response['data'] = $data;
			$response['status'] = self::$HTTP_STATUS_CODE[$code];
			header("Content-Type:application/json");
			header("HTTP:/1.1 $code self::HTTP_STATUS_CODE[$code]");
			echo json_encode($response);
			die();
		}



	}

	

	$_method = $_SERVER['REQUEST_METHOD'];



if($_method == 'POST') {

	if(isset($_POST['_method'])) {

		if($_POST['_method']=='put') {
			$product=new shope($_GET['id']);
			$product->id=$_GET['id'];
			$product->user_id = $_POST['user_id'];
			$product->product_id = $_POST['product_id'];
			$product->quantity = $_POST['quantity'];
			$product->but_not = $_POST['but_not'];
			$product->update();

		}else if($_POST['_method']=='delete') {
			$product=new shope($_GET['id']);
			$product->deleteFormCar();
			$rest = new car_server;
			$rest->handle_response('Deleted',400);
			// $response['data'] = 'Deleted';
			// $response['status'] = 'Bad Request';
			// $json_response = json_encode($response);
			// echo $json_response;

		}
		elseif ($_POST['_method']=='quantity') 
		{	
			$product=new shope($_GET['id']);
			$product->id=$_GET['id'];
			$product->quantity = $_POST['quantity'];
			$product->update_quantity();	
		}


	} else {
		//insert action

		$product = new shope;
		$product->user_id = $_POST['user_id'];
		$product->product_id = $_POST['product_id'];
		$product->quantity = $_POST['quantity'];
		$product->but_not = $_POST['but_not'];
		$product->id = $product->insert();	
		// print_r($_POST);
		if($product->id>0) {
			// $status=200;
			
			$response['data'] = array('user_id'=>$product->id);
			$rest = new car_server;
			$rest->handle_response($response['data'],200);	

			// $response['status'] = 'OK';
			// $json_response = json_encode($response);
			// echo $json_response;

			
		}	
	}


	//get user either with id or all
} else if($_method=='GET') {
	// get user with a specific id
	if(isset($_GET['id'])) {
		$user  =new Users($_GET['id']);
		if(isset($user->id)) {
			$user = array('name'=>$user->name,
						'birthday'=>$user->birthday,
						'address'=>$user->address,
						'username'=>$user->username,
						'email'=>$user->email,
						'password'=>$user->password,
						'credit'=>$user->credit,
						'image'=>$user->image,
						'id'=>$user->id
						);
			$response['data']=array('user'=>$user);
			$rest = new car_server;
			$rest->handle_response($response['data'],200);	
			// $response['data']=array('user'=>$user);
			// $response['status'] = 'OK';
		} else {

			$response['data'] = 'user not found';
			$rest = new car_server;
			$rest->handle_response($response['data'],400);	

			// $response['data'] = 'user not found';
			// $response['status'] = 'Bad Request';
		}
		
		// $json_response = json_encode($response);
		// echo $json_response;

	}
	elseif (isset($_GET['user_id'])) 
	{
		$product = new shope;
		$data=$product->count_product($_GET['user_id']);
		if(count($data)>0) 
		{
			$response['data'] = $data;
			$rest = new car_server;
			$rest->handle_response($response['data'],200);	
		} 
	} 

	else 
	{
		// get all users
		$user = new Users;
		$data = $user->users();
		if(count($data)>0) 
		{
			$response['data'] = $data;
			$rest = new car_server;
			$rest->handle_response($response['data'],200);	
			
			// $response['status']='OK';
			// $json_response = json_encode($response);
			// echo $json_response;
		} 		
	}
}
$url = "http://localhost".$_SERVER['REQUEST_URI'];










 ?>