<?php
	include_once './inc/connection.php';
	include_once './inc/commons.php';
	

    // Function for fill dropdown dynamilcally
    function category_dropdown()
    {
    	global $connect;
        $qry = "select category_id,category_name from category where status=1";
        $result = mysqli_query($connect, $qry);
        while ($arr = mysqli_fetch_array($result)) 
        {
        	?>
        	<option value="<?php echo $arr['category_id'] ?>"><?php echo $arr['category_name']; ?></option>
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
	                    <h1>Shop</h1>
	                    <ul>
	                        <li><a href="index">Home</a></li>
	                        <li>Shop</li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- breadcrumb end -->
	<!-- shop start -->
	<div class="cv-shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="cv-shop-box">
                        <div class="cv-shop-title">
                            <h2 class="cv-sidebar-title">Showing results</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                	<div class="form-group">
					    <select class="form-control" id="shop-category">
					      	<option value="" selected="">All</option>
					      	<?php
					      		category_dropdown();
					      	?>
					    </select>
				  </div>
                </div>
            </div>
            <!-- shop end -->
			<div class="row" id="shop-products">
		        <?php
		                display_products();
		        ?>
		        <i class="fas fa-spinner fa-spin"></i>
		    </div>
		    <!--Shop end-->
        </div>
	</div>
	<div class="row mb-5">
		<div class="col-lg-12 center-align">
			<a href="javascript:void(0)" class="cv-btn" id="see-products">See All Products</a>
		</div>
	</div>
	

</div>
<?php
	include_once './inc/footer.php';
?>