<?php
	include_once './inc/connection.php';
	include_once './inc/commons.php';
	

	if(isset($_POST['contact_submit']))
	{
		$contact_name = $_POST['contact_name'];
		$contact_email = $_POST['contact_email'];
		$contact_subject = $_POST['contact_subject'];
		$contact_message = $_POST['contact_message'];

		/*-------Validation for contact name--------*/
		if (empty($contact_name))
		{
			$contact_name_err = "<span class='text-danger'>Please fill in your Name.</span>";
		}
		else
		{
			unset($contact_name_err);
		}
		/*-------Validation for contact email--------*/
		if (empty($contact_email))
		{
			$contact_email_err = "<span class='text-danger'>Please fill in your Email.</span>";
		}
		elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/",$contact_email))
		{
			$contact_email_err = "<span class='text-danger'>Please enter valid Email.</span>";
		}
		else
		{
			unset($contact_email_err);
		}
		/*-------Validation for contact name--------*/
		if (empty($contact_subject))
		{
			$contact_subject_err = "<span class='text-danger'>Please fill in your Subject.</span>";
		}
		else
		{
			unset($contact_subject_err);
		}
		/*-------Validation for contact Message--------*/
		if (empty($contact_message))
		{
			$contact_message_err = "<span class='text-danger'>Please fill in your Name.</span>";
		}
		else
		{
			unset($contact_message_err);
		}

		if(empty($contact_name_err) && empty($contact_email_err) && empty($contact_subject_err) && empty($contact_message_err))
		{
			$contact_name = trim($contact_name);
			$contact_email = trim($contact_email);
			$contact_subject = trim($contact_subject);
			$contact_message = trim($contact_message);
			$qry = "insert into contact_information(contact_name,contact_subject,contact_email,contact_message) values('$contact_name','$contact_email','$contact_subject','$contact_message')";
			$result = mysqli_query($connect,$qry);
			$response = "Message has been sent successfully";
		}
	}
	include_once './inc/header.php';
	include_once './inc/nav.php';
?>
<!-- preloader start -->
<div class="cv-ellipsis">
    <div class="cv-preloader">
        <div></div>
    </div>
</div>
<!-- preloader end -->
<!-- main wrapper start -->
<div class="cv-main-wrapper">
		<!-- breadcrumb start -->
	    <div class="cv-breadcrumb">
	        <div class="container">
	            <div class="row">
	                <div class="col-12">
	                    <div class="cv-breadcrumb-box">
	                        <h1>Contact us</h1>
	                        <ul>
	                            <li><a href="index">Home</a></li>
	                            <li>Contact us</li>
	                        </ul>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- breadcrumb end -->
	    <!-- conatact start -->
	    <div class="cv-conatact spacer-top spacer-bottom">
	        <div class="container">
	            <div class="row">
	                <div class="col-lg-12">
	                    <div class="cv-contact-form">
	                        <h2 class="cv-sidebar-title">Get a quote</h2>
	                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	                            <div class="form-input">
		                            <input type="text" placeholder="Enter your name" name="contact_name" value="<?php
		                            if(isset($_POST['contact_name']))
		                            {
		                            	echo $_POST['contact_name'];
		                            }
		                            else
		                            {
		                            	unset($_POST['contact_name']);
		                            }
		                            ?>">
		                            <?php if(isset($contact_name_err)) echo $contact_name_err; ?>
	                        	</div>
	                        	<div class="form-input">
	                            	<input type="text"  placeholder="Enter your email" name="contact_email" value="<?php
	                            	if(isset($_POST['contact_email']))
	                            	{
	                            		echo $_POST['contact_email'];
	                            	}
	                            	else
	                            	{
	                            		unset($_POST['contact_email']);
	                            	}
	                            	?>">
	                            	<?php if(isset($contact_email_err)) echo $contact_email_err; ?>
	                            </div>
	                            <div class="form-input">
		                            <input type="text"  placeholder="Enter your subject" name="contact_subject" value="<?php
		                            	if(isset($_POST['contact_subject']))
		                            	{
		                            		echo $_POST['contact_subject'];
		                            	}
		                            	else
		                            	{
		                            		unset($_POST['contact_subject']);
		                            	}

		                            ?>">
		                            <?php if(isset($contact_subject_err)) echo $contact_subject_err; ?>
	                            </div>
	                            <div class="form-input">
		                            <textarea placeholder="Message here" name="contact_message" value=<?php 
		                            if(isset($_POST['contact_message']))
		                            {
		                            	echo $_POST['contact_message'];
		                            }
		                            else
		                            {
		                            	unset($_POST['contact_message']);
		                            }
		                            ?>></textarea>
		                            <?php if(isset($contact_message_err)) echo $contact_message_err; ?>
		                        </div>
		                       
	                            <button type="submit" class="cv-btn submitForm" name="contact_submit">submit</button>
	                            <div class="response"><?php if(isset($response)) echo $response; ?></div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- conatact end -->

</div>
<!-- main wrapper end -->


<?php
	include_once './inc/footer.php';	
?>