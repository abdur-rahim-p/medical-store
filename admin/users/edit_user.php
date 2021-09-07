<?php
include_once './../inc/constants.php';
include_once './../inc/connection.php';
include_once './../inc/functions.php';
include_once './../inc/header.php';
include_once './../inc/sidebar.php';

    //Check if admin is logged out or not
    admin_logged_out();


    // Update Record on submit
    if(isset($_POST['data_update'])) {

        $user_old_img = $_POST['user_old_img'];
        $field_name = $_POST['field_name'];
        $field_category = $_POST['field_category'];
        $user_password = $_POST['user_password'];
        $user_password = md5($user_password);
        $user_email = $_POST['user_email'];
        $user_id = $_POST['user_id'];
        $updated_date = date("Y-d-m h:i:s", time());

        if($_FILES['update_field_file']['error'] != UPLOAD_ERR_NO_FILE ) {
            // Get file name and rename file before uploading.
            $file_get = ($_FILES['update_field_file']['name']);
            $file_temp_name = ($_FILES['update_field_file']['tmp_name']);
            $file_name_arr = explode(".",$file_get);
            $file_name = $file_name_arr[0];
            $file_name = preg_replace('/\s+/', '', $file_name);
            $file_name = trim($file_name);
            $extension = end($file_name_arr);

            // Check file size
            if($_FILES['update_field_file']['size']>= 1048576) {
                $file_err = "<span class='text-danger'>File size must be less than 1mb.</span>";
            }
            else {
                unset($file_err);
                $file_new_name = $file_name.'_'.strtotime(date('Y-m-d H:i:s')).'.'.$extension;
                $file_to_saved = "./../assets/images/user_images/".$file_new_name;
                unlink("./../assets/images/user_images/".$user_old_img);
                // Resize user image on update
                resize_image($file_temp_name);
            }
        }
        else {
            $file_new_name = $user_old_img;
        }

        // Once the file is validated update the record and move resized file to server.
        if(empty($file_err)) {

            $upload_file = move_uploaded_file($file_temp_name,$file_to_saved);
            $update_qry = "update login set user_role_id='$field_category' , user_name='$field_name' , user_password='$user_password' , user_image='$file_new_name' , user_email='$user_email' , updated_date = '$updated_date' where login_id='$user_id'";
            $update_qry_result = mysqli_query($con,$update_qry);

            // Success message
            if($update_qry_result && $upload_file) {
                header("location:?user_id=$user_id&success");
            }
        }
    }


    // Function to print edit form
    function print_edit_form($user_id) {
    global $con;
    global $file_err;
    $fetch_record_qry = "select * from login where login_id='$user_id'";
    $fetch_record_qry_result = mysqli_query($con,$fetch_record_qry);
    $record_arr = mysqli_fetch_array($fetch_record_qry_result);

    if(isset($_REQUEST['success'])) {
        print_success_message("update");
    }
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?user_id=".$record_arr['login_id'].""; ?>" id="admin-site-form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="field_name">User Name</label>
            <input type="text" class="form-control" id="field_name" placeholder="User Name" name="field_name" value="<?php echo $record_arr['user_name']; ?>">
        </div>
        <div class="form-group">
            <label for="field_description">User Email</label>
            <input type="email" class="form-control" id="user_email" placeholder="User Email" name="user_email" value="<?php echo $record_arr['user_email']; ?>">
        </div>
        <div class="form-group">
            <label for="user_password">New Password</label>
            <input type="password" class="form-control" id="user_password" placeholder="Enter new password" name="user_password">
        </div>
        <div class="form-group">
            <label>User Role</label>
            <select class="form-control" id="field_category" name="field_category">
                <?php
                    $user_role_name_qry = "select * from user_role where user_role_id='$record_arr[user_role_id]'";
                    $user_role_name_qry_result = mysqli_query($con,$user_role_name_qry);
                    $user_role_name_arr = mysqli_fetch_array($user_role_name_qry_result);
                ?>
                <option value="<?php echo $user_role_name_arr['user_role_id']?>" selected><?php echo $user_role_name_arr['user_role_name']; ?></option>
                <?php
                    print_role_dropdown();
                ?>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="customFile">User Image</label>
            <input type="file" class="form-control" id="customFile field_file" name="update_field_file">
            <?php if(isset($file_err)) echo $file_err; ?>
        </div>
        <input type="hidden" value="<?php echo $record_arr['user_image']; ?>" name="user_old_img">
        <input type="hidden" value="<?php echo $user_id; ?>" name="user_id">
        <button type="submit" class="btn btn-primary" name="data_update">Submit</button>
    </form>
<?php
}
?>
<div class="container table-container">
    <h1 class="text-center font-weight-light pt-4">Edit User</h1>
    <?php
    if(isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    print_edit_form($user_id);
    }
    else {
    header("location:./index/");
    }
    ?>
</div>


<?php
include_once './../inc/sidebar-end.php';
include_once './../inc/footer.php';
?>

