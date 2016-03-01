<?php
session_start();
require '../dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: user_login.php");
}
$res=mysqli_query($mysqli, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
?>

<html>
<head>

<title>Welcome - <?php echo $userRow['username'];?></title>
<link rel="stylesheet" href="../css/admin_style.css" type="text/css" />
</head>
<body>
<div id="header">
	<div id="left">
    <label></label>
    </div>
    <div id="right">
    	<div id="content">
        	hi' <?php echo $userRow['username'];
            $username= $userRow['username'];
            require '../dbconnect.php';

            $res=mysqli_query($mysqli,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
            //$result=mysqli_query($mysqli,"select * from images where user='$username'");
            //$row = mysqli_fetch_array($result);
            //echo '<img id="profile_image" height="300" width="300" src="data:image;base64,'.$row[2].' "> ';
            echo '<img id="profile_image" height="300" width="300" src="../Asets/photo.png">';
            ?>
            <a href="user_logout.php?logout"><img id="log_out" src="../Asets/logout.png" alt="Sign out"></a>
            <!--<a id="sign_out" href="../logout.php?logout"></a>-->
        </div>
    </div>
</div>

</body>
    
</html>