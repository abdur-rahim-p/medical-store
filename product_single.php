<?php   
    include_once './inc/connection.php';
	include_once './inc/commons.php';

	$product_id = $_REQUEST['product_id'];

	if(empty($product_id))
	{
		header("location:./index");
	}

	// Function for displaying single product 
	function display_single_product()
	{
		global $connect;
		global $product_id;
        global $currency;

        $single_product_qry = "select * from product where product_id='$product_id' and status=1";
        $single_product_result = mysqli_query($connect, $single_product_qry);

        while ($arr = mysqli_fetch_array($single_product_result)) {
        	?>
        	<div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="cv-pro-thumb-img">
                                <?php 
                                echo "<a data-fancybox='gallery' href='./admin/assets/images/product_images/".$arr['product_image']."' '>";
                                echo "<img src='./admin/assets/images/product_images/" . $arr['product_image'] . "' alt='image' class='img-fluid'>" ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="cv-prod-content">
                                <h2 class="cv-price-title"><?php echo $arr['product_name'] ?></h2>
                                <p class="cv-pdoduct-price"><?php echo $currency.$arr['product_price'] ?></p>
                                <div class="cv-prod-category">
                                    <span>Category :</span>
                                    <a href="#" class="cv-prod-category">Face Mask</a>,
                                    <a href="#" class="cv-prod-category">Body Cover</a>
                                </div>
                                
                            </div>
                            <div class="cv-prod-count">
                                <div class="cv-cart-quantity">
                                    <button class="cv-sub"></button>
                                    <input type="number" value="1" min="0" id="product_quantity">
                                    <button class="cv-add"></button>
                                </div>
                                <button class="cv-btn btn-single-product" product_key="<?php echo $arr['product_id'] ?>">add to cart</button>
                            </div>
                        </div>
                        <div class="col-md-12">    
                            <div class="cv-prod-text">
                                <p><?php echo $arr['product_description'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <?php
        }
	}

	function display_related_products()
	{
		global $connect;
		global $product_id;
        global $currency;
		
		// Fetching category id to display related products 
		$qry = "select category_p_id from product where product_id='$product_id'";
		$result = mysqli_query($connect,$qry);
		$row = $result->fetch_row();
		$category_p_id = $row[0];
		

		// Fetching related products
		$related_product_query = "select * from product where category_p_id='$category_p_id' and status=1";
		$related_product_result = mysqli_query($connect,$related_product_query);
		while ($arr = mysqli_fetch_array($related_product_result)) {
				?>
				<div class="swiper-slide">
                    <div class="cv-product-box">
                        <div class="cv-product-img">
                            <?php echo "<img src='./admin/assets/images/product_images/" . $arr['product_image'] . "' alt='image' class='img-fluid'>" ?>
                            <div class="cv-product-button">
                                <a href="product_single.php?product_id=<?php echo $arr['product_id']; ?>" class="cv-btn">View detail</a>
                                <a href="javascript:void(0)" class="cv-btn add-to-cart-btn" product_id="<?php echo $arr['product_id']; ?>">add to Cart</a>
                            </div>
                        </div>
                        <div class="cv-product-data">
                            <a href="javascript:;" class="cv-price-title"><?php echo $arr['product_name'] ?></a>
                            <p class="cv-pdoduct-price"><?php echo $currency.$arr['product_price'] ?></p>    
                        </div>
                    </div>
                </div>
                <?php
		}

	}
    include_once './inc/header.php';
    include_once './inc/nav.php';
?>
<!-- preloader start -->
<div class="cv-ellipsis">
    <div class="cv-preloader">
        <div></div>
    </div>
</div>
<!-- preloader end -->
<!-- main wrapper start -->
<div class="cv-main-wrapper">
	<!-- breadcrumb start -->
    <div class="cv-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cv-breadcrumb-box">
                        <h1>Product Single</h1>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Product Single</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end-->
    <!-- shop start -->
    <div class="cv-product-single spacer-top spacer-bottom">
        <div class="container">
			<?php
				display_single_product();
			?>            
            <!---
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="cv-pro-thumb-img">
                                <img src="assets/images/product2.jpg" alt="image" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="cv-prod-content">
                                <h2 class="cv-price-title">Plastic face shield</h2>
                                <p class="cv-pdoduct-price">$165</p>
                                <div class="cv-prod-category">
                                    <span>Category :</span>
                                    <a href="#" class="cv-prod-category">Face Mask</a>,
                                    <a href="#" class="cv-prod-category">Body Cover</a>
                                </div>
                                
                            </div>
                            <div class="cv-prod-count">
                                <div class="cv-cart-quantity">
                                    <button class="cv-sub"></button>
                                    <input type="number" value="1" min="1">
                                    <button class="cv-add"></button>
                                </div>
                                <button class="cv-btn">add to cart</button>
                            </div>
                        </div>
                        <div class="col-md-12">    
                            <div class="cv-prod-text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        	-->
        </div>
    </div>
    <!-- shop end -->
    <!-- related product start -->
    <div class="cv-arrival cv-related-product cv-product-slider spacer-top-less">
        <div class="container">
            <div class="cv-heading">
                <h1>Related products</h1>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                        	<?php
                        		 display_related_products();
                        	?>
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- related product end -->




</div>
<!-- main wrapper end -->
<?php
	include_once './inc/footer.php';
?>
