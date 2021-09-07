<?php
	include_once './inc/connection.php';
	include_once './inc/commons.php';
	include_once './inc/header.php';
	include_once './inc/nav.php';

	if(!isset($_SESSION['is_logged_in_user']) && $_SESSION['is_logged_in_user']!=1)
    {
        ?>
	    <script type="text/javascript">
			window.location ='./index';
		</script>
        <?php
    }
    // Constant for image path
    define("images","./admin/images/user_images/");
        	

	$get_user_id_qry = "select user_id from user_details where user_name='$user_name' or user_email='$user_name'";
	$get_user_id_qry_result = mysqli_query($connect,$get_user_id_qry);
	while ($arr = mysqli_fetch_array($get_user_id_qry_result)) 
	{
		$user_id = $arr['user_id'];
	}	

	// Function for update profile
	function update_profile()
	{
		global $connect;
		global $user_id;
		$get_user_qry = "select * from user_details where user_id=$user_id";
		$get_user_qry_result = mysqli_query($connect,$get_user_qry);
		
		if(isset($_POST['update_submit']))
		{
			$user_name = $_POST['user_name'];
			$user_password = $_POST['user_password'];
			$user_email = $_POST['user_email'];
			$user_phone = $_POST['user_phone'];
			$user_address = $_POST['user_address'];
			$user_delivery_address = $_POST['user_delivery_address'];

			// New passsword fields validation
			if(empty($user_password))
			{
				$user_password_err = "<span class='text-danger pass-err'>Please fill in your New Password.</span>";
			}
			elseif(strlen($user_password) < 6 || strlen($user_password) > 15)
			{
				$user_password_err = "<span class='text-danger pass-err'>Password lenght should be 6 to 15 characters.</span>";
			}
			else
			{
				unset($user_password_err);
			}

			// Update profile
			if(empty($user_password_err))
			{
				$user_password = md5($user_password);

				$update_qry = "update user_details set user_name='$user_name' , user_email='$user_email' , user_password = '$user_password' , user_phone = '$user_phone' , user_address = '$user_address' , user_delivery_address = '$user_delivery_address' where user_id=$user_id";
				$update_qry_result = mysqli_query($connect,$update_qry);
				
				if($update_qry_result)
				{
					echo "<script>
							alert('Profile updated successfully');
						  	window.location ='./index';
						</script>";
				} 
				else
				{
					echo "<script>
							alert('Profile couldn't update);
						  	window.location ='./user_edit_profile';
						</script>";	
				}
				
			}
			

		}

		// Print form with user profile data
		while ($arr = mysqli_fetch_array($get_user_qry_result)) {
			?>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>#signup-form" method="post" enctype="multipart/form-data">
				<div class="form-input">
	                <input type="text" placeholder="Update your name" name="user_name" value="<?php
	                if(isset($arr['user_name']))
	                {
	                	echo $arr['user_name'];
	                }
	                else
	                {
	                	unset($_POST['user_name']);
	                }
	                ?>">
	        	</div>
	        	<div class="form-input">
		        	<input type="text"  placeholder="Update your email" name="user_email" value="<?php
		        	if(isset($arr['user_email']))
		        	{
		        		echo $arr['user_email'];
		        	}
		        	else
		        	{
		        		unset($_POST['user_email']);
		        	}
		        	?>">
		        </div>
		        <div class="form-input password-field">
	            	<input type="password"  placeholder="Enter your new password" name="user_password" value="<?php
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
	            <div class="form-input">
	            	<input type="text"  placeholder="Update your Phone Number" name="user_phone" value="<?php
	            	if(isset($arr['user_phone']))
	            	{
	            		echo $arr['user_phone'];
	            	}
	            	else
	            	{
	            		unset($_POST['user_phone']);
	            	}
	            	?>">
	            </div>
	            <div class="form-input">
	            	<input type="text"  placeholder="Update your Address" name="user_address" value="<?php
	            	if(isset($arr['user_address']))
	            	{
	            		echo $arr['user_address'];
	            	}
	            	else
	            	{
	            		unset($_POST['user_address']);
	            	}
	            	?>">
	            </div>
	            <div class="form-input">
	            	<input type="" name="user_delivery_address" value="<?php
	            		if(isset($arr['user_delivery_address']))
	            		{
	            			echo $arr['user_delivery_address'];
	            		}
	            		else
	            		{
	            			unset($arr['user_delivery_address']);
	            		}
	            	?>">
	            </div>
	            <button type="submit" class="cv-btn submitForm" name="update_submit">update</button>
        	</form>
	        <?php
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
	                    <h1>Edit Profile</h1>
	                    <ul>
	                        <li><a href="./index">Home</a></li>
	                        <li>Edit Profile</li>
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
	                        <h2 class="cv-sidebar-title">Edit your profile of our store!</h2>
	                        <?php
	                        	update_profile();
	                        ?>
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