<?php
    include_once './../inc/constants.php';
    include_once './../inc/connection.php';
    include_once './../inc/functions.php';

    // Admin logout
    unset($_SESSION['is_admin_logged_in']);
    header("location:".ADMIN_URL."");
?>