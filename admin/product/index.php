<?php
    include_once './../inc/constants.php';
    include_once './../inc/connection.php';
    include_once './../inc/functions.php';
    include_once './../inc/header.php';
    include_once './../inc/sidebar.php';

    //Check if admin is logged out or not
    admin_logged_out();

    function print_product_table() {
        global $con;
        $fetch_records_qry = "select * from product";
        $fetch_records_qry_result = mysqli_query($con, $fetch_records_qry);


        $html = '';
        while ($record_arr = mysqli_fetch_array($fetch_records_qry_result)) {
            $status = $record_arr['status'] == 1 ? 0 : 1;
            $checked = $record_arr['status'] == 1?'checked':'';
            $operation_links = "<a href='./product/edit_product.php?product_id=".$record_arr['product_id']."'>Edit</a> | <a href='javascript:void(0)' id='delete-data-link' tbl_name='product' data-id=".$record_arr["product_id"]." data-image=".$record_arr["product_image"].">Delete</a> | ";
            $operation = is_admin()==true?"$operation_links":'';

            $html.='
                <tr>
                    <td>'.$record_arr['product_name'].'</td>
                    <td>'.$record_arr['product_description'].'</td>
                    <td><a data-fancybox="gallery" href='.PRODUCT_IMG_URL.$record_arr["product_image"].'><img src='.PRODUCT_IMG_URL.$record_arr['product_image'].' alt="product-img"></a></td>
                    <td>'.$record_arr['created_date'].'</td>
                    <td>'.$record_arr['updated_date'].'</td>
                    <td><input id="toggle-status" '.$checked.' status='.$status.' data-id='.$record_arr["product_id"].' data-toggle="toggle" data-on="Enabled" data-off="Disabled" type="checkbox" class="change-status" tbl_name="product"></td>
                    <td>'.$operation.'<a href="'.FRONTEND_SINGLE_PRODUCT_PAGE_URL.'?product_id='.$record_arr['product_id'].'" target="_blank">View</a></td>
                </tr>';
        }
        echo $html;
    }
    $insert_product_btn_link = "<a href='".ADMIN_URL."product/insert_product/' class='btn my-3'>Add New Product</a>";
    $insert_product_btn = is_admin()==true?"$insert_product_btn_link":'';
?>

    <div class="container table-container">
        <h1 class="text-center font-weight-light pt-4">Manage Product</h1>
            <?php
                if(isset($_REQUEST['success'])) {
                    print_success_message("delete");
                }
                echo $insert_product_btn;
            ?>
        <table class="table table-bordered" id="admin-data-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Product Image</th>
                    <th>Product Date</th>
                    <th>Modified Date</th>
                    <th>Status</th>
                    <th>Operation</th>
                 </tr>
            </thead>
            <tbody>
            <?php
                print_product_table();
            ?>
            </tbody>
        </table>
    </div>
<?php
    include_once './../inc/sidebar-end.php';
    include_once './../inc/footer.php';
?>


