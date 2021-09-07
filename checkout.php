<?php
	include_once './inc/connection.php';
	include_once './inc/commons.php';
	include_once './inc/header.php';
	include_once './inc/nav.php';


		// Check if cart is not empty
		if(empty($_SESSION['grand_total']) || empty($_SESSION['cart']))
		{
			?>
				<script type="text/javascript">
					location.href = "./index";
				</script>
			<?php
		}

		// fetch user id
		function fetch_user_id()
		{
			global $connect;
			
			$fetch_user_id_query = "select user_id from user_details where user_name = '$_SESSION[user_name]' and user_password = '$_SESSION[user_password]' and status=1";
			$fetch_user_id_query_result = mysqli_query($connect,$fetch_user_id_query);
			$fetch_user_id_query_result_arr = mysqli_fetch_assoc($fetch_user_id_query_result); 
			$GLOBALS['user_id'] = $fetch_user_id_query_result_arr['user_id'];		
		}
	


		// Function to display login notice
		function display_login_notice()
		{
			?>
				<div class="cv-main-wrapper">
					<div class="container">
			            <div class="cv-heading">
			                <h1 class="pt-5">Please Login to your account before checkout.</h1>
			            </div>
				    </div>
				</div>
			<?php
		}

		// Function to insert order
		function insert_order()
		{
			global $user_id;
			global $connect;
			
			// Insert order
			$insert_order_qry = "insert into orders (user_id,grand_total) values('$user_id','$_SESSION[grand_total]')";
			$insert_order_qry_result = mysqli_query($connect,$insert_order_qry);

			$order_id = mysqli_insert_id($connect);
			
			$cart = $_SESSION['cart'];

			// Check ig order has been inserted or not
			if($insert_order_qry_result)
			{
				foreach ($cart as $key => $value) {
					$product_id = $value['product_id'];
					$quantity = $value['quantity'];

					// Get product price
					$get_product_price_qry = "select product_price from product where product_id='$product_id'";
					$get_product_price_result = mysqli_query($connect,$get_product_price_qry);
					$get_product_price = mysqli_fetch_assoc($get_product_price_result);
					// Get product total price 
					$product_price =  $get_product_price['product_price'];
					$product_total_price = $quantity * $product_price;
		
					// Insert order itmes
					$insert_order_items_qry = "insert into order_items (order_id,product_id,quantity,product_total_price) values ('$order_id','$product_id','$quantity','$product_total_price')";
					$insert_order_items_qry_result = mysqli_query($connect,$insert_order_items_qry);
					if($insert_order_qry_result)
					{
						unset($_SESSION['cart']);
						unset($_SESSION['total_count']);
						unset($_SESSION['grand_total']);
						?>
							<script type="text/javascript">
								alert('Order has been placed successfully.See your order from menu.');
								window.location ='./index';
							</script>
						<?php
					}
					else
					{
						?>
							<script type="text/javascript">
								alert('There was an error during placing the order.');
							</script>
						<?php
					}
				}
			}
			else
			{
				echo "<script>alert('There was an error during placing the order')</script>";
			}
				

		}

	

		// Function to display cart
		function display_cart()
		{
			global $connect;
			global $currency;
			if(isset($_SESSION['cart']))
			{
				if(isset($_POST['place-order-btn']))
				{
					insert_order();
					
				}

				$cart = $_SESSION['cart'];
				$html = '';
				$html.='
				<div class="cv-order-detail spacer-top-less spacer-bottom">
			        <div class="container">
			            <div class="cv-heading">
			                <h1>product details</h1>
			                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			            </div>
			            <div class="row">
			                <div class="col-md-12">
			                    <div class="cv-last-order">
			                        <table>
			                            <thead>
			                                <tr>
			                                    <th>Product name</th>
			                                    <th>unit price</th>
			                                    <th>Quantity</th>
			                                    <th>Total</th>
			                                </tr>
			                            </thead>
			                            <tbody>
				';

				foreach ($cart as $key => $value) {
					// Fetch cart details
					$cart_table_qry = "select * from product where product_id=$value[product_id] and status=1";
                    $cart_table_qry_result = mysqli_query($connect,$cart_table_qry); 
                    $cart_table_arr = mysqli_fetch_assoc($cart_table_qry_result);    


					$html.='<tr>
	                            <td>'.$cart_table_arr['product_name'].'</td>
	                            <td>'.$currency.$cart_table_arr['product_price'].'</td>
	                            <td>'.$value['quantity'].'</td>
	                            <td>'.$currency.$value['quantity'] * $cart_table_arr['product_price'].'</td>
	                        </tr>';
				}
					$html.='<tr>
                                <td colspan="2" class="cv-d-none"></td>
                                <td><b>Grand Total</b></td>
                                <td class="cv-price">'.$currency.$_SESSION['grand_total'].'</td>
                            </tr>
										</tbody>
									</table>
                    			</div>
		                    <div class="cv-cart-btn">
		                    <form method="post" action='.$_SERVER['PHP_SELF'].'>
		                        <input href="javascript:void(0)" class="cv-btn place-order-btn" type="submit" value="place order" name="place-order-btn">
		                    </form>
		                    </div>
		                </div>
		            </div>
		            <p class="font-weight-bold">Only COD(Cash on delivery) payment mehod is available.</p>
		        </div>
		    </div>';
				
			}
			else
			{
				$html ='';
			}
			echo $html;
		}
		
		// Function to display checkout
		function display_checkout()
		{
			fetch_user_id();
			global $user_id;
			global $connect;
			$fetch_user_detail_query = "select * from user_details where user_id='$user_id' and status=1";
			$fetch_user_detail_query_result = mysqli_query($connect,$fetch_user_detail_query);
			// Print user account details

			if(mysqli_num_rows($fetch_user_detail_query_result) == 1)
			{
				$arr = mysqli_fetch_assoc($fetch_user_detail_query_result);
				$html = '';

				$html.='<div class="cv-account-box">
	                        <div class="cv-account-text">
	                            <div class="cv-ac-user-name">
	                                <h2>'.$arr['user_name'].'</h2>
	                            </div>
	                            <div class="cv-account-info">
	                                <ul>
	                                    <li>
	                                        <p>Mobile no. :</p>
	                                        <p>'.$arr['user_phone'].'</p>
	                                    </li>
	                                    <li>
	                                        <p>Email :</p>
	                                        <p>'.$arr['user_email'].'</p>
	                                    </li>
	                                    <li>
	                                        <p>Permanent Address :</p>
	                                        <p>'.$arr['user_address'].'</p>
	                                    </li>
	                                    <li>
	                                        <p>Shipping Address :</p>
	                                        <p>'.$arr['user_delivery_address'].'</p>
	                                    </li>
	                                </ul>
	                            </div>
	                        </div>
                    	</div>
				';
			}
			echo $html;
		}


		
