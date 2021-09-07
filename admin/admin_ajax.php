<?php
    include_once './inc/constants.php';
    include_once './inc/connection.php';
    include_once './inc/functions.php';

    // Ajax request for Update status
    if((isset($_POST['operation']) && $_POST['operation']=='toggle')){
        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'];
        $tbl_name = $_REQUEST['tbl_name'];

        if($tbl_name=='category') {
            $update_status_qry = "update $tbl_name set status='$status' where category_id='$id'";
        }
        if($tbl_name=='product') {
            $update_status_qry = "update $tbl_name set status='$status' where product_id='$id'";
        }
        if($tbl_name=='login') {
            $update_status_qry = "update $tbl_name set status='$status' where login_id='$id'";
        }
        $result = mysqli_query($con,$update_status_qry);
    }

    // Request for Delete Record
    if(isset($_REQUEST['operation']) && $_REQUEST['operation']=='delete_data') {
        $id = $_REQUEST['id'];
        $tbl_name = $_REQUEST['tbl_name'];
        $data_img = $_REQUEST['data_img'];

        if($tbl_name=='category') {
            $delete_record_qry = "delete from category where category_id='$id'";
            $result = mysqli_query($con,$delete_record_qry);
            unlink("./assets/images/category_images/".$data_img);
            header("location:./category?success");
        }
        if($tbl_name=='product') {
            $delete_record_qry = "delete from product where product_id='$id'";
            $result = mysqli_query($con,$delete_record_qry);
            unlink("./assets/images/product_images/".$data_img);
            header("location:./product?success");
        }
        if($tbl_name=='login') {
            $delete_record_qry = "delete from login where login_id='$id'";
            $result = mysqli_query($con,$delete_record_qry);
            unlink("./assets/images/user_images/".$data_img);
            header("location:./users?success");
        }
    }
?>