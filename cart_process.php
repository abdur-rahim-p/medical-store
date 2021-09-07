<?php
	session_start();
	include_once './inc/connection.php';
	include_once './inc/commons.php';

	 // Defining constant for image path
    define('images','./admin/assets/images/product_images/');

	// Process for add to cart from home page and shop page
	if(isset($_REQUEST['product_id']) && isset($_POST['action']) && isset($_POST['action']) == 'home_add_to_cart')
	{
		// Requesting product id & Quantity
		$product_id = $_REQUEST['product_id'];
		$quantity = isset($_REQUEST['quantity'])?$_REQUEST['quantity']:1;
		$product_array = array(
			'product_id' => $product_id , 
			'quantity' => $quantity
		);
		
		if(empty($_SESSION['cart']))
		{
			$_SESSION['cart'][0] = $product_array;
			$count = count($_SESSION['cart']);
			$_SESSION['total_count'] = $count;
			$cart_message = "Item added to cart successfully";
		}
		else
		{
			$cart_array_product_id = array_column($_SESSION['cart'],"product_id");
			if(!in_array($product_id,$cart_array_product_id))
			{
				/* check if product doesn't exist in cart then push array 
				   in cart session	
				*/
				array_push($_SESSION['cart'],$product_array);
				$count = count($_SESSION['cart']);
				$_SESSION['total_count'] = $count;
				$cart_message = "Item added to cart successfully";
			}
			else
			{
				/*-- If product aleready added to cart from any page then
				 update it's quantity--- */
				
				//$cart_message = "Item aleready added to cart";
				$cart = $_SESSION['cart'];
				foreach ($cart as $key => $value) {
					if($value['product_id'] == $product_id)
					{
						$value['quantity'] =  $quantity + $value['quantity'];
						$new_product_array = array(
							'product_id' => $product_id , 
							'quantity' => $value['quantity']
						);
						$product_array =  array_merge($product_array,$new_product_array);
						$_SESSION['cart'][$key] = $product_array;
						
					}					
				}

				$count = count($_SESSION['cart']);
				$_SESSION['total_count'] = $count;
				$cart_message = "Item quantity updated successfully";	

			}		
		}	
		print json_encode(array('cart_count' => $_SESSION['total_count'] , 'cart_message_r' => $cart_message));
		
	}
	

	// Process for removing product from cart
	if(isset($_REQUEST['product_cart_array_id']) && isset($_POST['action']) && isset($_POST['action'] )=='remove_from_cart')
	{
		$product_cart_array_id = $_REQUEST['product_cart_array_id'];
		
		// Function for update cart after removing product from cart table
		function update_cart_after_remove()
		{
			$GLOBALS['html'] = '';
			global $connect;
			global $currency;
        	
        	$total = 0;
        	
        	if(isset($_SESSION['cart']))
      		{
        		$cart_table = $_SESSION['cart'];
	        	foreach ($cart_table as $key => $value) 
	        	{
	            	$cart_table_qry = "select * from product where product_id=$value[product_id] and status=1";
	            	$cart_table_qry_result = mysqli_query($connect,$cart_table_qry); 
	            	$cart_table_arr = mysqli_fetch_assoc($cart_table_qry_result);        
	    			
	    		$GLOBALS['html'].= '<tr>
	    					<td>
	                    		<a id="remove-cart-product" product_key='.$key.'>
	                        		<i class="fas fa-trash-alt remove-cart-icon"></i>
	                    		</a>
	                		</td>
	                		<td>'.$cart_table_arr['product_name'].'</td>
	                		<td>
	                    		<div class="cv-cart-img">
			                        <img src='.images.''.$cart_table_arr['product_image'].'   alt="image" class="img-fluid">
	                    		</div>
	                		</td>
	                		<td>'.$currency.$cart_table_arr['product_price'].'</td>
	                		<td>
			                    <div class="cv-cart-quantity">
			                        <button class="cv-sub" id="quantity-btn"></button>
			                        <input type="number" value='.$value['quantity'].' min="1" id="quantity-val" cart_key='.$key.'>
			                        <button class="cv-add" id="quantity-btn"></button>
			                    </div>
			                </td>
			                <td id="total-price">'.$currency.($value['quantity'] * $cart_table_arr['product_price']).'</td>
	    				</tr>';
	    				$total = $total + ($value['quantity'] * $cart_table_arr['product_price']); 
	    				$_SESSION['grand_total'] = $total;
				}

				$GLOBALS['html'].='
					<tr>
		                <td colspan="5" class="cv-d-none"><b>Grand Total</b></td>
		                <td class="cv-price" id="grand-total">'.$currency.$total.'</td>
	            	</tr>
				';
			}
			if(empty($_SESSION['cart']))
			{
				$_SESSION['grand_total'] = 0;
				$GLOBALS['html']='
				<tr>
                	<td colspan="6">Your cart is empty. <a href="./index">Go back to home page.</a></td>
            	</tr>';
			}
		}

		if(isset($_SESSION['cart']) && isset($_SESSION['total_count']))
		{
			unset($_SESSION['cart'][$product_cart_array_id]);
			$count = count($_SESSION['cart']);
			$_SESSION['total_count'] = $count;
			$cart_message = "Item has been removed from cart";
			// Function call back to update cart after remove product
			update_cart_after_remove();
			print json_encode(array('cart_count' => $_SESSION['total_count'] , 'cart_message_r' => $cart_message , 'updated_cart' => $html));
		
		}
		else
		{
			$cart_message = "There was problem with removing product";
		}

	}
	
	// Process for adding product to cart from single product page
	if(isset($_REQUEST['product_single_id']) && isset($_POST['action']) && isset($_POST['action']) == 'add_from_single_page' && isset($_REQUEST['quantity']) )
	{
		$product_id = $_REQUEST['product_single_id'];
		$quantity = $_REQUEST['quantity'];
		$product_array = array(
				'product_id' => $product_id , 
				'quantity' => $quantity
			);

		if(empty($_SESSION['cart']))
		{
			// If cart is empty then store first product in cart session
			$_SESSION['cart'][0] = $product_array;
			$count = count($_SESSION['cart']);
			$_SESSION['total_count'] = $count;
			$cart_message = "Item added to cart successfully";
		}
		else
		{
			$cart_array_product_id = array_column($_SESSION['cart'],"product_id");
			if(!in_array($product_id,$cart_array_product_id))
			{
				/* check if product doesn't exist in cart then push array 
				   in cart session	
				*/

				array_push($_SESSION['cart'],$product_array);
				$count = count($_SESSION['cart']);
				$_SESSION['total_count'] = $count;
				$cart_message = "Item added to cart successfully";
			}
			else
			{
				/*-- If product aleready added to cart from any page then
				 update it's quantity--- */
				
				$cart = $_SESSION['cart'];
				foreach ($cart as $key => $value) {
					if($value['product_id'] == $product_id)
					{
						$value['quantity'] =  $quantity + $value['quantity'];
						$new_product_array = array(
							'product_id' => $product_id , 
							'quantity' => $value['quantity']
						);
						$product_array =  array_merge($product_array,$new_product_array);
						$_SESSION['cart'][$key] = $product_array;
						
					}					
				}

				$count = count($_SESSION['cart']);
				$_SESSION['total_count'] = $count;
				$cart_message = "Item quantity updated successfully";	
			}
		}	
		print json_encode(array('cart_count' => $_SESSION['total_count'] , 'cart_message_r' => $cart_message));
	}

	// Update cart products quantity through ajax 
	if(isset($_REQUEST['quantity']) && isset($_REQUEST['cart_key']) && isset($_POST['action']) && isset($_POST['action']) == 'update_cart')
	{
		function update_cart_table()
		{
			// Check if cart is not empty
			if(isset($_SESSION['cart']))
			{
				global $connect;
				global $currency;
				$quantity = $_REQUEST['quantity'];
				$cart_key = $_REQUEST['cart_key'];
				$cart = $_SESSION['cart'];
				$grand_total = 0;

				foreach ($cart as $key => $value) {
					$cart_table_qry = "select * from product where product_id=$value[product_id] and status=1";
		            $cart_table_qry_result = mysqli_query($connect,$cart_table_qry); 
		            $cart_table_arr = mysqli_fetch_assoc($cart_table_qry_result);
					
					if($key == $cart_key)
					{
						$_SESSION['cart'][$key]['quantity'] = $quantity;
						$product_total_price =  $currency.($quantity * $cart_table_arr['product_price']);
						
					}
					$grand_total = $grand_total + ($_SESSION['cart'][$key]['quantity'] * $cart_table_arr['product_price']);


				}
				$_SESSION['grand_total'] = $grand_total;
				print json_encode(array('product_total_price' => $product_total_price , 'cart_grand_total' => $currency.$grand_total));
			}
		}
		update_cart_table();
	}
?>

