<?php

	

	// Defining constant for image path
    define('images','./admin/assets/images/product_images/');

	include_once './inc/connection.php';
	include_once './inc/commons.php';
	include_once './inc/header.php';
	include_once './inc/nav.php';

	if(!isset($_SESSION['is_logged_in_user']) || $_SESSION['is_logged_in_user'] != 1) {
		?>
			<script type="text/javascript">
				window.location = './index';
			</script>
		<?php
	}

	
	// fetch user id
	function fetch_user_id()
	{
		global $connect;
		
		$fetch_user_id_query = "select * from user_details where user_name = '$_SESSION[user_name]' and user_password = '$_SESSION[user_password]' and status=1";
		$fetch_user_id_query_result = mysqli_query($connect,$fetch_user_id_query);
		$fetch_user_id_query_result_arr = mysqli_fetch_assoc($fetch_user_id_query_result); 
		$GLOBALS['user_id'] = $fetch_user_id_query_result_arr['user_id'];				
	}
	fetch_user_id();

	// Function to display orders
	function display_orders() {	
		global $user_id;
		global $connect;
		global $currency;
		//$fetch_order_qry = "select orders.order_id , orders.user_id , orders.grand_total , order_items.* , product.* from orders , order_items , product  where orders.order_id = order_items.order_id and order_items.product_id = product.product_id and orders.user_id = '$user_id' ";

		$fetch_order_qry = "select orders.grand_total , product.product_name , product.product_image ,  product.product_price , order_items.quantity , order_items.product_total_price , order_items.created_date from orders , order_items , product where orders.order_id = order_items.order_id and orders.user_id='$user_id' and product.product_id = order_items.product_id and orders.order_status = 'pending'";

		$fetch_order_qry_result = mysqli_query($connect , $fetch_order_qry);

		$html = '';

		// check If there are no orders in user account
		if(mysqli_num_rows($fetch_order_qry_result) > 0) {

			$html.='
				<table>
	                <thead>
	                    <tr>
	                        <th>Product Name</th>
	                        <th>Product image</th>
	                        <th>Product price</th>
	                        <th>Quantity</th>
	                        <th>Product Total price</th>
	                        <th>Purchase Date</th>
	                    </tr>
	                </thead>
	                <tbody>
			';

			// Fetch account orders
			while($fetch_order_qry_arr = mysqli_fetch_assoc($fetch_order_qry_result)) {	
				$html.='
	                    <tr>
	                        <td>'.$fetch_order_qry_arr['product_name'].'</td>
	                        <td>
	                            <div class="cv-cart-img">
	                                <img src='.images.$fetch_order_qry_arr['product_image'].' alt="image" class="img-fluid">
	                            </div>
	                        </td>
	                        <td>'.$currency.$fetch_order_qry_arr['product_price'].'</td>
	                        <td>'.$fetch_order_qry_arr['quantity'].'</td>
	                        <td>'.$currency.$fetch_order_qry_arr['product_total_price'].'</td> 
	                        <td>'.$fetch_order_qry_arr['created_date'].'</td> 
	               		</tr>';
				$grand_total = $currency.$fetch_order_qry_arr['grand_total'];

			}

			$html.='		<tr>
								<td colspan="5">Grand Total:</td>
								<td>'.$grand_total.'</td>
							</tr>
						</tbody>
			        </table>

			';
		}
		else {
			$html.='
				<div class="cv-banner-two-text">
					<h1>There are no orders in your account.</h1>
				</div>';
		}
		echo $html;
	}

	?>



	<!--breadcrumb starts-->
	<div class="cv-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cv-breadcrumb-box">
                        <h1>My account</h1>
                        <ul>
                            <li><a href="./index">Home</a></li>
                            <li>My account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumb ends-->
    <div class="cv-account spacer-top spacer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                	<div class="cv-last-order spacer-top-less">
			            <div class="cv-heading">
			                <h1>Your last orders</h1>
			                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			            </div>
			            <?php
							display_orders();
			            ?>
			        </div>
                </div>
            </div>
        </div>
    </div>

<?php
    include_once './inc/footer.php';
?>