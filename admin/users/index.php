<?php
    include_once './../inc/constants.php';
    include_once './../inc/connection.php';
    include_once './../inc/functions.php';
    include_once './../inc/header.php';
    include_once './../inc/sidebar.php';


//Check if admin is logged out or not
admin_logged_out();

function print_user_table() {
    global $con;
    $fetch_records_qry = "select * from login";
    $fetch_records_qry_result = mysqli_query($con, $fetch_records_qry);

    $html = '';
    while ($record_arr = mysqli_fetch_array($fetch_records_qry_result)) {
        $status = $record_arr['status'] == 1 ? 0 : 1;
        $checked = $record_arr['status'] == 1?'checked':'';
        $operation_links = "<a href='./users/edit_user.php?user_id=".$record_arr['login_id']."'>Edit</a> | <a href='javascript:void(0)' id='delete-data-link' tbl_name='login' data-id=".$record_arr["login_id"]." data-image=".$record_arr["user_image"].">Delete</a>";
        if(is_admin()==true) {
            $operation = $operation_links;
        }
        elseif (is_subscriber()==true) {
            $operation = "<p><small>You are not allowed to edit or delete Users.</small></p>";
        }
        else {
            $operation = "";
        }

        $fetch_user_role_name_qry = "select user_role_name from user_role where user_role_id='$record_arr[user_role_id]'";
        $fetch_user_role_name_qry_result = mysqli_query($con,$fetch_user_role_name_qry);
        $role_name = $fetch_user_role_name_qry_result->fetch_row();
        $role_name = $role_name[0];

        $html.='
                <tr>
                    <td>'.$record_arr['user_name'].'</td>
                    <td>'.$record_arr['user_email'].'</td>
                    <td><a data-fancybox="gallery" href='.USER_IMG_URL.$record_arr["user_image"].'><img src='.USER_IMG_URL.$record_arr['user_image'].' alt="category-img"></a></td>
                    <td>'.$role_name.'</td>
                    <td>'.$record_arr['created_date'].'</td>
                    <td>'.$record_arr['updated_date'].'</td>
                    <td><input id="toggle-status" '.$checked.' status='.$status.' data-id='.$record_arr["login_id"].' data-toggle="toggle" data-on="Enabled" data-off="Disabled" type="checkbox" class="change-status" tbl_name="login"></td>
                    <td>'.$operation.'</td> 
                </tr>';

    }
    echo $html;
}
$insert_user_btn_link = "<a href='".ADMIN_URL."users/insert_user/' class='btn my-3'>Add New User</a>";
$insert_user_btn = is_admin()==true?"$insert_user_btn_link":'';

?>

<div class="container table-container">
    <h1 class="text-center font-weight-light pt-4">Manage Users</h1>
    <?php
    if(isset($_REQUEST['success'])) {
        print_success_message("delete");
    }
    echo $insert_user_btn;
    ?>
    <table class="table table-bordered" id="admin-data-table">
        <thead>
        <tr>
            <th>User Name</th>
            <th>User Email</th>
            <th>User Image</th>
            <th>User Role</th>
            <th>Creation Date</th>
            <th>Modified Date</th>
            <th>Status</th>
            <th>Operation</th>
        </tr>
        </thead>
        <tbody>
        <?php
        print_user_table();
        ?>
        </tbody>
    </table>
</div>
<?php
include_once './../inc/sidebar-end.php';
include_once './../inc/footer.php';
?>


