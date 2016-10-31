<?php 
	
	class Categories 
	{
		var $id;
		var $number;
		var $name;
		var $des;
		var $parent;
		
		
		private static $conn = Null;

		function __construct($id=-1)
		{
			if(self::$conn == Null) 
			{
				self::$conn = mysqli_connect('localhost','root','root','Commerce');
			}
			
			if($id!=-1) 
			{
				$query = "select * from categories where id=$id limit 1";
				$result = mysqli_query(self::$conn,$query);
				$cat = mysqli_fetch_assoc($result);
				$this->id = $cat['id'];
				$this->number = $cat['number'];
				$this->name = $cat['name'];
				$this->des = $cat['des'];
				$this->parent = $cat['parent'];
				
				
			}

				
		}

		function insert() 
		{
			$query = "insert into categories(number,name,des,parent) values('$this->number','$this->name','$this->des','$this->parent')";
			$result  = mysqli_query(self::$conn,$query);
			return mysqli_insert_id(self::$conn);
		}	

		function update()
		{
			$query = "update categories set number='$this->number',name='$this->name',des='$this->des',parent='$this->parent' where id='$this->id'";
			mysqli_query(self::$conn,$query);
		}

		function updateWithId($id) 
		{
			$query = "update categories set number='$this->number',name='$this->name',des='$this->des',parent='$this->parent' where id='$this->id'";
			mysqli_query(self::$conn,$query);
		}

		function delete() 
		{
			$query = "delete from categories where id=$this->id";
			mysqli_query(self::$conn,$query);
		}

		

		// function if_exist($email) 
		// {
		// 	$query = "select id from users where email='$email'";
		// 	$result = mysqli_query(self::$conn,$query);
		// 	return (mysqli_num_rows($result)>0)?True:False ;
		// }

		function categories() 
		{
			$query = "select * from categories where parent=0 ";
			$result = mysqli_query(self::$conn,$query);
			$data = [];

			while($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}
			return $data;
		}

		function subcategories($parant) 
		{
			$query = "select * from categories where parent='$parant'";
			$result = mysqli_query(self::$conn,$query);
			$data = [];

			while($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}
			return $data;
		}

		function count_subcat($id) 
		{
			$query = "select count(id) from categories where parent='$id'";
			$result = mysqli_query(self::$conn,$query);
			$id=mysqli_fetch_assoc($result);
			return $id['count(id)'];
		}


		function getcategories($id) 
		{
			$query = "select * from categories where id='$id' limit 1";
			$result = mysqli_query(self::$conn,$query);
			$row = mysqli_fetch_assoc($result);
			return $row;
		}

		function remove_subcate($id)
		{
			$query = "delete from categories where parent='$id'";
			mysqli_query(self::$conn,$query);
		}
	
		// function get_id($email,$password) 
		// {
		// 	$query = "select id from users where email='$email' and password='$password'";
		// 	$result = mysqli_query(self::$conn,$query);
		// 	$data = mysqli_fetch_assoc($result);
		// 	foreach ($data as $key => $value) 
		// 	{
		// 		return $value;
		// 	}
		// }

	




	}



 ?>