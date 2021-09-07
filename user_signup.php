<?php

	include_once './inc/connection.php';
	include_once './inc/commons.php';
	include_once './inc/header.php';
	include_once './inc/nav.php';

	/*----Check if user name aleready exists----*/
	function check_duplicate_name()
	{
		global $connect;
		global $user_name;
		global $user_name_err;
		$qry = "select * from user_details where user_name='$user_name'";
		$result = mysqli_query($connect, $qry);
		if(mysqli_num_rows($result))
		{
			$user_name_err = "<span class='text-danger'>User with this name aleready exists.</span>";
		}
	}

	/*-------Check if email aleready exists-----------*/
	function check_duplicate_email()
	{
		global $connect;
		global $user_email;
		global $user_email_err;
		$qry = "select * from user_details where user_email='$user_email'";
		$result = mysqli_query($connect, $qry);
		if(mysqli_num_rows($result))
		{
			$user_email_err = "<span class='text-danger'>User with this email aleready exists.</span>";
		}
	}
	

	/*--------if user aleready signed in redirect to home page---------*/
	if(isset($_SESSION['is_logged_in_user']) && $_SESSION['is_logged_in_user'] == 1)
	{
		?>
		<script type="text/javascript">
			window.location ='./index';
		</script>	
		<?php
	}
	
	if(isset($_POST['signup_submit']))
	{
		
		$user_name = $_POST['user_name'];
		$user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];
		$user_confirm_password = $_POST['user_confirm_password'];
		$user_phone = $_POST['user_phone'];
		$user_address = $_POST['user_address'];
		$user_delivery_address = $_POST['user_delivery_address'];  
		$user_image = "defaul-profile-img.jpg";
		

		/*-------Validation for contact name--------*/  
		if (empty($user_name))
		{
			$user_name_err = "<span class='text-danger'>Please fill in your Name.</span>";
		}
		elseif (strlen($user_name) < 6) 
		{
			$user_name_err = "<span class='text-danger'>Name length should be atleast 6 characters.</span>";
		}
		else
		{
			unset($user_name_err);
		}
		/*-------Validation for contact email--------*/  
		if (empty($user_email))
		{
			$user_email_err = "<span class='text-danger'>Please fill in your Email.</span>";
		}
		elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/",$user_email))
		{
			$user_email_err = "<span class='text-danger'>Please fill in valid Email.</span>";				
		}
		else
		{
			unset($user_email_err);
		}

		/*-------Validation for contact password-------*/  
		if(empty($user_password))
		{
			$user_password_err = "<span class='text-danger pass-err'>Please fill in your Password.</span>";
		}
		elseif(strlen($user_password) < 6 || strlen($user_password) > 15)
		{
			$user_password_err = "<span class='text-danger pass-err'>Password lenght should be 6 to 15 characters.</span>";
		}
		else
		{
			unset($user_password_err);
		}

		/*-------Validation for contact password-------*/  
		if(empty($user_confirm_password))
		{
			$user_confirm_password_err = "<span class='text-danger pass-err'>Please fill in your Password.</span>";
		}
		elseif(strlen($user_confirm_password) < 6 || strlen($user_confirm_password) > 15)
		{
			$user_confirm_password_err = "<span class='text-danger pass-err'>Password lenght should be 6 to 15 characters.</span>";
		}
		elseif($user_password != $user_confirm_password)
		{
			$user_confirm_password_err = "<span class='text-danger pass-err'>Password and confirm password doesn't match.</span>";
		}
		else
		{
			unset($user_confirm_password_err);
		}

		/*-------Validation for contact phone-------*/  
		if (empty($user_phone))
		{
			$user_phone_err = "<span class='text-danger'>Please fill in your Phone Number.</span>";
		}
		elseif (!preg_match("/^[0-9]{10}+$/",$user_phone)) 
		{
			$user_phone_err = "<span class='text-danger'>Enter valid 10 Digit Contact Number.</span>";
		}
		else
		{
			unset($user_phone_err);
		}
		
		/*-----Validation for address----*/  
		if (empty($user_address))
		{
			$user_address_err = "<span class='text-danger'>Please fill in your Address.</span>";
		}
		else
		{
			unset($user_address_err);
		}

		/*----Validation for user delivery address----*/ 
		if(empty($user_delivery_address))
		{
			$user_delivery_address_err = "<span class='text-danger'>Please fill in your delivery address.</span>";
		}
		else
		{
			unset($user_delivery_address_err);
		}
		

		if(empty($user_name_err) && empty($user_password_err) && empty($user_confirm_password_err) && empty($user_email_err) && empty($user_phone_err) && empty($user_address_err) && empty($user_delivery_address_err) )
		{

			// Trim white spaces and other predefined characters from values.
			$user_name = trim($user_name);
			$user_email = trim($user_email);
			//Encrypt user password with md5() function.
			$user_password = md5($user_password);
			$user_address = trim($user_address);
			$user_delivery_address = trim($user_delivery_address);

			// User sign Up query	
			$signup_qry = "insert into user_details(user_name,user_email,user_password,user_phone,user_address,user_image,user_delivery_address) values ('$user_name','$user_email','$user_password',$user_phone,'$user_address','$user_image','$user_delivery_address')";			
			// User Sign Up result
			$signup_query_result = mysqli_query($connect,$signup_qry);	

			// If user registration successfull redirect to home page 	
			if($signup_query_result)
			{
				$_SESSION['is_logged_in_user'] = 1;
	        	$_SESSION['user_name'] = $user_name;
	        	$_SESSION['user_password'] = $user_password;
				?> 
					<script type="text/javascript">
						alert("You've signed up sucessfully.");
						window.location ='./index';
					</script>	
				<?php	
			}
			else
			{	
				check_duplicate_name();
				check_duplicate_email();
			}
		}
	}
