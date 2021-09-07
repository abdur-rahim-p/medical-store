<?php
    include_once './inc/constants.php';
    include_once './inc/connection.php';
    include_once './inc/functions.php';
    include_once './inc/header.php';

    // Check if admin already logged in
    admin_logged_in();

    // Submit login
    if(isset($_POST['login_sbmt'])) {
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_password = md5($user_password);
        $ip_address = get_ip();

        // login qry and result
        $fetch_user_qry = "select * from login where (user_name='$user_name' or user_email='$user_name') and user_password='$user_password' and status='1'";
        $fetch_user_qry_result = mysqli_query($con,$fetch_user_qry);

        // Check if user exists
        if(mysqli_num_rows($fetch_user_qry_result)==0) {
            $login_err = "<span class='text-danger'>Invalid User.</span>";
        }
        else {
            $_SESSION['admin_name'] = $user_name;
            $_SESSION['admin_password'] = $user_password;
            $_SESSION['is_admin_logged_in'] = 1;
            $admin_details_arr = mysqli_fetch_array($fetch_user_qry_result);
            $_SESSION['admin_id'] = $admin_details_arr['login_id'];
            $_SESSION['admin_email'] = $admin_details_arr['user_email'];
            $_SESSION['user_role'] =  $admin_details_arr['user_role_id'];

            //Notify User that login attempt was made for security purpose.
            $current_date = date('d-m-Y H:i:s');
            $to = $admin_details_arr['user_email'];
            $subject = "Login Attempted from New IP address ".$ip_address." - ".$current_date."";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <tname3186@gmail.com>' . "\r\n";
            $message = "We've noticed that you accessed your account from an unrecognized IP address.<br>";
            $message.="Time: - ".$current_date.".<br>";
            $message.="IP Address - ".$ip_address.".<br>";
            $message.="If you don't recognize this activity, please disable your account and contact us immediately at http://localhost/medicalstore.com/admin/help-and-support/";
            $send_mail = mail($to,$subject,$message,$headers);
            header("location:./dashboard/");
        }
    }

?>
    <div class="container mt-5">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="admin-site-form">
            <div class="form-group">
                <label for="user_name">Username or Email</label>
                <input type="text" class="form-control" id="user_name" placeholder="User Name or Email" name="user_name">
            </div>
            <div class="form-group password-field">
                <label for="user_password">Password</label>
                <input type="password" class="form-control" id="user_password" placeholder="Enter Password" name="user_password">

            </div>
            <button type="submit" class="btn btn-primary" name="login_sbmt">Submit</button>
            <a href="./reset-password/">Forgot Password</a>

        </form>
        <?php if(isset($login_err)) echo $login_err; ?>
    </div>

<?php
    include_once './inc/footer.php';
?>