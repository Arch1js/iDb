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
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome - <?php echo $userRow['username'];?></title>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular.js"></script><!-- AngularJS -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script data-require="ui-bootstrap@*" data-semver="0.10.0" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.11.0/ui-bootstrap-tpls.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"><!-- Bootstrap -->
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
            <a href="user_logout.php?logout" title="Logout"><i class="fa fa-sign-out fa-2x"></i></a>
            <!--<a id="sign_out" href="../logout.php?logout"></a>-->

        </div>
    </div>
</div>
<div ng-controller="adminCtrl" data-ng-init="title=true"><!-- Controller class -->
	<div class="col-md-12">
    <div id="admin_tools" class="col-md-8 col-xs-12">
  <div class="col-md-3 col-xs-12">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-search"></i></div>
        <input type="text" class="form-control" ng-model="search" placeholder="TYPE HERE TO SEARCH">
      </div>
  </div>
	<div class="col-md-2 col-xs-12">
	<div class="input-group">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#searchModal" ng-click="advanced = !advanced; hideEdit(); hideDelete()">Advanced search</button>
	</div>
</div>
    <div class="col-md-2 col-xs-12">
    <div class="input-group">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" ng-click="hideEdit(); hideDelete(); hideAdvanced()">Add record</button>
    </div>
  </div>
	<div class="col-md-2 col-xs-12">
	<div class="input-group">
		<button type="button" class="btn btn-primary" ng-click="delete_record = !delete_record; hideEdit(); hideAdvanced()">Delete record</button>
	</div>
</div>
	<div class="col-md-2 col-xs-12">
	<div class="input-group">
		<button type="button" class="btn btn-primary" ng-click="edit_record = !edit_record; hideDelete(); hideAdvanced()">Edit</button>
	</div>
</div>
</div>
<div id="paginator_top" ng-show="paginator" class="col-md-3">
<pagination total-items="result.length" items-per-page="pageSize" ng-model="currentPage" max-size="5" class="pagination-sm"></pagination>
</div>
</div>
<div class="col-md-12 col-xs-12" id="advanced_search" ng-show="advanced">
<form class="form-inline">
<div id="change_form" class="form-group">
<label for="make">Make: </label>
<input type="text" class="form-control" ng-model="search.make"/>
<label for="make">Model: </label>
<input type="text" class="form-control" ng-model="search.model"/>
<label for="make">Registration: </label>
<input type="text" class="form-control" ng-model="search.Reg"/>
<label for="make">Colour: </label>
<input type="text" class="form-control" ng-model="search.colour"/>
<label for="make">Miles: </label>
<input type="text" class="form-control" ng-model="search.miles"/>
<label for="make">Price: </label>
<input type="text" class="form-control" ng-model="search.price"/>
</div>
</form>
<br>
<form class="form-inline">
<div id="change_form" class="form-group">
<label for="make">Dealer: </label>
<input type="text" class="form-control" ng-model="search.dealer"/>
<label for="make">Town: </label>
<input type="text" class="form-control" ng-model="search.town"/>
<label for="make">Telephone: </label>
<input type="text" class="form-control" ng-model="search.telephone"/>
<label for="make">Description: </label>
<input type="text" class="form-control" ng-model="search.description"/>
<label for="make">Region: </label>
<input type="text" class="form-control" ng-model="search.region"/>
</div>
</form>
<br>
</div>
<table class="table table-striped" ng-show="title" ng-init="displayAllData()">
<div class="modal_container">
	<!-- Edit Modal -->
	<div class="modal fade" id="addModal" role="dialog">
			<div class="modal-dialog modal-lg">
	<!-- Modal content-->
	<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
					<img width="100px" height="40px" alt="Brand" src="../Asets/Logo.svg"><!-- Logo -->
	</div>
	<div class="modal-body">
		<form class="form-inline">
		<div id="change_form" class="form-group">
		<label for="make">Make: </label>
		<input type="text" class="form-control" ng-model="add.make"/>
		<label for="make">Model: </label>
		<input type="text" class="form-control" ng-model="add.model"/>
		<label for="make">Registration: </label>
		<input type="text" class="form-control" ng-model="add.reg"/>
		<label for="make">Colour: </label>
		<input type="text" class="form-control" ng-model="add.colour"/>
		<label for="make">Miles: </label>
		<input type="text" class="form-control" ng-model="add.miles"/>
		<label for="make">Price: </label>
		<input type="text" class="form-control" ng-model="add.price"/>
		<label for="make">Dealer: </label>
		<input type="text" class="form-control" ng-model="add.dealer"/>
		<label for="make">Town: </label>
		<input type="text" class="form-control" ng-model="add.town"/>
		<label for="make">Telephone: </label>
		<input type="text" class="form-control" ng-model="add.tel"/>
		<label for="make">Description: </label>
		<input type="text" class="form-control" ng-model="add.desc"/>
		<label for="make">Region: </label>
		<input type="text" class="form-control" ng-model="add.region"/>
	</div>
