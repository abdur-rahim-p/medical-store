<?php
    include_once './inc/constants.php';
    include_once './inc/connection.php';
    include_once './inc/header.php';

    if(isset($_POST['reset_pwd_sbmt'])) {
        $selector = $_POST['selector'];
        $token = $_POST['token'];
        $new_password = $_POST['user_password'];
        $confirm_password = $_POST['user_password_cnfrm'];
        $current_date = date("U");

        $new_password = md5($new_password);
        $confirm_password = md5($confirm_password);

        // fetch token and validate
        $fetch_request = "select * from password_reset where pw_reset_selector='$selector' and pw_reset_token='$token' and pw_reset_expires>='$current_date'";

        $fetch_request_result = mysqli_query($con,$fetch_request);


        if(mysqli_num_rows($fetch_request_result)<1) {
            echo "<div class='container pt-5'><span class='text-danger'>You need to re-submit your request.</span></div>";
        }
        else {
            while ($arr = mysqli_fetch_array($fetch_request_result)) {
                $pw_reset_email = $arr['pw_reset_email'];
                $pw_reset_selector = $arr['pw_reset_selector'];
                $pw_reset_token = $arr['pw_reset_token'];
                $pw_reset_expires = $arr['pw_reset_expires'];
            }
            // Update password
            $update_password_qry = "update login set user_password='$new_password' where user_email='$pw_reset_email'";
            $update_password_qry_result = mysqli_query($con,$update_password_qry);

            // Delete Token
            $delete_token_qry = "delete from password_reset where pw_reset_selector='$selector' and pw_reset_token='$token'";
            $delete_token_qry = mysqli_query($con,$delete_token_qry);

            if($update_password_qry_result && $delete_token_qry) {
                ?>
                    <script>alert("password has been updated sucessfully.")</script>
                    <script>window.location.href = './index/';</script>
                <?php
            }
        }

    }

    // function to display form
    function display_form($selector,$token) {
        ?>
        <div class="container mt-5">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="admin-site-form">
                <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <div class="form-group">
                    <label for="user_password">New Password</label>
                    <input type="password" class="form-control" id="user_password" placeholder="Enter new password" name="user_password">
                </div>
                <div class="form-group">
                    <label for="user_password_cnfrm">New Password</label>
                    <input type="password" class="form-control" id="user_password_cnfrm" placeholder="Enter new password" name="user_password_cnfrm">
                </div>
                <button type="submit" class="btn btn-primary" name="reset_pwd_sbmt">Submit</button>
            </form>
        </div>
        <?php
    }

    if(isset($_REQUEST['selector']) && isset($_REQUEST['token'])) {
        if(ctype_xdigit($_REQUEST['selector'])==true && ctype_xdigit($_REQUEST['token'])==true) {
            $selector = $_REQUEST['selector'];
            $token = $_REQUEST['token'];
            display_form($selector,$token);
        } else {
            echo "<div class='container pt-5'><span class='text-danger'>Invalid Request.</span></div>";
        }
    }


    include_once './inc/footer.php';
?>
