
 <?php

 session_start();
	if(isset($_SESSION['user_id'])) 
	{
		header('location:home.php');
	}

 $nameErr = $emailErr = $usernameErr = $passwordErr = $cpasswordErr = $creditErr = $addressErr = $birthdayErr = $regErr ="";
 $name = $email = $username = $birthday = $credit = $address = $password = $confirm_password = $reg = "";
    
     function test_input($data) 
    {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

$conn=mysqli_connect("localhost","root","root","Commerce") or die ("Can not connect to db");


// if ($_SERVER["REQUEST_METHOD"] == "POST") 
// print_r($_POST);
// print_r($_SERVER);
if (isset($_POST['submit']))

{
        // echo "here";
        //validate name
        if(empty($_POST['name'])) 
        
            $nameErr ="Name is required";
        
        else
        {
            $name = test_input($_POST['name']);
            // check if name only contains letters and whitespace
            if (strlen($name) <= '4') 
              
                    $nameErr = "Your Name Must Contain At Least 6 Characters!";
              

            elseif (!preg_match("/^[a-zA-Z ]*$/",$name)) 
            
              $nameErr ="Only letters and white space allowed"; 
            
        }

        //validate password
        if (empty($_POST['password']) || empty($_POST['confirm_password'])) 
        
            $passwordErr ="password and confirmation is required";
        

        elseif(!empty($_POST['password']) && ($_POST['password']) == ($_POST['confirm_password']))
          {
                $password = test_input($_POST['password']);
                $confirm_password = test_input($_POST['confirm_password']);
                
                if (strlen($_POST['password']) <= '4') 
                
                    $passwordErr = "Your Password Must Contain At Least 6 Characters!";
                
          }
        

        //validate job 
        if (!empty($_POST['job'])) 
        {
            $job = test_input($_POST['job']);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$job)) 
            
              $jobErr ="Only letters and white space allowed"; 
            
        }

        //validate email
        if (empty($_POST['email'])) 
        
          $emailErr = "Email is required";
        
        else
        {
            $email = test_input($_POST['email']);

            $pattern='/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/';
            
            if(!preg_match($pattern,$email))
            
                $emailErr = "Invalid email format"; 
            
            else
              //UNIQUE EMAIL
              {
                  $test="select email from users where email='$email' limit 1";

                  $res=mysqli_query($conn,$test)or die(mysqli_error($conn));
                  
                  $row=mysqli_num_rows($res);
             
                  if ($row >0)
                  
                    $emailErr = "Email $email is already beeen taken";
                  
              }
        }

        //Validate Address .. optional
        if (!empty($_POST['address'])) 
        {
            $address = test_input($_POST['address']);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$address)) 
            
              $addressErr ="Only letters and white space allowed"; 
            
        }

        //Validates Username
        if(empty($_POST['username']))
         
            $usernameErr = "You Forgot to Enter Your Username";
          
         else
          
            $username = test_input($_POST['username']);
          

        //Validate Credit
        if (empty($_POST['credit']))
        
            $creditErr = "Please enter your credit value";
        
        else
        {

            $credit = test_input($_POST['credit']);
             if(!preg_match("/^[0-9]+$/",$credit))
            
                 $creditErr = "Please enter a valid credit value";

        }

        if (empty($_POST['birthday']))

            $birthdayErr="Please enter your birthday";

        $image=$_POST['image'];


         if(empty($nameErr) && empty($birthdayErr) && empty($emailErr) && empty($usernameErr)
            && empty($passwordErr) && empty($addressErr) && empty($jobErr) && empty($creditErr) )
            {
                $sql = "INSERT INTO users (name,email,birthday,job,address,username,password,credit,image) 
                		VALUES('$name','$email','$birthday','$job','$address','$username','$password','$credit','$image')";
                $result=mysqli_query($conn,$sql);
                if($result)
                    $regErr = "Registeration successfully";
                    else
                    $regErr = "Registeration failed";
            }
        
        mysqli_close($conn);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>


	

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <style>
	.error {color: #FF0000;}
	input
	{

		float:left;
		width:95%!important;
		/*margin-left:2px;*/
	}
	.text
	{

		float:left;
	}

	span{
		float: right;
	}
	</style>
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canada</a></li>
									<li><a href="">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canadian Dollar</a></li>
									<li><a href="">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-user"></i> Account</a></li>
								<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="login.html" class="active"><i class="fa fa-lock"></i> Login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.html">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.html">Cart</a></li> 
										<li><a href="login.html" class="active">Login</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="404.html">404</a></li>
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">

				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<?php
							if (isset($_SESSION['errors'])) {
								foreach ($_SESSION['errors'] as $key => $value) {
									?>
									<div class='alert alert-danger'><b><?php echo $value; ?></b></div>
									<?php
								}
							}
						?>
						<form action='check.php' method='post'>
							<input type="email" name="email" placeholder="Email Address" />
							<input type="password" name="password" placeholder="Password" />
							
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" name="ok" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>

				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">


					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						 <p><span class="error pull-left">* = required field</span></p> 
						<form action="login.php" method="post" id="myform">
							<input type="text"  name="name" placeholder="Name"/>
							<span class="error">* <?php echo $nameErr;?></span>
							<input type="date" name="birthday" id="birthday" placeholder="Birthday"/>
							<span class="error">* <?php echo $birthdayErr;?></span>
							<input type="text" name="job" id="job" placeholder="Your Job"/>
							<input type="text" name="address" id="address" placeholder="Address"/>
							<input type="text" name="username" id="name" placeholder="User Name"/>
							<span class="error">* <?php echo $usernameErr;?></span>
							<input type="text" name="email" id="email" placeholder="Email Address"/>
							<span class="error">* <?php echo $emailErr;?></span> 
							<input type="password" name="password" id="password" placeholder="Password"/><span class="error">* <?php echo $passwordErr;?></span>
							<input type="password" name="confirm_password" placeholder="Confirm Password"/><span class="error">* <?php echo $cpasswordErr;?></span>
 							<input type="text" name="credit" id="credit" placeholder="Enter Your Credit Value" >
 							<span class="error">* <?php echo $creditErr;?></span>
							<input type="label"  value="Insert Your Image" disabled="disabled" >
							<input type="file" name="image" id="image" value="choose Your Image"/>

							<button type="submit" name="submit" class="btn btn-default"/>Signup</button> 
							<span class="error"> <?php echo $regErr;?></span>
						</form>
						<!-- <div id="ack"></div> -->


						<script src="classes/jquery-1.11.3-jquery.min.js" type="text/javascript" ></script>
						<script src="classes/myscript.js" type="text/javascript"></script>
					

					</div><!--/sign up form-->
				

				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Online Help</a></li>
								<li><a href="">Contact Us</a></li>
								<li><a href="">Order Status</a></li>
								<li><a href="">Change Location</a></li>
								<li><a href="">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">T-Shirt</a></li>
								<li><a href="">Mens</a></li>
								<li><a href="">Womens</a></li>
								<li><a href="">Gift Cards</a></li>
								<li><a href="">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Terms of Use</a></li>
								<li><a href="">Privecy Policy</a></li>
								<li><a href="">Refund Policy</a></li>
								<li><a href="">Billing System</a></li>
								<li><a href="">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Company Information</a></li>
								<li><a href="">Careers</a></li>
								<li><a href="">Store Location</a></li>
								<li><a href="">Affillate Program</a></li>
								<li><a href="">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>


</body>
</html>
