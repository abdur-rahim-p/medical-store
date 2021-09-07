<?php
	include_once './inc/connection.php';
	include_once './inc/commons.php';
	include_once './inc/header.php';
	include_once './inc/nav.php';
    
    

    // Defining constant for image path
    define('images','./admin/assets/images/product_images/');

    // Function for displaying cart products 
    function display_cart_table()
    {
        global $connect;
        global $currency;

        if(isset($_SESSION['cart']))
        {
            $cart_table = $_SESSION['cart'];
            $total = 0;
                   
                foreach ($cart_table as $key => $value) {

                    $cart_table_qry = "select * from product where product_id=$value[product_id] and status=1";
                    $cart_table_qry_result = mysqli_query($connect,$cart_table_qry); 
                    $cart_table_arr = mysqli_fetch_assoc($cart_table_qry_result);        
            ?>
                    <tr>
                        <td>
                            <a id="remove-cart-product" product_key="<?php echo $key; ?>">
                                <i class="fas fa-trash-alt remove-cart-icon"></i>
                            </a>
                        </td>
                        <td>
                            <?php echo $cart_table_arr['product_name']; ?>
                        </td>
                        <td>
                            <div class="cv-cart-img">
                                <?php
                                    echo "<img src=".images."".$cart_table_arr['product_image'] . " alt='image' class='img-fluid'>"
                                ?>
                            </div>
                        </td>
                        <td><?php echo $currency.$cart_table_arr['product_price']; ?></td>
                        <td>
                            <div class="cv-cart-quantity">
                                <button class="cv-sub" id="quantity-btn"></button>
                                <input type="number" value="<?php echo $value['quantity']; ?>" min="1" id="quantity-val" cart_key="<?php echo $key; ?>">
                                <button class="cv-add" id="quantity-btn"></button>
                            </div>
                        </td>
                        <td id="total-price"><?php echo $currency.($value['quantity'] * $cart_table_arr['product_price']); ?></td>
                        
                    </tr>
            <?php
                    $total = $total + ($value['quantity'] * $cart_table_arr['product_price']);
                    $_SESSION['grand_total'] = $total;
                }
            
                    $grand_total = '
                        <tr>
                            <td colspan="5" class="cv-d-none"><b>Grand Total</b></td>
                            <td class="cv-price" id="grand-total">'.$currency.$total.'</td>
                        </tr>
                    ';
                    echo $grand_total;
            ?>        
            <?php
        }

    }
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
                        <h1>Cart</h1>
                        <ul>
                            <li><a href="./index">Home</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->
    <!-- cart start -->
    <div class="cv-cart spacer-top spacer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cv-last-order">
                        <i class="fas fa-spinner fa-spin"></i>
                        <table id="cart-table">
                            <thead>
                                <tr>
                                    <th colspan="2">Product name</th>
                                    <th>Product image</th>
                                    <th>Product price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    display_cart_table();
                                ?>
                            </tbody>
                        </table>
                    </div>                      
                    <div class="cv-cart-btn">
                        <a href="./checkout" class="cv-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart end -->
</div>
<!-- main wrapper end -->

<?php
	include_once './inc/footer.php';	
?>