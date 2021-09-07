<?php
	// Defining constants for connections
	define("DB_SERVER","localhost");
	define("DB_USERNAME","root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "medicalstore");

	// Mysql connections
	$connect = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
?>