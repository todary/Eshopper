<?php 
	
	class Users 
	{
		var $id;
		var $name;
		var $birthday;
		var $job;
		var $address;
		var $username;
		var $email;
		var $password;
		var $credit;
		var $image;
		var $type;
		private static $conn = Null;

		function __construct($id=-1)
		{
			if(self::$conn == Null) 
			{
				self::$conn = mysqli_connect('localhost','root','root','Commerce');
			}
			
			if($id!=-1) 
			{
				$query = "select * from users where id=$id limit 1";
				$result = mysqli_query(self::$conn,$query);
				$user = mysqli_fetch_assoc($result);
				$this->id = $user['id'];
				$this->name = $user['name'];
				$this->birthday = $user['birthday'];
				$this->job = $user['job'];
				$this->address = $user['address'];
				$this->username = $user['username'];
				$this->email = $user['email'];
				$this->password = $user['password'];
				$this->credit = $user['credit'];
				$this->image = $user['image'];
				$this->type = $user['type'];
			}

				
		}

		function insert() 
		{
			$query = "insert into users(name,birthday,job,address,username,email,password,credit,image) values('$this->name','$this->birthday','$this->job','$this->address','$this->username','$this->email','$this->password','$this->credit','$this->image','$this->type')";
			$result  = mysqli_query(self::$conn,$query);
			return mysqli_insert_id(self::$conn);
		}	

		function update()
		{
			$query = "update users set name='$this->name',birthday='$this->birthday',job='$this->job',address='$this->address',username='$this->username',email='$this->email',password='$this->password',credit='$this->credit',image='$this->image' where id='$this->id'";
			mysqli_query(self::$conn,$query);
		}

		function update_credit()
		{
			$query = "update users set credit='$this->credit' where id='$this->id'";
			mysqli_query(self::$conn,$query);
		}


		function updateWithId($id) 
		{
			$query = "update users set name='$this->name',birthday='$this->birthday',job='$this->job',address='$this->address',username='$this->username',email='$this->email',password='$this->password',credit='$this->credit',image='$this->image' where id='$this->id'";
			mysqli_query(self::$conn,$query);
		}

		function delete() 
		{
			$query = "delete from users where id=$this->id";
			mysqli_query(self::$conn,$query);
		}

		

		function if_exist($email) 
		{
			$query = "select id from users where email='$email'";
			$result = mysqli_query(self::$conn,$query);
			return (mysqli_num_rows($result)>0)?True:False ;
		}

		function users() 
		{
			$query = "select * from users";
			$result = mysqli_query(self::$conn,$query);
			$data = [];

			while($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}
			return $data;
		}


		function getUser($email,$password) 
		{
			$query = "select * from users where email='$email' and password='$password' limit 1";
			$result = mysqli_query(self::$conn,$query);
			$user = mysqli_fetch_assoc($result);
			$this->id = $user['id'];
			$this->name = $user['name'];
			$this->password = $user['password'];
			$this->email = $user['email'];
		}

		function checkBeforeLogin($email,$password) 
		{
			$query = "select id from users where email='$email' and password='$password'";
			$result = mysqli_query(self::$conn,$query);
			return (mysqli_num_rows($result)>0)?True:False ;
		}
	
		function get_id($email,$password) 
		{
			$query = "select id from users where email='$email' and password='$password'";
			$result = mysqli_query(self::$conn,$query);
			$data = mysqli_fetch_assoc($result);
			foreach ($data as $key => $value) 
			{
				return $value;
			}
		}

		function check_admin($email,$password)
		{
			$query = "select type from users where email='$email' and password='$password'";
			$result = mysqli_query(self::$conn,$query);
			$data = mysqli_fetch_assoc($result);
			foreach ($data as $key => $value) 
			{
				return $value;
			}

		}


	}



 ?>