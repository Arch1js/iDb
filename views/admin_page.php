<?php
session_start();
require '../dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: user_login.php");
}
$res=mysqli_query($mysqli, "SELECT * FROM administrators WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
?>

<html ng-app="carApp">
<head>

<title>Welcome - <?php echo $userRow['username'];?></title>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src='https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js'></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.css'><!-- Bootstrap -->
<link rel="stylesheet" href="../css/admin_panel.css"><!-- Stylesheet -->
<link rel="stylesheet" href="../css/admin_style.css" type="text/css" />
<link rel="stylesheet" href="../css/style.css">
<!-- Services -->
<script src="../functions.js"></script>
    
<!-- Directives -->
<script src="../directives/directives.js"></script>
    
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

            $res=mysqli_query($mysqli,"SELECT * FROM administrators WHERE user_id=".$_SESSION['user']);
            //$result=mysqli_query($mysqli,"select * from images where user='$username'");
            //$row = mysqli_fetch_array($result);
            //echo '<img id="profile_image" height="300" width="300" src="data:image;base64,'.$row[2].' "> ';
            echo '<img id="profile_image" height="300" width="300" src="../Asets/photo.png">';
            ?>
            <a href="user_logout.php?logout"><i class="fa fa-sign-out fa-2x"></i></a>
            <!--<a id="sign_out" href="../logout.php?logout"></a>-->
            
        </div>
    </div>
</div>
<div ng-controller="adminCtrl" data-ng-init="title=true"><!-- Controller class -->
    <div id="admin_tools" class="row">
  <div class="col-md-2">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-search"></i></div>
        <input type="text" class="form-control" ng-model="search" placeholder="Type to Search">
      </div>
  </div>
    <div class="col-md-1 col-xs-2">
    <div class="input-group">
      <button id="button" type="button" class="btn btn-primary" ng-click="add_record = !add_record">Add record</button>
    </div>
  </div>
    <div class="col-md-1 col-xs-2">
    <div class="input-group">
      <button id="button" type="button" class="btn btn-primary" ng-click="delete_record = !delete_record">Delete record</button>
    </div>
  </div>
</div>
<div id="add_data" class="col-md-8" ng-show="add_record">
<form class="form-inline">
  <div class="form-group">
      <input type="text" class="form-control" ng-model="add.make" placeholder="Make">
      <input type="text" class="form-control" ng-model="add.model" placeholder="Model">
      <input type="text" class="form-control"  placeholder="Reg">
      <input type="text" class="form-control"  placeholder="Colour">
      <input type="text" class="form-control"  placeholder="Miles">
      <input type="text" class="form-control"  placeholder="Price">
      <input type="text" class="form-control"  placeholder="Dealer">
      <input type="text" class="form-control"  placeholder="Town">
      <input type="text" class="form-control"  placeholder="Telephone">
      <input type="text" class="form-control"  placeholder="Description">
      <input type="text" class="form-control"  placeholder="Car Index">
      <input type="text" class="form-control"  placeholder="Region">
      <button type="submit" class="btn btn-primary" ng-click="addRecord(search_results)">Add Record</button>
  </div>
</form>
    </div>
<table class="table table-striped" ng-show="title">
    <ul class="pagination pull-right" ng-show="paginator">
  <li><button class="btn btn-default" ng-disabled="currentPage == 0" ng-click="currentPage=currentPage - 1"><i class="fa fa-angle-double-left"></i>
      Prev</button></li>
  <li>{{currentPage+1}}/{{numberOfPages()}}</li>
  <li><button class="btn btn-default" ng-disabled="(currentPage + 1) == numberOfPages()" ng-click="currentPage=currentPage+1">Next <i class="fa fa-angle-double-right"></i>
</li>
</ul>
    <thead>
        <tr>        
            <th>Make</th>
            <th>Model</th>
            <th>Reg</th>
            <th>Colour</th>
            <th>Miles</th>
            <th>Price</th>
            <th>Dealer</th>
            <th>Town</th>
            <th>Telephone</th>
            <th>Description</th>
            <th>Car Index</th>
            <th>Region</th>
            <th ng-show="delete_record"></th>
        </tr>
    </thead>  
  <tbody>
    <tr ng-model="search_results" ng-repeat="i in result | filter:search | startFrom:currentPage*pageSize | limitTo:pageSize">        
        <td>{{i.make}}</td>
        <td>{{i.model}}</td>
        <td>{{i.Reg}}</td>
        <td>{{i.colour}}</td>
        <td>{{i.miles}}</td>
        <td>{{i.price}}</td>
        <td>{{i.dealer}}</td>
        <td>{{i.town}}</td>
        <td>{{i.telephone}}</td>
        <td>{{i.description}}</td>
        <td>{{i.carIndex}}</td>
        <td>{{i.region}}</td>
        <td ng-show="delete_record"><button id="delete_button" type="button" class="btn btn-danger btn-xs" ng-click="delete_item(i)">Delete</button></td>
    </tr>
  </tbody>
</table>
  <ul class="pagination pull-right" ng-show="paginator">
  <li><button class="btn btn-default" ng-disabled="currentPage == 0" ng-click="currentPage=currentPage - 1"><i class="fa fa-angle-double-left"></i>
      Prev</button></li>
  <li>{{currentPage+1}}/{{numberOfPages()}}</li>
  <li><button class="btn btn-default" ng-disabled="(currentPage + 1) == numberOfPages()" ng-click="currentPage=currentPage+1">Next <i class="fa fa-angle-double-right"></i>
</li>
</ul>
</div>
</body>
    
</html>