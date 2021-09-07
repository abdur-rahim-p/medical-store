<?php
	include_once './inc/connection.php';
	include_once './inc/commons.php';

	if(isset($_POST['category_p_id']) && isset($_POST['type']) && isset($_POST['type']) == 'categorize_product')
	{
	    $category_p_id = $_REQUEST['category_p_id'];
		$fetch_products_query = "select * from product where category_p_id='$category_p_id' and status=1";
		$fetch_products_result = mysqli_query($connect,$fetch_products_query);
		$html = '';
		while ($arr = mysqli_fetch_array($fetch_products_result)) {	
			$html.='<div class="col-lg-3 col-sm-6">
	                    <div class="cv-product-box">
	                        <div class="cv-product-img">
	                             <img src=./admin/assets/images/product_images/'.$arr['product_image'].' alt="image" class="img-fluid"> 
	                            <div class="cv-product-button">
	                                <a href="product_single.php?product_id='.$arr['product_id'].'" class="cv-btn">View detail</a>
	                                <a href="#" class="cv-btn add-to-cart-btn" product_id='.$arr['product_id'].'>add to Cart</a>
	                            </div>
	                        </div>
	                        <div class="cv-product-data">
	                            <a href="javascript:;" class="cv-price-title">'.$arr['product_name'].'</a>
	                            <p class="cv-pdoduct-price">'.$currency.$arr['product_price'].'</p>                    
	                        </div>
	                    </div>
                	</div>';
		}
		echo $html;
	}
	if(empty($_POST['category_p_id']))
	{
		$fetch_products_query = "select * from product where status=1";
		$fetch_products_result = mysqli_query($connect,$fetch_products_query);
		$html = '';
		while ($arr = mysqli_fetch_array($fetch_products_result)) {	
			$html.='<div class="col-lg-3 col-sm-6">
	                    <div class="cv-product-box">
	                        <div class="cv-product-img">
	                             <img src=./admin/assets/images/product_images/'.$arr['product_image'].' alt="image" class="img-fluid"> 
	                            <div class="cv-product-button">
	                                <a href="product_single.php?product_id='.$arr['product_id'].'" class="cv-btn">View detail</a>
	                                <a href="#" class="cv-btn add-to-cart-btn" product_id='.$arr['product_id'].'>add to Cart</a>
	                            </div>
	                        </div>
	                        <div class="cv-product-data">
	                            <a href="javascript:;" class="cv-price-title">'.$arr['product_name'].'</a>
	                            <p class="cv-pdoduct-price">₹'.$currency.$arr['product_price'].'</p>                    
	                        </div>
	                    </div>
                	</div>';
		}
		echo $html;
	}

?>