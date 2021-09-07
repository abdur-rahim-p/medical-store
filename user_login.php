<?php
	include_once './inc/connection.php';
	include_once './inc/commons.php';
	include_once './inc/header.php';
	include_once './inc/nav.php';


	

	/*--------if user aleready logged redirect to home page---------*/
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
		$user_password = $_POST['user_password'];
		
		/*-------Validation for contact name--------*/
		if (empty($user_name))
		{
			$user_name_err = "<span class='text-danger'>Please fill in your Name or Email.</span>";
		}
		else
		{
			unset($user_name_err);
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

		if(empty($user_name_err) && empty($user_password_err))
		{
			
			$user_password = md5($user_password);
			$login_qry = "select * from user_details where (user_name='$user_name' or user_email='$user_name') and user_password='$user_password' and status=1";
        	$login_result = mysqli_query($connect,$login_qry);
        	if (mysqli_num_rows($login_result) == 0)
	        {
	        	$user_login_err = "<span class='text-danger'>Invalid User.</span>";
	        }
	        else
	        {
	        	$_SESSION['is_logged_in_user'] = 1;
	        	$_SESSION['user_name'] = $user_name;
	        	$_SESSION['user_password'] = $user_password;
	        	?>
	        	<script type="text/javascript">
					window.location ='./index';
				</script>	
	        	<?php
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
	                    <h1>Login</h1>
	                    <ul>
	                        <li><a href="./index">Home</a></li>
	                        <li>Login</li>
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
	                    <div class="cv-contact-form" id="login-form">
	                        <h2 class="cv-sidebar-title">Login to our sotre!</h2>
	                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	                            <div class="form-input">
		                            <input type="text" placeholder="Enter your name or email" name="user_name" value="<?php
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
								<?php if(isset($user_login_err)) echo $user_login_err; ?>
	                            
	                            
	                            <div class="pt-3"></div>
	                           
	                            <button type="submit" class="cv-btn submitForm" name="signup_submit">submit</button>
	                            <div class="response"><a href="user_signup">Don't have an account? Signup</a></div>
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