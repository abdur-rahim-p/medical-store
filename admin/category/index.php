<?php
    include_once './../inc/constants.php';
    include_once './../inc/connection.php';
    include_once './../inc/functions.php';
    include_once './../inc/header.php';
    include_once './../inc/sidebar.php';

    //Check if admin is logged out or not
    admin_logged_out();



    function print_category_table() {
        global $con;
        $fetch_records_qry = "select * from category";
        $fetch_records_qry_result = mysqli_query($con, $fetch_records_qry);

        $html = '';
        while ($record_arr = mysqli_fetch_array($fetch_records_qry_result)) {
            $status = $record_arr['status'] == 1 ? 0 : 1;
            $checked = $record_arr['status'] == 1?'checked':'';
            $operation_links = "<a href='./category/edit_category.php?category_id==".$record_arr['category_id']."'>Edit</a> | <a href='javascript:void(0)' id='delete-data-link' tbl_name='category' data-id=".$record_arr["category_id"]." data-image=".$record_arr["category_image"].">Delete</a> | ";
            if(is_admin()==true) {
                $operation = $operation_links;
            }
            elseif (is_subscriber()==true) {
                $operation = "<p><small>You are not allowed to edit or delete category.</small></p>";
            }
            else {
                $operation = "";
            }

            $html.='
                <tr>
                    <td>'.$record_arr['category_name'].'</td>
                    <td>'.$record_arr['category_description'].'</td>
                    <td><a data-fancybox="gallery" href='.CATEGORY_IMG_URL.$record_arr["category_image"].'><img src='.CATEGORY_IMG_URL.$record_arr['category_image'].' alt="category-img"></a></td>
                    <td>'.$record_arr['created_date'].'</td>
                    <td>'.$record_arr['updated_date'].'</td>
                    <td><input id="toggle-status" '.$checked.' status='.$status.' data-id='.$record_arr["category_id"].' data-toggle="toggle" data-on="Enabled" data-off="Disabled" type="checkbox" class="change-status" tbl_name="category"></td>
                    <td>'.$operation.'</td>
                </tr>';
        }
        echo $html;
    }
    $insert_category_btn_link = "<a href='".ADMIN_URL."category/insert_category/' class='btn my-3'>Add New Category</a>";
    $insert_category_btn = is_admin()==true?"$insert_category_btn_link":'';
?>

    <div class="container table-container">
        <h1 class="text-center font-weight-light pt-4">Manage Category</h1>
        <?php
            if(isset($_REQUEST['success'])) {
                print_success_message("delete");
            }
            echo $insert_category_btn;
        ?>
        <table class="table table-bordered" id="admin-data-table">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Category Description</th>
                    <th>Category Image</th>
                    <th>Creation Date</th>
                    <th>Modified Date</th>
                    <th>Status</th>
                    <th>Operation</th>
                 </tr>
            </thead>
            <tbody>
            <?php
                print_category_table();
            ?>
            </tbody>
        </table>
    </div>
<?php
    include_once './../inc/sidebar-end.php';
    include_once './../inc/footer.php';
?>


