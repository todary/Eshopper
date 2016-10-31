  <?php 
	
	include("../classes/categories.php");

	
	class categories_server 
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

// var_dump("expression");
// var_dump($_POST);
// $_POST=json_decode($_POST);
// var_dump($_POST);

if($_method == 'POST') {

	if(isset($_POST['_method'])) {

		if($_POST['_method']=='put') {
			$cat = new Categories ($_GET['id']);

			// var_dump($_GET['id']);
			$cat->id = $_GET['id'];
			$cat->number = $_POST['number'];
			$cat->name = $_POST['name'];
			$cat->des = $_POST['des'];
			$cat->parent = $_POST['parent'];
			$cat->update();
			

			


		}else if($_POST['_method']=='delete') {
			$cat = new Categories ($_GET['id']);
			$cat->delete();
			$rest = new categories_server;
			$rest->handle_response('Deleted',400);
			// $response['data'] = 'Deleted';
			// $response['status'] = 'Bad Request';
			// $json_response = json_encode($response);
			// echo $json_response;

		}
	} else {
		//insert action
		var_dump($_POST);
		$cat = new Categories ;
		$cat->number = $_POST['number'];
		// echo $cat->number;
		$cat->name = $_POST['name'];
		$cat->des = $_POST['des'];
		$cat->parent = $_POST['parent'];
		$cat->id = $cat->insert();	
		
		if($cat->id>0) {
			// $status=200;
			
			$response['data'] = array('cat_id'=>$cat->id);
			$rest = new categories_server;
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
		$cat  =new Categories ($_GET['id']);
		if(isset($cat->id)) {
			$cat = array('number'=>$cat->number,
						'name'=>$cat->name,
						'des'=>$cat->des,
						'parent'=>$cat->parent,
						'id'=>$cat->id
						);
			$response['data']=array('cat'=>$cat);
			$rest = new categories_server;
			$rest->handle_response($response['data'],200);	
			// $response['data']=array('user'=>$cat);
			// $response['status'] = 'OK';
		} else {

			$response['data'] = 'categories not found';
			$rest = new categories_server;
			$rest->handle_response($response['data'],400);	

			// $response['data'] = 'user not found';
			// $response['status'] = 'Bad Request';
		}
		
		// $json_response = json_encode($response);
		// echo $json_response;

	} 
	else 
	{
		if(isset($_GET['parent']))
		{
			$cat = new Categories ;
			$data = $cat->subcategories($_GET['parent']) ;
			$rest = new categories_server;
			if(count($data)>0) 
			{
				$response['data'] = $data;
				
				$rest->handle_response($response['data'],200);	
				
				// $response['status']='OK';
				// $json_response = json_encode($response);
				// echo $json_response;
			}
			else
			{	$response['data'] = 'categories not found';
				$rest->handle_response($response['data'],400);	
			}
		}
		else
		{
		// get all users
			$cat = new Categories ;
			$data = $cat->categories();
			if(count($data)>0) 
			{
				$response['data'] = $data;
				$rest = new categories_server;
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