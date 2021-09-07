<?php
	session_start();
	if(isset($_SESSION['is_logged_in_user']) && isset($_SESSION['is_logged_in_user'])==1)
	{
		unset($_SESSION['is_logged_in_user']);
		header("location:./../index");
	}
?>