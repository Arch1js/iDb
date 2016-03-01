<?php
session_start();

if(!isset($_SESSION['user']))
{
	header("Location: login.html");
}
else if(isset($_SESSION['user'])!="")
{
	header("Location: admin_page.php");
}

if(isset($_GET['logout']))
{
	session_destroy();
	unset($_SESSION['user']);
	header("Location: login.html");
}
?>