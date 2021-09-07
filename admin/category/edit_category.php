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

        $category_old_img = $_POST['category_old_img'];
        $field_name = $_POST['field_name'];
        $field_description = $_POST['field_description'];
        $category_id = $_POST['category_id'];
        $updated_date = date("Y-d-m h:i:s", time());

        if(!($_FILES['update_field_file']['error'] == UPLOAD_ERR_NO_FILE)) {
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
                $file_to_saved = "./../assets/images/category_images/".$file_new_name;
                unlink("./../assets/images/category_images/".$category_old_img);
            }
        }
        else {
            $file_new_name = $category_old_img;
        }

        // Once the file is validated update the record and move resized file to server.
        if(empty($file_err)) {
            $upload_file = move_uploaded_file($file_temp_name,$file_to_saved);
            $update_qry = "update category set category_name='$field_name' , category_description='$field_description' , category_image='$file_new_name' , updated_date='$updated_date' where category_id='$category_id'";
            $update_qry_result = mysqli_query($con,$update_qry);

            if($update_qry_result && $upload_file) {
                header("location:?category_id=$category_id&success");
            }
        }
    }


    // Function to print edit form
    function print_edit_form($category_id) {
        global $file_err;
        global $con;
        $fetch_record_qry = "select * from category where category_id='$category_id'";
        $fetch_record_qry_result = mysqli_query($con,$fetch_record_qry);
        $record_arr = mysqli_fetch_array($fetch_record_qry_result);

            if(isset($_REQUEST['success'])) {
                print_success_message("update");
            }
        ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?category_id=".$record_arr['category_id'].""; ?>" id="admin-site-form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="field_name">Category Name</label>
                    <input type="text" class="form-control" id="field_name" placeholder="Category Name" name="field_name" value="<?php echo $record_arr['category_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="field_description">Category Description</label>
                    <input type="text" class="form-control" id="field_description" placeholder="Category Description" name="field_description" value="<?php echo $record_arr['category_description']; ?>">
                </div>

                <div class="form-group">
                    <label class="form-label" for="customFile">Default file input example</label>
                    <input type="file" class="form-control" id="customFile field_file" name="update_field_file">
                    <?php if(isset($file_err)) echo $file_err; ?>
                </div>
                <input type="hidden" value="<?php echo $record_arr['category_image']; ?>" name="category_old_img">
                <input type="hidden" value="<?php echo $category_id; ?>" name="category_id">
                <button type="submit" class="btn btn-primary" name="data_update">Submit</button>
            </form>
        <?php
    }
?>
    <div class="container table-container">
        <h1 class="text-center font-weight-light pt-4">Edit Category</h1>
        <?php
            if(isset($_REQUEST['category_id'])) {
                $category_id = $_REQUEST['category_id'];
                print_edit_form($category_id);
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