?>
<!-- preloader start -->
<div class="cv-ellipsis">
    <div class="cv-preloader">
        <div></div>
    </div>
</div>
<!-- preloader end -->
<div class="cv-main-wrapper">
	<!-- breadcrumb start -->
	<div class="cv-breadcrumb">
	    <div class="container">
	        <div class="row">
	            <div class="col-12">
	                <div class="cv-breadcrumb-box">
	                    <h1>Sign up</h1>
	                    <ul>
	                        <li><a href="index">Home</a></li>
	                        <li>Sign up</li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- breadcrumb end -->
	<!-- Sign Up form start -->
	    <div class="cv-conatact spacer-top spacer-bottom">
	        <div class="container">
	            <div class="row">
	                <div class="col-lg-12">
	                    <div class="cv-contact-form" id="signup-form">
	                        <h2 class="cv-sidebar-title">Sign up to our sotre!</h2>
	                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	                            <div class="form-input">
		                            <input type="text" placeholder="Enter your name" name="user_name" value="<?php
		                            if(isset($_POST['user_name']))
		                            {
		                            	echo $_POST['user_name'];
		                            }
		                            else
		                            {
		                            	unset($_POST['user_name']);
		                            }
		                            ?>"> 
		                            <?php if(isset($user_name_err)) echo $user_name_err; ?>
	                        	</div>
	                        	<div class="form-input">
	                            	<input type="text"  placeholder="Enter your email" name="user_email" value="<?php
	                            	if(isset($_POST['user_email']))
	                            	{
	                            		echo $_POST['user_email'];
	                            	}
	                            	else
	                            	{
	                            		unset($_POST['user_email']);
	                            	}
	                            	?>">
	                            	<?php if(isset($user_email_err)) echo $user_email_err; ?>
	                            </div>
	                            <div class="form-input password-field">
	                            	<input type="password"  placeholder="Enter your password" name="user_password" value="<?php
	                            	if(isset($_POST['user_password']))
	                            	{
	                            		echo $_POST['user_password'];
	                            	}
	                            	else
	                            	{
	                            		unset($_POST['user_password']);
	                            	}
	                            	?>">
	                            	<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	                            </div>
	                            <?php if(isset($user_password_err)) echo $user_password_err; ?>
	                            <div class="pt-3"></div>
	                            <div class="form-input confirm-password-field">
	                            	<input type="password"  placeholder="Confirm password" name="user_confirm_password" value="<?php
	                            	if(isset($_POST['user_confirm_password']))
	                            	{
	                            		echo $_POST['user_confirm_password'];
	                            	}
	                            	else
	                            	{
	                            		unset($_POST['user_confirm_password']);
	                            	}
	                            	?>">
	                            	<span toggle="#confirm-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	                            </div>
	                            <?php if(isset($user_confirm_password_err)) echo $user_confirm_password_err; ?>
	                            <div class="pt-3"></div>
	                            <div class="form-input">
	                            	<input type="text"  placeholder="Enter your Phone Number" name="user_phone" value="<?php
	                            	if(isset($_POST['user_phone']))
	                            	{
	                            		echo $_POST['user_phone'];
	                            	}
	                            	else
	                            	{
	                            		unset($_POST['user_phone']);
	                            	}
	                            	?>">
	                            	<?php if(isset($user_phone_err)) echo $user_phone_err; ?>
	                            </div>
	                            <div class="form-input">
	                            	<input type="text"  placeholder="Enter your Address" name="user_address" value="<?php
	                            	if(isset($_POST['user_address']))
	                            	{
	                            		echo $_POST['user_address'];
	                            	}
	                            	else
	                            	{
	                            		unset($_POST['user_address']);
	                            	}
	                            	?>">
	                            	<?php if(isset($user_address_err)) echo $user_address_err; ?>
	                            </div>
	                            <div class="form-input">
	                            	<input type="text" placeholder="Enter your delivery Adderss" name="user_delivery_address" value="<?php
	                            	if(isset($_POST['user_delivery_address']))
	                            	{
	                            		echo $_POST['user_delivery_address'];
	                            	}
	                            	else
	                            	{
	                            		unset($_POST['user_delivery_address']);
	                            	}
	                            	?>">
	                            	<?php if(isset($user_delivery_address_err)) echo $user_delivery_address_err; ?>
	                            </div>  
	                            <button type="submit" class="cv-btn submitForm" name="signup_submit">submit</button>
	                            <div class="response"><a href="user_login">Aleready have an account? Login</a></div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- Sign Up form end -->
</div>
<?php
	include_once './inc/footer.php';
?>