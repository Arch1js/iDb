<?php
session_start();
include_once '../dbconnect.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: admin_page.php");
}

if(isset($_POST['btn-login']))
{
	$email = mysqli_real_escape_string($mysqli, $_POST['user']);
	$upass = mysqli_real_escape_string($mysqli, $_POST['pass']);
	$res=mysqli_query($mysqli,"SELECT * FROM administrators WHERE email='$email'");
	$row=mysqli_fetch_array($res);
    
	
	if($row['password']==md5($upass) & $row['email']== $email)
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