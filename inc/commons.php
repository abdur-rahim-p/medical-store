<?php
	 function display_currency_symbol()
    {
        global $connect;
        $fetch_currency_query = "select field_value from website_global where field_name = 'default_currency'";
        $fetch_currency_result = mysqli_query($connect,$fetch_currency_query);
        while($arr = mysqli_fetch_object($fetch_currency_result))
        {
            $GLOBALS['currency'] =  $arr->field_value;
        }

    }
    /*-----Display currency symbol function callback---*/
    display_currency_symbol();

    // Function for displaying products
	function display_products()
    {
        global $connect;
        global $currency;
        $fetch_product_qry = "select * from product where status=1 limit 8";
        $display_product_result = mysqli_query($connect, $fetch_product_qry);
        while ($arr = mysqli_fetch_array($display_product_result)) 
        {
            ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="cv-product-box">
                        <div class="cv-product-img">
                            <?php echo "<img src='./admin/assets/images/product_images/" . $arr['product_image'] . "' alt='image' class='img-fluid'>" ?>
                            <div class="cv-product-button">
                                <a href="product_single.php?product_id=<?php echo $arr['product_id']; ?>" class="cv-btn">View detail</a>
                                <a href="javascript:void(0)" class="cv-btn add-to-cart-btn" product_id="<?php echo $arr['product_id']; ?>" disabled>add to Cart</a>
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

    // Function for displaying categories in footer widget
	function display_footer_categories()
    { 
        global $connect;
        $fetch_category_qry = "select * from category where status=1";
        $fetch_category_result = mysqli_query($connect, $fetch_category_qry);
        while ($arr = mysqli_fetch_array($fetch_category_result)) 
        {
            ?>
            <li><a href="javascript:void(0)"><?php echo $arr['category_name'];  ?></a></li>
            <?php
        }
    }

  
    // Function to display forum topics
    function display_forum_topics() {
        global $connect;
        $forum_topic_qry = "select forum_title from forum_tbl";
        $forum_topic_qry_result = mysqli_query($connect,$forum_topic_qry);
        $html = '';
        while ($forum_title_arr = mysqli_fetch_array($forum_topic_qry_result)) {
                $html.='<li><a href="javascript:void(0)">'.$forum_title_arr['forum_title'].'</a></li>';
        }
        echo $html;
    }

?>