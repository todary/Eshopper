<?php
	session_start();
	require 'classes/users.php';
	$errors = [];
	if(isset($_POST['ok'])) {
		if(!isset($_POST['email']) || empty(trim($_POST['email']))){
			$errors[] = "Please, Enter a valid email";
		}

		if(!isset($_POST['password']) || empty(trim($_POST['password'])))
		{
			$errors[] = "Please, Enter a valid password";
		} 
		else 
		{
			$user = new Users;
			$is_exist = $user->checkBeforeLogin($_POST['email'],$_POST['password']);
			
			if(!$is_exist) 
			{
				$errors[]="email or password is invalid";
			}
			else
			{
			

			}
		}

		if(!empty($errors)) 
		{
			$_SESSION['errors'] = $errors;
			echo "<meta http-equiv='Refresh' content='0;url=login.php' />"; 
		} 
		else 
		{


			$user = new Users();
			$user->getUser($_POST['email'],$_POST['password']);
			
			$_SESSION['user_id'] = $user->id;

				/*********** check admin my work  ************/
				$admin = $user->check_admin($_POST['email'],$_POST['password']);
				$result= $user->get_id($_POST['email'],$_POST['password']);

					if ($admin) 
					{
						echo "<meta http-equiv='Refresh' content='1;url=admin/index.php' />"; 
					}
					else
					{
						// $result=$user->lock_search($result);
						// foreach ($result as $key => $value) 
						// {
						// 	if ($value) 
						// 		{
						// 			$errors[]="sorry ^_^  Username and password is Lock ";
						// 		}
						// 		else
								// {
					echo "<meta http-equiv='Refresh' content='1;url=home.php' />"; 		
						// 		}	
						// }
						
					}
				

				/*********** check admin my work  ************/

			


			die();
		}




	} 
	else 
	{
		header("location:login.php");
	}
?>