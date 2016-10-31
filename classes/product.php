<?php 
	
	class Product
	{
		var $id;
		var $name;
		var $des_product;
		var $quantity;
		var $price;
		var $image;
		var $cat_id;
		
		
		private static $conn = Null;

		function __construct($id=-1)
		{
			if(self::$conn == Null) 
			{
				self::$conn = mysqli_connect('localhost','root','root','Commerce');
			}
			
			if($id!=-1) 
			{
				$query = "select * from product where id=$id limit 1";
				$result = mysqli_query(self::$conn,$query);
				$pro = mysqli_fetch_assoc($result);
				$this->id = $pro['id'];
				$this->name = $pro['name'];
				$this->des_product = $pro['des_product'];
				$this->quantity = $pro['quantity'];
				$this->price = $pro['price'];
				$this->image = $pro['image'];
				$this->cat_id = $pro['cat_id'];
				
				
			}

				
		}

		function insert() 
		{
			$query = "insert into product(name,des_product,quantity,price,image,cat_id) values('$this->name','$this->des_product','$this->quantity','$this->price','$this->image','$this->cat_id')";
			$result  = mysqli_query(self::$conn,$query);
			return mysqli_insert_id(self::$conn);
		}	

		function update()
		{
			$query = "update product set name='$this->name',des_product='$this->des_product',quantity='$this->quantity',price='$this->price',image='$this->image',cat_id='$this->cat_id' where id='$this->id'";
			mysqli_query(self::$conn,$query);
		}

		function updateWithId($id) 
		{
			$query = "update product set name='$this->name',des_product='$this->des_product',quantity='$this->quantity',price='$this->price',image='$this->image',cat_id='$this->cat_id' where id='$this->id'";
			mysqli_query(self::$conn,$query);
		}

		function delete() 
		{
			$query = "delete from product where id=$this->id";
			mysqli_query(self::$conn,$query);
		}

		function update_quantity($id,$quantity)
		{
			$query = "update product set quantity='$quantity'where id='$id'";
			mysqli_query(self::$conn,$query);
		}

		

		// function if_exist($email) 
		// {
		// 	$query = "select id from users where email='$email'";
		// 	$result = mysqli_query(self::$conn,$query);
		// 	return (mysqli_num_rows($result)>0)?True:False ;
		// }

		function products() 
		{
			$query = "select * from product";
			$result = mysqli_query(self::$conn,$query);
			$data = [];

			while($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}
			return $data;
		}

		function get_product_sub($cat_id) 
		{
			$query = "select * from product where cat_id='$cat_id' ";
			$result = mysqli_query(self::$conn,$query);
			$data = [];

			while($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}
			return $data;
		}


		function getmaxid() 
		{
			$query = "select max(id) from product";
			$result = mysqli_query(self::$conn,$query);
			$id=mysqli_fetch_assoc($result);
			
			return $id['max(id)'];
		}


		function search_by_price($start,$end) 
		{
			$query = "select * from product where price >= '$start' and price <= '$end'";
			$result = mysqli_query(self::$conn,$query);
			$data = [];

			while($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}
			return $data;
		}


		function getproduct($id) 
		{
			$query = "select * from product where id='$id' limit 1";
			$result = mysqli_query(self::$conn,$query);
			$pro = mysqli_fetch_assoc($result);
			$this->id = $pro['id'];
			$this->name = $pro['name'];
			$this->des_product = $pro['des_product'];
			$this->quantity = $pro['quantity'];
			$this->price = $pro['price'];
			$this->image = $pro['image'];
			$this->cat_id = $pro['cat_id'];

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