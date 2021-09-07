<?php
    include_once './../inc/constants.php';
    include_once './../inc/connection.php';
    include_once './../inc/functions.php';
    include_once './../inc/header.php';
    include_once './../inc/sidebar.php';

    //Check if admin is logged out or not
    admin_logged_out();

    // Submit Form
    if(isset($_POST['data_sbmt'])) {
        // Get post values
        $category_name = $_POST['field_name'];
        $category_description = $_POST['field_description'];

        // Get file name and rename file before uploading.
        $file_get = ($_FILES['field_file']['name']);
        $file_temp_name = ($_FILES['field_file']['tmp_name']);
        $file_name_arr = explode(".",$file_get);
        $file_name = $file_name_arr[0];
        $file_name = preg_replace('/\s+/', '', $file_name);
        $file_name = trim($file_name);
        $extension = end($file_name_arr);
        $file_new_name = $file_name.'_'.strtotime(date('Y-m-d H:i:s')).'.'.$extension;
        $file_to_saved = "./../assets/images/category_images/".$file_new_name;

        // Check file size
        if($_FILES['field_file']['size']>= 1048576) {
            $file_err = "<span class='text-danger'>File size must be less than 1mb.</span>";
        }
        else {
            unset($file_err);
        }
        // Upload file
        if(empty($file_err)) {
            $upload_file = move_uploaded_file($file_temp_name,$file_to_saved);
            $insert_category_qry = "insert into category (category_name,category_description,category_image) values ('$category_name','$category_description','$file_new_name')";
            $insert_category_qry_result = mysqli_query($con,$insert_category_qry);

            if($upload_file && $insert_category_qry_result) {
                header("location:?success");
            }
        }
    }

?>
    <div class="container table-container">
        <h1 class="text-center font-weight-light pt-4">Insert Category</h1>
        <?php
            if(isset($_REQUEST['success'])) {
                print_success_message("insert");
            }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="admin-site-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="field_name">Category Name</label>
                <input type="text" class="form-control" id="field_name" placeholder="Category Name" name="field_name">
            </div>
            <div class="form-group">
                <label for="field_description">Category Description</label>
                <input type="text" class="form-control" id="field_description" placeholder="Category Description" name="field_description">
            </div>

            <div class="form-group">
                <label class="form-label" for="customFile">Default file input example</label>
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