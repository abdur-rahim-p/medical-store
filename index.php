<?php   
    include_once './inc/connection.php';
    include_once './inc/commons.php';
    include_once './inc/header.php';
    include_once './inc/nav.php';
    
    // Fetch default currency



    // Declaring function to display store's new arrivals
    function display_new_arrivals()
    {
        global $connect;
        global $currency;
        $qry = "select * from product limit 20 offset 10";
        $result = mysqli_query($connect, $qry);
        while ($arr = mysqli_fetch_array($result)) 
        {
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
                        <a href="product_single.php?product_id=<?php echo $arr['product_id']; ?>" class="cv-price-title"><?php echo $arr['product_name'] ?></a>
                        <p class="cv-pdoduct-price"> <?php echo $currency.$arr['product_price'] ?></p>
                    </div>
                </div>
            </div>
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
    <!-- banner start -->
    <div class="cv-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="cv-banner-two-text cv-banner-three-text">
                        <p class="cv-banner-cat">Upto 50% Off On Every Product</p>
                        <h1>Medical personal protective equipment</h1>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                        <button class="cv-btn">Shop now</button>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="cv-banner-img-three">
                        <img src="./images/banner3.png" alt="images" class="img-fluid"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->
    <!-- feature start -->
    <div class="cv-feature-two">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="cv-feature-box">
                        <div class="cv-feature-img">
                            <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><path d="m59 54.141v-9.141h-5v-6h-12v-11h-7l-10.506-6.304c.237-3.338-1.585-6.518-4.583-8.012 2.376-.799 4.089-3.039 4.089-5.684 0-.369-.038-.728-.102-1.078l2.357-.506c1.08-.232 1.767-1.295 1.535-2.375l-4.584.985c-1.095-1.913-3.208-3.168-5.604-3.013-2.913.188-5.341 2.568-5.581 5.477-.245 2.97 1.676 5.528 4.353 6.281-2.503 1.56-3.942 4.468-3.538 7.498l1.164 8.731-1 12-6 19v1h7l-1-3h-.333l2.685-8.054.648 11.054h7l-1-3h-1.871l1.871-29 1.485-4.419 11.515 5.419h5v24.38c-.615.703-1 1.613-1 2.62 0 2.209 1.791 4 4 4s4-1.791 4-4c0-.732-.211-1.41-.555-2h8.109c-.343.59-.554 1.268-.554 2 0 2.209 1.791 4 4 4s4-1.791 4-4c0-1.862-1.278-3.413-3-3.859zm-16 4.859c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1zm5-16h-4v-2h4zm10 16c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z"/></svg>
                        </div>
                        <div class="cv-feature-text">
                            <h3>Free Shipping</h3>
                            <p>When order is over $199</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="cv-feature-box">
                        <div class="cv-feature-img">
                            <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><path d="m0 141.356h422v30h-422z"/><path d="m422 102.356c0-24.813-20.187-45-45-45h-332c-24.813 0-45 20.187-45 45v9h422z"/><path d="m421 242.643c.334 0 .666.01 1 .013v-41.299h-422v123c0 24.813 20.187 45 45 45h255.138c-.089-1.894-.139-3.798-.139-5.713.001-66.721 54.281-121.001 121.001-121.001zm-346-11.286h37.5c8.284 0 15 6.716 15 15s-6.716 15-15 15h-37.5c-8.284 0-15-6.716-15-15s6.716-15 15-15zm85 77.999h-85c-8.284 0-15-6.716-15-15s6.716-15 15-15h85c8.284 0 15 6.716 15 15s-6.716 15-15 15z"/><path d="m421 272.643c-50.178 0-91 40.823-91 91 0 50.178 40.823 91 91 91s91-40.823 91-91-40.823-91-91-91zm43.607 83.277-36 36c-2.929 2.929-6.768 4.394-10.606 4.394s-7.678-1.464-10.606-4.394l-18.5-18.5c-5.858-5.858-5.858-15.355 0-21.213 5.857-5.858 15.355-5.858 21.213 0l7.894 7.894 25.394-25.394c5.857-5.858 15.355-5.858 21.213 0 5.855 5.858 5.855 15.355-.002 21.213z"/></g></svg>
                        </div>
                        <div class="cv-feature-text">
                            <h3>Payment method</h3>
                            <p>100% safe and secure</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="cv-feature-box">
                        <div class="cv-feature-img">
                            <svg viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg"><path d="m96 16a80.2 80.2 0 0 1 64 32h-8v16h24a8 8 0 0 0 7.59-5.47l8-24-15.18-5.06-3.175 9.53a95.994 95.994 0 0 0 -173.235 57h16a80.091 80.091 0 0 1 80-80z"/><path d="m176 96a80 80 0 0 1 -144 48h8v-16h-24a8 8 0 0 0 -7.59 5.47l-8 24 15.18 5.06 3.175-9.53a95.994 95.994 0 0 0 173.235-57z"/><path d="m40 96a56 56 0 1 0 56-56 56.063 56.063 0 0 0 -56 56zm80-32v16h-28a4 4 0 0 0 0 8h8a20 20 0 0 1 4 39.6v8.4h-16v-8h-16v-16h28a4 4 0 0 0 0-8h-8a20 20 0 0 1 -4-39.6v-8.4h16v8z"/></svg>
                        </div>
                        <div class="cv-feature-text">
                            <h3>15 days return</h3>
                            <p>Lorem ipsum dolar sit</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="cv-feature-box">
                        <div class="cv-feature-img">
                            <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m512 346.5c0-63.535156-36.449219-120.238281-91.039062-147.820312-1.695313 121.820312-100.460938 220.585937-222.28125 222.28125 27.582031 54.589843 84.285156 91.039062 147.820312 91.039062 29.789062 0 58.757812-7.933594 84.210938-23.007812l80.566406 22.285156-22.285156-80.566406c15.074218-25.453126 23.007812-54.421876 23.007812-84.210938zm0 0"/><path d="m391 195.5c0-107.800781-87.699219-195.5-195.5-195.5s-195.5 87.699219-195.5 195.5c0 35.132812 9.351562 69.339844 27.109375 99.371094l-26.390625 95.40625 95.410156-26.386719c30.03125 17.757813 64.238282 27.109375 99.371094 27.109375 107.800781 0 195.5-87.699219 195.5-195.5zm-225.5-45.5h-30c0-33.085938 26.914062-60 60-60s60 26.914062 60 60c0 16.792969-7.109375 32.933594-19.511719 44.277344l-25.488281 23.328125v23.394531h-30v-36.605469l35.234375-32.25c6.296875-5.761719 9.765625-13.625 9.765625-22.144531 0-16.542969-13.457031-30-30-30s-30 13.457031-30 30zm15 121h30v30h-30zm0 0"/></svg>
                        </div>
                        <div class="cv-feature-text">
                            <h3>24x7 support</h3>
                            <p>By qualified team</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- feature end -->
    <!-- self protection kit start -->
    <div class="cv-protection-kit cv-product-three">
        <div class="container">
            <div class="cv-heading">
                <h1>Our Medical Equipments</h1>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="row">
                <?php
                        display_products();
                ?>
            </div>
            <div class="row">
                <div class="col-lg-12 center-align">
                    <a href="./shop" class="cv-btn">See More</a>    
                </div>
            </div>
        </div>
    </div>
    <!-- self protection kit end -->
    <!---Hot deals start--->
    <div class="cv-deal spacer-top spacer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="cv-deal-box">
                        <h2>Flat 50% Off</h2>
                        <h3>Hurry up! limited time offer</h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                        <a href="./shop" class="cv-btn">buy now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Hot deals end-->
    <!-- new arrivals start -->
    <div class="cv-arrival cv-product-three cv-product-slider spacer-top-less">
        <div class="container">
            <div class="cv-heading">
                <h1>New arrivals</h1>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                        <?php
                            display_new_arrivals();
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
    <!-- new arrivals end -->
    <!-- testimonial start -->
    <div class="cv-testimonial cv-testimonial-two spacer-top-less">
        <div class="container">
            <div class="cv-heading">
                <h1>Customer review</h1>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="row">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="cv-testi-box">
                                <div class="cv-testi-data">
                                    <div class="cv-testi-footer">
                                        <div class="cv-testi-img">
                                            <img src="./images/user.jpg" alt="image" class="img-fluid"/>
                                        </div>
                                        <div class="cv-testi-name">
                                            <h1>John Michel</h1>
                                            <p>Manager</p>
                                        </div>
                                    </div>
                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="cv-testi-box">
                                <div class="cv-testi-data">
                                    <div class="cv-testi-footer">
                                        <div class="cv-testi-img">
                                            <img src="./images/user2.jpg" alt="image" class="img-fluid"/>
                                        </div>
                                        <div class="cv-testi-name">
                                            <h1>John Michel</h1>
                                            <p>Manager</p>
                                        </div>
                                    </div>
                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Arrows -->
                <div class="cv-arrow">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonial end -->
     <!-- partner start -->
    <div class="cv-partners spacer-top spacer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="javascript:;"><img src="./images/client2.jpg" alt="image" class="img-fluid"/></a>
                            </div>
                            <div class="swiper-slide">
                                <a href="javascript:;"><img src="./images/client1.jpg" alt="image" class="img-fluid"/></a>
                            </div>
                            <div class="swiper-slide">
                                <a href="javascript:;"><img src="./images/client3.jpg" alt="image" class="img-fluid"/></a>
                            </div>
                            <div class="swiper-slide">
                                <a href="javascript:;"><img src="./images/client4.jpg" alt="image" class="img-fluid"/></a>
                            </div>
                            <div class="swiper-slide">
                                <a href="javascript:;"><img src="./images/client5.jpg" alt="image" class="img-fluid"/></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- partner end -->
</div>
<?php	
	include_once './inc/footer.php';
?>