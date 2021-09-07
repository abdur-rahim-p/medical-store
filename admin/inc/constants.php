<?php
    // Constants for database connection
    if(!defined("DB_SERVER_NAME")) define("DB_SERVER_NAME","localhost");
    if(!defined("DB_USER_NAME")) define("DB_USER_NAME","root");
    if(!defined("DB_USER_PASSWORD")) define("DB_USER_PASSWORD","");
    if(!defined("DB_NAME")) define("DB_NAME","medicalstore");

    // Admin url constant
    if(!defined("ADMIN_URL")) define("ADMIN_URL","http://localhost/medicalstore.com/admin/");

    // Assets url constant
    if(!defined("ADMIN_IMAGE_URL")) define("ADMIN_IMAGE_URL",ADMIN_URL."assets/images/");

    // Category Image url constant
    if(!defined("CATEGORY_IMG_URL")) define("CATEGORY_IMG_URL",ADMIN_IMAGE_URL."category_images/");

    // Product Image url constant
    if(!defined("PRODUCT_IMG_URL")) define("PRODUCT_IMG_URL",ADMIN_IMAGE_URL."product_images/");

    // User Image url constant
    if(!defined("USER_IMG_URL")) define("USER_IMG_URL",ADMIN_IMAGE_URL."user_images/");

    // User Signature Image url constant
    if(!defined("USER_SIGN_IMG_URL")) define("USER_SIGN_IMG_URL",ADMIN_IMAGE_URL."user_signs/");

    // Frontend url
    if(!defined("FRONTEND_URL")) define("FRONTEND_URL","http://localhost/medicalstore.com/");

    // Frontend single product page url
    if(!defined("FRONTEND_SINGLE_PRODUCT_PAGE_URL")) define("FRONTEND_SINGLE_PRODUCT_PAGE_URL",FRONTEND_URL."product_single.php");

?>