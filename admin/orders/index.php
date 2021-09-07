<?php
    include_once './../inc/constants.php';
    include_once './../inc/connection.php';
    include_once './../inc/functions.php';
    include_once './../inc/header.php';
    include_once './../inc/sidebar.php';

    //Check if admin is logged out or not
    admin_logged_out();

    function get_user_name($id) {
        global $con;
        $fetch_username_qry = "select user_name from user_details where user_id='$id'";
        $fetch_username_qry_result = mysqli_query($con,$fetch_username_qry);
        $username = '';
        while ($arr = mysqli_fetch_array($fetch_username_qry_result)) {
            $username.= $arr['user_name'];
        }
        return $username;
    }


    function print_order_table() {
        global $con;
        $fetch_records_qry = "select * from orders";
        $fetch_records_qry_result = mysqli_query($con, $fetch_records_qry);

        $html = '';
        while ($record_arr = mysqli_fetch_array($fetch_records_qry_result)) {
            $user_id = $record_arr['user_id'];
            $html.='
                <tr>
                    <td>'.get_user_name($user_id).'</td>
                    <td>'.$record_arr['grand_total'].'</td>
                    <td>'.$record_arr['order_status'].'</td>
                    <td>'.$record_arr['payment_method'].'</td>
                    <td>'.$record_arr['created_date'].'</td>
                    <td>'.$record_arr['updated_date'].'</td>
                </tr>';
        }
        echo $html;
    }
?>

    <div class="container table-container">
        <h1 class="text-center font-weight-light pt-4 pb-5">Manage Orders</h1>
        <table class="table table-bordered" id="admin-data-table">
            <thead>
            <tr>
                <th>User Name</th>
                <th>Grand total</th>
                <th>Order Status</th>
                <th>Payment Method</th>
                <th>Created Date</th>
                <th>Modified Date</th>
            </tr>
            </thead>
            <tbody>
            <?php
                print_order_table();
            ?>
            </tbody>
        </table>
</div>



<?php
    include_once './../inc/sidebar-end.php';
    include_once './../inc/footer.php';
?>
