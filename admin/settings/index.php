<?php
    include_once './../inc/constants.php';
    include_once './../inc/connection.php';
    include_once './../inc/functions.php';
    include_once './../inc/header.php';
    include_once './../inc/sidebar.php';

    //Check if admin is logged out or not
    admin_logged_out();

    // Submit and update settings
    if(isset($_POST['setting_btn'])) {
        $site_title = $_POST['field_name'];
        $currency = $_POST['select_category'];
        $updated_date = date("Y-d-m h:i:s", time());
        $favicon_old_img = $_POST['old_site_icon'];

        if($_FILES['update_field_file']['error'] != UPLOAD_ERR_NO_FILE ){
            // Get file name and rename file before uploading.
            $file_get = ($_FILES['update_field_file']['name']);
            $file_temp_name = ($_FILES['update_field_file']['tmp_name']);
            $file_name_arr = explode(".",$file_get);
            $file_name = $file_name_arr[0];
            $file_name = preg_replace('/\s+/', '', $file_name);
            $file_name = trim($file_name);
            $extension = end($file_name_arr);

            // Check file size
            if($_FILES['update_field_file']['size']>= 524288) {
                $file_err = "<span class='text-danger'>File size must be less than 500kb.</span>";
            }
            else {
                unset($file_err);
                $file_new_name = $file_name.'_'.strtotime(date('Y-m-d H:i:s')).'.'.$extension;
                $file_to_saved = "./../assets/images/global_images/".$file_new_name;

                unlink("./../assets/images/global_images/".$favicon_old_img);
                // Move uploaded file
                $upload_file =  move_uploaded_file($file_temp_name,$file_to_saved);
            }
        }
        else {
            $file_new_name = $favicon_old_img;
        }


        // Once the file is validated update the record and move resized file to server.
        if(empty($file_err)) {
            // Update website global settings
            $update_setting_qry = "update website_global set field_value = CASE WHEN field_name='site_title' THEN '$site_title' WHEN field_name='default_currency' THEN '$currency' WHEN field_name='site_icon' THEN '$file_new_name' END , updated_date='$updated_date'";
            $update_setting_qry_result = mysqli_query($con,$update_setting_qry);
            // Success message
            if($update_setting_qry_result) {
                header("location:?success");
            }
        }
    }

    // Function to print global setting form
    function global_setting_form() {
        global $file_err;
        $file_err = isset($file_err)?$file_err:'';
        $site_title = get_default_setting('site_title');
        $default_currency = get_default_setting('default_currency');
        $site_icon = get_default_setting('site_icon');
        $form_html = "<form action=".$_SERVER['PHP_SELF']." method='post' enctype='multipart/form-data' id='admin-site-form'>
                            <div class='form-group'>
                                <label for='field_name'>Site Title</label>
                                <input class='form-control' id='field_name' placeholder='Site Title' name='field_name' value ='".$site_title."'>
                            </div>
                            <div class='form-group'>
                                <label for='currencyselect'>Store Currency</label>
                                <select class='form-control' id='currencyselect' name='select_category'>
                                    <option value=".$default_currency." selected>Default Currency - ".$default_currency."</option>
                                    <option value='$'>USD - $</option>
                                    <option value='₹'>INR - ₹</option>
                                    <option value='ر.ق'>QATAR - ر.ق</option>
                                    <option value='฿'>THB -  ฿</option>
                                    <option value='J$'>JMD - J$</option>
                                    <option value='¥'>JPY - ¥</option> 	
                                </select>
                            </div>
                            <div class='form-group'>
                                <label class='form-label' for='customFile'>Store Icon</label>
                                <input type='file' class='form-control' id='customFile field_file' name='update_field_file'>   
                                $file_err 
                            </div>
                            <button class='btn btn-primary mt-3' type='submit' name='setting_btn' id='global_setting_form_btn'>Save Changes</button>
                            <input type='hidden' value='".$site_icon."' name='old_site_icon'>
                        </form>";
        echo $form_html;
    }

?>
    <div class="container table-container pt-4">
        <h1 class="text-center font-weight-light">Website Settings</h1>
        <?php
            if(isset($_REQUEST['success'])) {
                print_success_message("settings");
            }
            if(is_subscriber()==true) {
                echo "<h2 class='text-center font-weight-light'>Sorry , You are restricted to access this feature.</h2>";
            }
            else {
                global_setting_form();
            }

        ?>
    </div>

<?php
    include_once './../inc/sidebar-end.php';
    include_once './../inc/footer.php';
?>
