<?php
    include_once './../inc/constants.php';
    include_once './../inc/connection.php';
    include_once './../inc/functions.php';
    include_once './../inc/header.php';
    include_once './../inc/sidebar.php';

    //Check if admin is logged out or not
    admin_logged_out();

    function send_registration_email() {
        $user_name = $_POST['field_name'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        ini_set('display_errors',1);
        error_reporting(E_ALL);
        $to = $user_email;
        $subject = "Medical Store Dashboard Account Registration.";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <tname3186@gmail.com>' . "\r\n";
        $message = "Your account has been registered successfully as . From now on you can login to your dashboard account using below details.<br>";
        $message.= "Dashboard login url - ".ADMIN_URL."<br>";
        $message.= "Email - ".$user_email."<br>";
        $message.= "User Name - ".$user_name."<br>";
        $message.= "User Password - ".$user_password."<br>";
        $message.="If you don't recognize this activity, please disable your account and contact us immediately at http://localhost/medicalstore.com/admin/help-and-support/";
        $send_mail = mail($to,$subject,$message,$headers);
        if($send_mail) {
            return true;
        }
    }


    // Submit Form
    if(isset($_POST['data_sbmt'])) {

        // Get post values
        $user_name = $_POST['field_name'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['field_category'];
        $user_password = $_POST['user_password'];
        $user_password = md5($user_password);

        // Get file name and rename file before uploading.
        $file_get = ($_FILES['field_file']['name']);
        $file_temp_name = ($_FILES['field_file']['tmp_name']);
        $file_name_arr = explode(".",$file_get);
        $file_name = $file_name_arr[0];
        $file_name = preg_replace('/\s+/', '', $file_name);
        $file_name = trim($file_name);
        $extension = end($file_name_arr);
        $file_new_name = $file_name.'_'.strtotime(date('Y-m-d H:i:s')).'.'.$extension;
        $file_to_saved = "./../assets/images/user_images/".$file_new_name;


        // Check file size
        if($_FILES['field_file']['size']>= 1048576) {
            $file_err = "<span class='text-danger'>File size must be less than 1mb.</span>";
        }
        else {
            unset($file_err);
        }

        // Upload file
        if(empty($file_err)) {
            // Common Function call back to resize upload image
            resize_image($file_temp_name);

            // Send Registration email to user
            $send_registration_email = send_registration_email($_POST);

            // Move resized file to server
            $upload_file = move_uploaded_file($file_temp_name,$file_to_saved);

            // Insert user into database
            $insert_category_qry = "insert into login(user_role_id,user_name,user_password,user_image,user_email) values ('$user_role','$user_name','$user_password','$file_new_name','$user_email')";
            $insert_category_qry_result = mysqli_query($con,$insert_category_qry);

            // Success message
            if($upload_file && $insert_category_qry_result && $send_registration_email == true) {
                header("location:?success");
            }
        }
    }
?>

    <div class="container table-container">
        <h1 class="text-center font-weight-light pt-4">Insert User</h1>
        <?php
        if(isset($_REQUEST['success'])) {
            print_success_message("insert");
        }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="admin-site-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="field_name">User Name</label>
                <input type="text" class="form-control" id="field_name" placeholder="User Name" name="field_name">
            </div>
            <div class="form-group">
                <label for="field_description">User Email</label>
                <input type="email" class="form-control" id="user_email" placeholder="User Email" name="user_email">
            </div>
            <div class="form-group">
                <label for="user_password">New Password</label>
                <input type="password" class="form-control" id="user_password" placeholder="Enter new password" name="user_password">
            </div>
            <div class="form-group">
                <label for="user_password_cnfrm">Confirm Password</label>
                <input type="password" class="form-control" id="user_password_cnfrm" placeholder="Enter new password again" name="user_password_cnfrm">
            </div>
            <div class="form-group">
                <label>User Role</label>
                <select class="form-control" id="field_category" name="field_category">
                    <option value="" selected>Select User Role</option>
                    <?php
                        print_role_dropdown();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="customFile">User Profile Image</label>
                <input type="file" class="form-control" id="customFile field_file" name="field_file">
                <?php if(isset($file_err)) echo $file_err; ?>
            </div>
            <button type="submit" class="btn btn-primary" name="data_sbmt">Submit</button>
        </form>
    </div>


<?php
    include_once './../inc/sidebar-end.php';
    include_once './../inc/footer.php';
?>