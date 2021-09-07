<?php
	$page_name = basename($_SERVER["SCRIPT_FILENAME"], '.php');
	switch ($page_name) {
		case 'index':
			$page_title = "Home";
			break;
		case 'about':
			$page_title = "About";
			break;
		case 'shop':
			$page_title = "Shop";
			break;
		case 'contact':
			$page_title = "contact";
			break;
		case 'cart':
			$page_title = "cart";
			break;
		case 'user_edit_profile':
			$page_title = "Edit Profile";
			break;
		case 'user_login':
			$page_title = "User Login";
			break;	
		case 'user_signup':
			$page_title = "User Signup";
			break;	
		case '404':
			$page_title = "404";
			break;
		case 'checkout':
			$page_title = "checkout";
			break;
		case 'success':
			$page_title = "success";
			break;

		
		default:
			$page_title = "Welcome to our store!";
	}
?>
<!DOCTYPE html>
<html>
	<head>
	    <meta name="description" content="Medical Store Project">
  		<meta name="keywords" content="HTML, CSS, JavaScript">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta charset="UTF-8">
	  	<title><?php echo isset($page_title)?$page_title:''; ?></title>
	    <link href="./assets/css/jquery.fancybox.min.css" media="all" rel="stylesheet" type="text/css">
	  	<link href="./assets/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css">
	  	<link href="./assets/css/all.min.css" media="all" rel="stylesheet" type="text/css">
	  	<link href="./assets/css/font.css" media="all" rel="stylesheet" type="text/css">
		<link href="./assets/css/swiper.min.css" media="all" rel="stylesheet" type="text/css">
	  	<link href="./assets/fonts/fontawesome-free-5.14.0-web/css/all.min.css" media="all" rel="stylesheet" type="text/css">
		<link href="./assets/css/style.css" media="all" rel="stylesheet" type="text/css">
		<link rel="shortcut icon" href="./images/fav.png" type="image/x-icon">	
	</head>
<body>
	