</form>
	</div>
	<div class="modal-footer">
		<!--<button type="button" class="btn btn-success" data-dismiss="modal" ng-click="addCustomerInfo(); sendEmail()">Yes</button>-->
	<button type="button" class="btn btn-success" data-dismiss="modal" ng-click="addRecord(searchresults)">Add</button>
		<button type="button" class="btn btn-warning" data-toggle="modal" data-dismiss="modal">Cancel</button>
	</div>
</div>
</div>
</div>
				<!-- Edit Modal -->
				<div class="modal fade" id="editModal" role="dialog">
						<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
								<img width="100px" height="40px" alt="Brand" src="../Asets/Logo.svg"><!-- Logo -->
				</div>
				<div class="modal-body">
					<form class="form-inline">
					<div id="change_form" class="form-group">
					<label for="make">Make: </label>
					<input type="text" class="form-control" ng-model="record.make"/>
					<label for="make">Model: </label>
					<input type="text" class="form-control" ng-model="record.model"/>
					<label for="make">Registration: </label>
					<input type="text" class="form-control" ng-model="record.Reg"/>
					<label for="make">Colour: </label>
					<input type="text" class="form-control" ng-model="record.colour"/>
					<label for="make">Miles: </label>
					<input type="text" class="form-control" ng-model="record.miles"/>
					<label for="make">Price: </label>
					<input type="text" class="form-control" ng-model="record.price"/>
					<label for="make">Dealer: </label>
					<input type="text" class="form-control" ng-model="record.dealer"/>
					<label for="make">Town: </label>
					<input type="text" class="form-control" ng-model="record.town"/>
					<label for="make">Telephone: </label>
					<input type="text" class="form-control" ng-model="record.telephone"/>
					<label for="make">Description: </label>
					<input type="text" class="form-control" ng-model="record.description"/>
					<label for="make">Region: </label>
					<input type="text" class="form-control" ng-model="record.region"/>
					<label for="make">Index: </label>
					<input type="text" class="form-control" ng-model="record.carIndex"/>
				</div>
			</form>
				</div>
				<div class="modal-footer">
					<!--<button type="button" class="btn btn-success" data-dismiss="modal" ng-click="addCustomerInfo(); sendEmail()">Yes</button>-->
				<button type="button" class="btn btn-success" data-dismiss="modal" ng-click="updateRecord(record)">Save changes</button>
					<button type="button" class="btn btn-warning" data-toggle="modal" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>
    <thead>
        <tr>
            <th ng-click="sort('make')">Make <span class="glyphicon sort-icon" ng-show="sortKey=='make'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
            <th ng-click="sort('model')">Model <span class="glyphicon sort-icon" ng-show="sortKey=='model'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
            <th ng-click="sort('Reg')">Reg <span class="glyphicon sort-icon" ng-show="sortKey=='Reg'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
            <th ng-click="sort('colour')">Colour <span class="glyphicon sort-icon" ng-show="sortKey=='colour'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
            <th ng-click="sort('miles')">Miles <span class="glyphicon sort-icon" ng-show="sortKey=='miles'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
            <th ng-click="sort('price')">Price <span class="glyphicon sort-icon" ng-show="sortKey=='price'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
            <th ng-click="sort('dealer')">Dealer <span class="glyphicon sort-icon" ng-show="sortKey=='dealer'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
            <th ng-click="sort('town')">Town <span class="glyphicon sort-icon" ng-show="sortKey=='town'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
            <th>Telephone</th>
            <th>Description</th>
            <th ng-click="sort('carIndex')">Car Index <span class="glyphicon sort-icon" ng-show="sortKey=='carIndex'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
            <th ng-click="sort('region')">Region <span class="glyphicon sort-icon" ng-show="sortKey=='region'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
            <th ng-show="delete_record"></th>
        </tr>
    </thead>
  <tbody>
    <tr ng-model="searchresults" ng-repeat="i in result | orderBy:sortKey:reverse | filter: search | start: (currentPage - 1) * pageSize | limitTo: pageSize">
			<div class="modal_container">
				<!-- Delete Modal -->
				<div class="modal fade" id="deleteModal" role="dialog">
						<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
								<img width="100px" height="40px" alt="Brand" src="../Asets/Logo.svg"><!-- Logo -->
				</div>
				<div class="modal-body">
			<h3>Delete this record?</h3>
				</div>
			</form>
				<div class="modal-footer">
					<!--<button type="button" class="btn btn-success" data-dismiss="modal" ng-click="addCustomerInfo(); sendEmail()">Yes</button>-->
				<button type="button" class="btn btn-success" data-dismiss="modal" ng-click="delete_item(record)">Delete</button>
					<button type="button" class="btn btn-warning" data-toggle="modal" data-dismiss="modal">Cancel</button>
				</div>
			</div>
			</div>
			</div>
		</div>
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
        <td ng-show="delete_record"><button id="delete_button" type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" ng-click="open(i)">Delete</button></td>
				<td ng-show="edit_record"><button id="edit_button" type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editModal" ng-click="open(i)">Edit</button></td>
    </tr>
  </tbody>
</table>
<pagination ng-show="paginator" total-items="result.length" items-per-page="pageSize" ng-model="currentPage" max-size="5" class="pagination-sm"></pagination>
</div>
</body>

</html>
