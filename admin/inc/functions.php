<?php
    session_start();

    // Define Function to check if admin is logged in or not
    function admin_logged_in() {
        if(isset($_SESSION['is_admin_logged_in']) && isset($_SESSION['is_admin_logged_in'])==1) {
            header("location:".ADMIN_URL."dashboard/");
        }
    }

    // Define function to check if admin is logged out
    function admin_logged_out() {
        if(!isset($_SESSION['is_admin_logged_in']) && isset($_SESSION['is_admin_logged_in'])!=1) {
            header("location:".ADMIN_URL."index/");
        }
    }

    // Define function to check if logged in user is admin
    function is_admin() {
        if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='1') {
            return true;
        }
    }

    // Define function to check if logged in user is subscriber
    function is_subscriber() {
        if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='2') {
            return true;
        }
    }

    // Function to get IP address
    function get_ip() {
        $mainIp = '';
        if (getenv('HTTP_CLIENT_IP'))
            $mainIp = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $mainIp = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $mainIp = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $mainIp = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $mainIp = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $mainIp = getenv('REMOTE_ADDR');
        else
            $mainIp = 'UNKNOWN';
        return $mainIp;
    }

    // Function to print success message
    function print_success_message($action) {
        if($action=="insert") {
            $message = "Record has been inserted successfully.";
        }elseif ($action=="update") {
            $message = "Record has been updated successfully.";
        }elseif ($action=="delete") {
            $message = "Record has been deleted successfully.";
        }elseif ($action=="settings") {
            $message = "All changes are saved successfully.";
        }
        elseif ($action=="help_request") {
            $message = "Your Request has been submitted successfully.";
        }
        else {
            $message = "Action has been performed successfully.";
        }
        $sucess_message ='
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span>'.$message.'</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        echo $sucess_message;
    }

    // Function to print category dropdown
    function print_category_dropdown() {
        global $con;
        $fetch_category_qry = "select category_id,category_name from category where status=1";
        $fetch_category_qry_result = mysqli_query($con,$fetch_category_qry);
        $html = '';
        while($category_arr = mysqli_fetch_assoc($fetch_category_qry_result)) {
            $html.='
                <option value='.$category_arr['category_id'].'>'.$category_arr['category_name'].'</option>
            ';
        }
        echo $html;
    }

    // Function print user role dropdown
    function print_role_dropdown() {
        global $con;
        $fetch_role_qry = "select user_role_id,user_role_name from user_role";
        $fetch_role_qry_result = mysqli_query($con,$fetch_role_qry);
        $html = '';
        while ($user_role_arr = mysqli_fetch_assoc($fetch_role_qry_result)) {
            $html.='
                <option value='.$user_role_arr['user_role_id'].'>'.$user_role_arr['user_role_name'].'</option>
            ';
        }
        echo $html;
    }

    // Function to resize uploaded user image
    function resize_image($file_get) {
        $img_properties = getimagesize($file_get);
        $img_type = $img_properties[2];

        $new_width = 130;
        $new_height = 130;
        $new_image = imagecreatetruecolor($new_width,$new_height);

        switch ($img_type) {
            case IMAGETYPE_JPEG:
                $original_img = imagecreatefromjpeg($file_get);
                $orignial_width = imagesx($original_img);
                $original_height = imagesy($original_img);
                imagecopyresampled($new_image,$original_img,0,0,0,0,$new_width,$new_height,$orignial_width,$original_height);
                imagejpeg($new_image,$file_get,100);
                break;
            case IMAGETYPE_PNG:
                $original_img = imagecreatefrompng($file_get);
                $orignial_width = imagesx($original_img);
                $original_height = imagesy($original_img);
                imagecopyresampled($new_image,$original_img,0,0,0,0,$new_width,$new_height,$orignial_width,$original_height);
                imagepng($new_image,$file_get,9);
                break;
            default:
                break;
        }
    }


    // Function to get site default setting
    function get_default_setting($slug) {
        global $con;
        $fetch_default_setting_qry = "select field_value from website_global where field_name='$slug'";
        $fetch_default_setting_qry_result = mysqli_query($con,$fetch_default_setting_qry);
        $fetch_default_setting = mysqli_fetch_assoc($fetch_default_setting_qry_result);
        $default_setting = $fetch_default_setting['field_value'];
        return $default_setting;
    }
?>