?>
			<div class="cv-main-wrapper">
				<!-- preloader start -->
				<div class="cv-ellipsis">
				    <div class="cv-preloader">
				        <div></div>
				    </div>
				</div>
				<!-- preloader end -->
					<!-- breadcrumb start -->
				    <div class="cv-breadcrumb">
				        <div class="container">
				            <div class="row">
				                <div class="col-12">
				                    <div class="cv-breadcrumb-box">
				                        <h1>Checkout</h1>
				                        <ul>
				                            <li><a href="./index">Home</a></li>
				                            <li>Checkout</li>
				                        </ul>
				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>
				    <!-- breadcrumb end -->
				    <!-- billing start -->
				    <div class="cv-billing spacer-top-less">
				        <div class="container">
				            <div class="cv-heading">
				                <h1>Billing Details</h1>
				                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				            </div>
				            <div class="row">
				                <div class="col-md-12">
				                <?php
				                	// Check if user is logged in
									if(isset($_SESSION['is_logged_in_user']) && isset($_SESSION['is_logged_in_user']) == 1)
									{
										display_checkout();
										display_cart();
									}
									else
									{
										display_login_notice();
									}
				                ?>
				                </div>
				            </div>
				        </div>
				    </div>
				    <!-- billing end -->
			</div>
<?php

	include_once './inc/footer.php';
?>