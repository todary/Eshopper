<?php 
	
	class shope
	{
		var $id;
		var $user_id;
		var $product_id;
		var $quantity;
		var $but_not;
		
		private static $conn = Null;

		function __construct($id=-1)
		{
			if(self::$conn == Null) 
			{
				self::$conn = mysqli_connect('localhost','root','root','Commerce');
			}
			
			if($id!=-1) 
			{
				$query = "select * from shopp_cart where id=$id limit 1";
				$result = mysqli_query(self::$conn,$query);
				$pro = mysqli_fetch_assoc($result);
				$this->id = $pro['id'];
				$this->user_id = $pro['user_id'];
				$this->product_id = $pro['product_id'];
				$this->quantity = $pro['quantity'];
				$this->but_not = $pro['but_not'];
			}

				
		}

		function insert() 
		{
			$query = "insert into shopp_cart(user_id,product_id,quantity,but_not) values('$this->user_id','$this->product_id','$this->quantity','$this->but_not')";
			$result  = mysqli_query(self::$conn,$query);
			return mysqli_insert_id(self::$conn);
		}	

		function count_product($id)
		{
			$query = "select count(id) from shopp_cart where user_id='$id' and but_not=0";
			$result = mysqli_query(self::$conn,$query);
			$id=mysqli_fetch_assoc($result);
			return $id['count(id)'];
		}


		function product_car($id) 
		{
			$query = "select car.id,pro.image,pro.name,pro.id as id_pro,pro.des_product,pro.price,car.quantity,pro.quantity as total_quantity from shopp_cart as car INNER JOIN product  as pro on car.product_id = pro.id where car.user_id='$id' and but_not=0";
			$result = mysqli_query(self::$conn,$query);
			$data = [];

			while($row = mysqli_fetch_assoc($result)) 
			{
				$data[] = $row;
			}
			return $data;
		}

		function update()
		{
			$query = "update product set user_id='$this->user_id',product_id='$this->product_id',quantity='$this->quantity',but_not='$this->but_not' where id='$this->id'";
			mysqli_query(self::$conn,$query);
		}

		function update_quantity()
		{
			$query = "update shopp_cart set quantity='$this->quantity'where id='$this->id'";
			mysqli_query(self::$conn,$query);
		}

		function update_to_buy($id)
		{
			$query = "update shopp_cart set but_not=1 where id='$id'";
			mysqli_query(self::$conn,$query);
		}

		function updateWithId($id) 
		{
			$query = "update product set name='$this->name',des_product='$this->des_product',quantity='$this->quantity',price='$this->price',image='$this->image',cat_id='$this->cat_id' where id='$this->id'";
			mysqli_query(self::$conn,$query);
		}


		function deleteFormCar() 
		{
			$query = "delete from shopp_cart where id=$this->id";
			mysqli_query(self::$conn,$query);
		}

		function delete() 
		{
			$query = "delete from product where id=$this->id";
			mysqli_query(self::$conn,$query);
		}

		

		// function if_exist($email) 
		// {
		// 	$query = "select id from users where email='$email'";
		// 	$result = mysqli_query(self::$conn,$query);
		// 	return (mysqli_num_rows($result)>0)?True:False ;
		// }

		// function products() 
		// {
		// 	$query = "select * from product";
		// 	$result = mysqli_query(self::$conn,$query);
		// 	$data = [];

		// 	while($row = mysqli_fetch_assoc($result)) {
		// 		$data[] = $row;
		// 	}
		// 	return $data;
		// }

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