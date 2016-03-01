<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: admin_page.php");
}

if(isset($_POST['btn-login']))
{
	$email = mysql_real_escape_string($_POST['user']);
	$upass = mysql_real_escape_string($_POST['pass']);
	$res=mysql_query("SELECT * FROM users WHERE email='$email'");
	$row=mysql_fetch_array($res);
    
	
	if($row['password']==md5($upass))
	{
		$_SESSION['user'] = $row['user_id'];
		header("Location: admin_page.php");
	}
	else
	{
        echo "Login failed";
    }
}
    ?>