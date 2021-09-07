<?php
    session_start();
    $user_profile_menu = '';
    $user_profile_menu .= '';
    $cart_product_count = isset($_SESSION['total_count'])?$_SESSION['total_count']:0;


    /* In Menu ,  Display "Edit profile" and "logout" functionality only if user logged in. 
       If user is not logged in don't show "Edit Profile and logout" functionality.
    */
    if(isset($_SESSION['is_logged_in_user']) && $_SESSION['is_logged_in_user'] == 1)
    {
        $user_name = substr($_SESSION['user_name'],0,10);
        $user_profile_menu = '<li class="cv-children-menu"><a href="javascript:void(0);">'.$user_name.'</a>
                                    <ul class="cv-sub-mmenu">
                                        <li><a href="./user_edit_profile">Edit Profile</a></li>
                                        <li><a href="./my_account">My Account</a></li>
                                        <li><a href="./inc/user_logout">Logout</a></li>
                                    </ul>
                                </li>';
    }
    else
    {
        $user_profile_menu = '<li><a href="./user_login">Login/Signup</a></li>';
    }
?>
<!-- top header start -->
    <div class="cv-top-header-two">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="cv-head-contact">
                        <h3><a href="tel:+0014567892591">Phone: +001 456-789-2591</a></h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cv-head-email">
                        <h3><a href="mailto:admin@mequipment.com">Email : admin@mequipment.com</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top header end -->
    <!-- main header start -->
    <div class="cv-header-two">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-7">
                    <div class="cv-logo">
                        <a href="index3.html"><img src="./images/logo.png" alt="image" class="img-fluid"></a>
                    </div>
                </div>
                <div class="col-lg-9 col-5">
                    <div class="cv-nav-bar">
                        <div class="cv-menu">
                            <ul>
                                <li><a href="./index">Home</a></li>
                                <li><a href="./shop">Shop</a></li>
                                <li><a href="./about">About</a></li>
                                <li><a href="./forum/discussion">Discussion</a></li>
                                <li><a href="./contact">Contact</a></li>
                                <?php
                                    echo $user_profile_menu;
                                ?>
                            </ul>
                        </div>
                        <div class="cv-head-icon">
                            <ul>
                                <li>
                                    <a href="./cart" class="cv-head-cart">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <g>
                                                <path d="M507.519,116.384C503.721,111.712,498.021,109,492,109H129.736l-1.484-13.632l-0.053-0.438C121.099,40.812,74.583,0,20,0
                                                    C8.954,0,0,8.954,0,20s8.954,20,20,20c34.506,0,63.923,25.749,68.512,59.928l23.773,218.401C91.495,327.765,77,348.722,77,373
                                                    c0,0.167,0.002,0.334,0.006,0.5C77.002,373.666,77,373.833,77,374c0,33.084,26.916,60,60,60h8.138
                                                    c-2.034,5.964-3.138,12.355-3.138,19c0,32.532,26.467,59,59,59s59-26.468,59-59c0-6.645-1.104-13.036-3.138-19h86.277
                                                    c-2.034,5.964-3.138,12.355-3.138,19c0,32.532,26.467,59,59,59c32.533,0,59-26.468,59-59c0-32.532-26.467-59-59-59H137
                                                    c-11.028,0-20-8.972-20-20c0-0.167-0.002-0.334-0.006-0.5c0.004-0.166,0.006-0.333,0.006-0.5c0-11.028,8.972-20,20-20h255.331
                                                    c35.503,0,68.084-21.966,83.006-55.962c4.439-10.114-0.161-21.912-10.275-26.352c-10.114-4.439-21.912,0.161-26.352,10.275
                                                    C430.299,300.125,411.661,313,392.331,313h-240.39L134.09,149h333.308l-9.786,46.916c-2.255,10.813,4.682,21.407,15.495,23.662
                                                    c1.377,0.288,2.75,0.426,4.104,0.426c9.272,0,17.59-6.484,19.558-15.92l14.809-71C512.808,127.19,511.317,121.056,507.519,116.384
                                                    z M399,434c10.477,0,19,8.523,19,19s-8.523,19-19,19s-19-8.523-19-19S388.523,434,399,434z M201,434c10.477,0,19,8.524,19,19
                                                    c0,10.477-8.523,19-19,19s-19-8.523-19-19S190.523,434,201,434z"></path>
                                            </g>
                                        </svg>
                                        <span id="cart_product_count"><?php echo $cart_product_count; ?></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="cv-toggle-nav">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main header end -->

    <!--cart message box start-->
    <div class="cart-message-box" id="cart-message">
        <h3></h3>
    </div>
    <!--cart message box end-->