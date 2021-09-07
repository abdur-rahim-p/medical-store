<?php
    include_once './inc/constants.php';
    include_once './inc/connection.php';
    include_once './inc/header.php';


    // Assigning request result to let user know of his request.
    if(isset($_REQUEST['request'])) {
        $request_result = $_REQUEST['request'];
        if($request_result == "success") {
            $request_result = "<p class='text-success'>Check your Email. Email is sent.</p>";
        }
        if($request_result =="failed") {
            $request_result = "<p class='text-danger'>There was an error. Please try again!</p>";
        }
    }

    // Posting request
    if(isset($_POST['reset_request_btn'])) {
        // Assign token and selector
        $selector = bin2hex(random_bytes(8));
        $token = bin2hex(random_bytes(32));

        $user_email = $_POST['user_email'];
        $url = "http://localhost/medicalstore.com/admin/create-new-password.php?selector=$selector&token=$token";
        $expire_date = date("U") + 1800;

        /*--------Insert token into database------*/
        $insert_token_qry = "INSERT INTO `password_reset`(`pw_reset_email`, `pw_reset_selector`, `pw_reset_token`, `pw_reset_expires`) VALUES ('$user_email','$selector','$token','$expire_date')";
        $insert_token_qry_result = mysqli_query($con,$insert_token_qry);

        /*-----Sending Mail-----*/
        ini_set('display_errors',1);
        error_reporting(E_ALL);
        $to = $user_email;
        $subject = "Reset your password of dashboard account.";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <tname3186@gmail.com>' . "\r\n";
        $message = "<p>We received a password reset request. The link to reset your password is below. If you did'nt make this request , you can ignore this email.</p>";
        $message.="<p>Here is your password reset link:</p>";
        $message.='<a href='.$url.'>'.$url.'</a>';
        $send_mail = mail($to,$subject,$message,$headers);

        // Check if token is inserted into database and email is sent.
        if($insert_token_qry_result &&  $send_mail) {
            header("location:?request=success");
        }
        else {
            header("location:?request=failed");
        }
    }

?>
    <div class="container mt-5">
        <?php if(isset($request_result)) echo $request_result; ?>
        <p>An email will be sent to you with instructions on how to reset your password.</p>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="admin-site-form">
            <div class="form-group">
                <label for="user_email">Email address</label>
                <input type="email" class="form-control" id="user_email" placeholder="Enter email" name="user_email">
            </div>
            <button type="submit" class="btn btn-primary" name="reset_request_btn">Submit</button>
        </form>
    </div>
<?php
    include_once './inc/footer.php';
?>
