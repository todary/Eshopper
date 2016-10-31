<?php 
	
	include("../classes/product.php");

	
	class product_server 
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
			$pro = new Product ($_GET['id']);

			$name_img = $_FILES['image']['name'][0];
			$type_img = $_FILES['image']['type'][0];
			$tmp_name_img = $_FILES['image']['tmp_name'][0];
			$id=$pro->getmaxid();
			// mkdir($id);file:///var/www/html/Eshopper/admin/image/categories/subcat/as.jpg
			
			move_uploaded_file($tmp_name_img,"/var/www/html/Eshopper/admin/image/categories/subcat/".$name_img);
			$defolt_path="http://localhost/Eshopper/admin/image/categories/subcat/";
			$image_pathe=$defolt_path."/$name_img";

			$pro->id = $_GET['id'];
			$pro->name = $_POST['name'];
			$pro->des_product = $_POST['des_product'];
			$pro->quantity = $_POST['quantity'];
			$pro->price = $_POST['price'];
			$pro->image = $image_pathe;
			// $pro->image = $_POST['image'];
			$pro->cat_id = $_GET['cat_id'];

			$pro->update();


		}else if($_POST['_method']=='delete') {
			$pro = new Product ($_GET['id']);
			$pro->delete();
			$rest = new product_server;
			$rest->handle_response('Deleted',400);
			// $response['data'] = 'Deleted';
			// $response['status'] = 'Bad Request';
			// $json_response = json_encode($response);
			// echo $json_response;

		}
	} 
	else 
	{
		if (isset($_POST['search']))
		{
			$pro = new Product ;
			$data = $pro->search_by_price($_POST['start'],$_POST['end']) ;
			if(count($data)>0) 
			{
				$response['data'] = $data;
				$rest = new product_server;
				$rest->handle_response($response['data'],200);	
				
			} 
			else
			{
				$rest = new product_server;
				$response['data'] = 'Product not found';
				$rest->handle_response($response['data'],400);		
			}

		}

		else
		{
			//insert action
			$pro = new Product ;
			/************************/

			$name_img = $_FILES['image']['name'][0];
			$type_img = $_FILES['image']['type'][0];
			$tmp_name_img = $_FILES['image']['tmp_name'][0];
			$id=$pro->getmaxid();
			// mkdir($id);file:///var/www/html/Eshopper/admin/image/categories/subcat/as.jpg
			
			move_uploaded_file($tmp_name_img,"/var/www/html/Eshopper/admin/image/categories/subcat/".$name_img);
			$defolt_path="http://localhost/Eshopper/admin/image/categories/subcat/";
			$image_pathe=$defolt_path."/$name_img";
			/************************/
			
				// print_r($_POST);	
			$pro->name = $_POST['name'];
			$pro->des_product = $_POST['des_product'];
			$pro->quantity = $_POST['quantity'];
			$pro->price = $_POST['price'];
			$pro->image = $image_pathe;
			$pro->cat_id = $_GET['cat_id'];
			print_r($pro);
			$pro->id = $pro->insert();	
			
			if($pro->id>0) 
			{
				// $status=200;
				
				$response['data'] = array('pro_id'=>$pro->id);
				$rest = new product_server;
				$rest->handle_response($response['data'],200);	

				// $response['status'] = 'OK';
				// $json_response = json_encode($response);
				// echo $json_response;

				
			}
		}

	}

	//get user either with id or all
} else if($_method=='GET') {
	// get user with a specific id
	if(isset($_GET['id'])) {
		$pro  =new Product ($_GET['id']);
		if(isset($pro->id)) {
			$pro = array('name'=>$pro->name,
						'des_product'=>$pro->des_product,
						'quantity'=>$pro->quantity,
						'price'=>$pro->price,
						'image'=>$pro->image,
						'cat_id'=>$pro->cat_id,
						'id'=>$pro->id
						);
			$response['data']=array('cat'=>$pro);
			$rest = new product_server;
			$rest->handle_response($response['data'],200);	
			// $response['data']=array('user'=>$pro);
			// $response['status'] = 'OK';
		} else {

			$response['data'] = 'Product not found';
			$rest = new product_server;
			$rest->handle_response($response['data'],400);	

			// $response['data'] = 'user not found';
			// $response['status'] = 'Bad Request';
		}
		
		// $json_response = json_encode($response);
		// echo $json_response;

	} 
	else
	 {	
		// get all users
		
	 	if (isset($_GET['cat_id']))
	 	{
	 		$cat = new Product ;
			$data = $cat->get_product_sub($_GET['cat_id']) ;
			$rest = new product_server;	

			if(count($data)>0) 
			{
				$response['data'] = $data;
				
				$rest->handle_response($response['data'],200);	
				
				// $response['status']='OK';
				// $json_response = json_encode($response);
				// echo $json_response;
			}
			else
			{	$response['data'] = 'Product not found';
				$rest->handle_response($response['data'],400);	
			}
	 	}
	 	else
	 	{
			$pro = new Product ;
			$data = $pro->products();
			if(count($data)>0) 
			{
				$response['data'] = $data;
				$rest = new product_server;
				$rest->handle_response($response['data'],200);	
				
				// $response['status']='OK';
				// $json_response = json_encode($response);
				// echo $json_response;
			} 
		}


	}
}
$url = "http://localhost".$_SERVER['REQUEST_URI'];










 ?>