<?php
session_start();
require '../dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: ../user_login.php");
}
$res=mysqli_query($mysqli, "SELECT * FROM administrators WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
?>
<html ng-app="carApp">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome - <?php echo $userRow['username'];?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../dependencies/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="../dependencies/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/admin_style.css" type="text/css" />
<link rel="stylesheet" href="../css/loader_animation.css"><!-- Stylesheet -->

<script src="../dependencies/angular.min.js"></script><!-- AngularJS -->
<script src="../dependencies/ui-bootstrap-tpls-1.2.5.js"></script>
<script src="../dependencies/jquery-2.2.2.min.js"></script>
<script src="../dependencies/bootstrap/js/bootstrap.min.js"></script>
<script src="../dependencies/jquery.validate.min.js"></script>

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
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="pill" href="#cars">Cars</a></li>
    <li><a data-toggle="pill" href="#orders">Orders</a></li>
  </ul>
	<div class="tab-content">
	<div id="cars" class="tab-pane fade in active">
	<div class="col-md-12">
    <div id="admin_tools" class="col-md-7 col-xs-12">
  <div class="col-md-3 col-xs-12">
    <div class="input-group">
        <input id="qicksearch" type="text" class="form-control" ng-model="quicksearch" ng-init="quicksearch=''" value="" placeholder="Enter keyword">
				<div ng-click="displayData(1)" class="input-group-addon"><i class="fa fa-search"></i></div>
      </div>
  </div>
	<div class="col-md-3 col-xs-12">
	<div class="input-group">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#searchModal" ng-click="advanced = !advanced; hideEdit(); hideDelete()">Advanced search</button>
	</div>
</div>
    <div class="col-md-2 col-xs-12">
    <div class="input-group">
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal" ng-click="hideEdit(); hideDelete(); hideAdvanced()">Add record</button>
    </div>
  </div>
	<div class="col-md-2 col-xs-12">
	<div class="input-group">
		<button type="button" class="btn btn-warning"  ng-click="displayData(1)">Load data</button>
	</div>
</div>
<div class="col-md-2 col-xs-12">
	<select class="form-control" ng-model="pageSizeInput" ng-init="pageSizeInput='10'" ng-change="displayData(currentPage)" ng-show="perpage">
	    <option value="10" selected>10</option>
	    <option value="25">25</option>
	    <option value="50">50</option>
	    <option value="100">100</option>
	</select>
</div>
</div>
<div id="paginator_top" ng-show="paginator" class="col-md-3">
	<div id="pageCounter">
	<p>Page {{currentPage}} of {{numberOfItems/pageSizeInput | roundup}}</p>
	</div>
<pagination total-items="numberOfItems" items-per-page="pageSizeInput"  ng-change="displayData(currentPage)" ng-model="currentPage" max-size="5" class="pagination-sm"></pagination>
</div>
<div class="col-md-12 col-xs-12" id="advanced_search" ng-show="advanced">
<form class="form-inline">
<div id="change_form" class="form-group">
<label for="make">Make: </label>
<input type="text" class="form-control" ng-init="search.make=''" value="" ng-model="search.make"/>
<label for="make">Model: </label>
<input type="text" class="form-control" ng-init="search.model=''" value="" ng-model="search.model"/>
<label for="make">Registration: </label>
<input type="text" class="form-control" ng-init="search.Reg=''" value="" ng-model="search.Reg"/>
<label for="make">Colour: </label>
<input type="text" class="form-control" ng-init="search.colour=''" value="" ng-model="search.colour"/>
<label for="make">Miles: </label>
<input type="text" class="form-control" ng-init="search.miles=''" value="" ng-model="search.miles"/>
<label for="make">Price: </label>
<input type="text" class="form-control" ng-init="search.price=''" value="" ng-model="search.price"/>
</div>
<div class="input-group">
	<button type="button" class="btn btn-primary" ng-click="displayData(1)">Search</button>
</div>
</form>
<br>
<br>
</div>
<table class="table table-striped" ng-show="title" ng-init="">
<div class="modal_container">
	<!-- Add Modal -->
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
		<input type="text" class="form-control" maxlength="10" ng-model="add.make"/>
		<label for="make">Model: </label>
		<input type="text" class="form-control" maxlength="15" ng-model="add.model"/>
		<label for="make">Registration: </label>
		<input type="text" class="form-control" maxlength="1" ng-model="add.reg"/>
		<label for="make">Colour: </label>
		<input type="text" class="form-control" maxlength="10" ng-model="add.colour"/>
		<label for="make">Miles: </label>
		<input type="text" class="form-control" maxlength="6" ng-model="add.miles"/>
		<label for="make">Price: </label>
		<input type="text" class="form-control" maxlength="11" ng-model="add.price"/>
		<label for="make">Dealer: </label>
		<input type="text" class="form-control" maxlength="50" ng-model="add.dealer"/>
		<label for="make">Town: </label>
		<input type="text" class="form-control" maxlength="20" ng-model="add.town"/>
		<label for="make">Telephone: </label>
		<input type="text" class="form-control" maxlength="15" ng-model="add.tel"/>
		<label for="make">Region: </label>
		<input type="text" class="form-control" maxlength="10" ng-model="add.region"/>
		<label for="make">Path to image: </label>
		<input type="text" class="form-control" maxlength="45" ng-model="add.picture"/>
		<label for="make">Status: </label>
		<select class="form-control" ng-model="add.status">
			<option value="available" selected>Available</option>
			<option value="on-hold">On-hold</option>
			<option value="unavailable">Unavailable</option>
		</select>
		<label for="make">Description: </label>
		<textarea type="text" class="form-control" maxlength="30" ng-model="add.desc" rows="4" cols="50"></textarea>
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
					<input type="text" class="form-control" maxlength="10" ng-model="record.make"/>
					<label for="make">Model: </label>
					<input type="text" class="form-control" maxlength="15" ng-model="record.model"/>
					<label for="make">Registration: </label>
					<input type="text" class="form-control" maxlength="1" ng-model="record.Reg"/>
					<label for="make">Colour: </label>
					<input type="text" class="form-control" maxlength="10" ng-model="record.colour"/>
					<label for="make">Miles: </label>
					<input type="text" class="form-control" maxlength="6" ng-model="record.miles"/>
					<label for="make">Price: </label>
					<input type="text" class="form-control" maxlength="11" ng-model="record.price"/>
					<label for="make">Dealer: </label>
					<input type="text" class="form-control" maxlength="50" ng-model="record.dealer"/>
					<label for="make">Town: </label>
					<input type="text" class="form-control" maxlength="20" ng-model="record.town"/>
					<label for="make">Telephone: </label>
					<input type="text" class="form-control" maxlength="15" ng-model="record.telephone"/>
					<label for="make">Region: </label>
					<input type="text" class="form-control" maxlength="10" ng-model="record.region"/>
					<label for="make">Path to image: </label>
					<input type="text" class="form-control" maxlength="45" ng-model="record.picture"/>
					<label for="make">Status: </label>
					<select class="form-control" ng-model="record.status">
						<option value="available" selected>Available</option>
						<option value="on-hold">On-hold</option>
						<option value="unavailable">Unavailable</option>
					</select>
					<label for="make">Index: </label>
					<input type="text" class="form-control" ng-model="record.carIndex"/>
					<label for="make">Description: </label>
					<textarea type="text" class="form-control" maxlength="30" ng-model="record.description" rows="4" cols="50"></textarea>
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
						<th ng-click="sort('status')">Status <span class="glyphicon sort-icon" ng-show="sortKey=='status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
						<th ng-click="sort('picture')">Picture <span class="glyphicon sort-icon" ng-show="sortKey=='picture'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
						<th ng-show="delete_record"></th>
        </tr>
    </thead>
  <tbody>
    <tr ng-model="searchresults" ng-repeat="i in data | orderBy:sortKey:reverse | start: (currentPage - 1) * pageSizeInput | limitTo: pageSizeInput">
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
				<button type="button" class="btn btn-success" data-dismiss="modal" ng-click="delete_item()">Delete</button>
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
				<td>{{i.status}}</td>
				<td>{{i.picture}}</td>
				<td><i class="fa fa-trash" aria-hidden="true" data-toggle="modal" data-target="#deleteModal" ng-click="open(i)"></i></td>
				<td><i class="fa fa-pencil" aria-hidden="true" data-toggle="modal" data-target="#editModal" ng-click="open(i)"></i></td>
		</tr>
  </tbody>
</table>
<div id="paginator_botom" ng-show="paginator" class="col-md-3">
<pagination total-items="numberOfItems" items-per-page="pageSizeInput"  ng-change="displayData(currentPage)" ng-model="currentPage" max-size="5" class="pagination-sm"></pagination>
</div>
<div class="alert alert-danger" ng-show="query_error" class="col-xs-12">
		<strong>Error!</strong> No results found. Please try another query!
	</div>
</div>
</div>
<div id="orders" class="tab-pane fade" ng-click="changePageToFirst(1)">
	<div class="col-md-2 col-xs-12">
		<br>
	<div class="input-group">
		<button type="button" class="btn btn-warning"  ng-click="displayOrders(1)">Load all orders</button>
	</div>
		</div>
		<br>
		<div class="col-md-4 pull-right" ng-show="controls">
	<div class="col-md-4 col-xs-12">
		<select class="form-control" ng-model="pageSizeInput3" ng-init="pageSizeInput3='10'" ng-change="displayOrders(currentPage)">
		    <option value="10" selected>10</option>
		    <option value="25">25</option>
		    <option value="50">50</option>
		    <option value="100">100</option>
		</select>
	</div>
	<div id="paginator_top"class="col-md-8 col-xs-12">
		<div id="pageCounter">
		<p>Page {{currentPage}} of {{numberOfItems2/pageSizeInput3 | roundup}}</p>
		</div>
	<pagination total-items="numberOfItems2" items-per-page="pageSizeInput3"  ng-change="displayOrders(currentPage)" ng-model="currentPage" max-size="5" class="pagination-sm"></pagination>
	</div>
</div>
	<table class="table table-striped" ng-show="title" ng-init="">
	    <thead>
	        <tr>
	            <th ng-click="sort('make')">Order ID<span class="glyphicon sort-icon" ng-show="sortKey=='make'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
	            <th ng-click="sort('model')">Car Index<span class="glyphicon sort-icon" ng-show="sortKey=='model'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
	            <th ng-click="sort('Reg')">Customer ID<span class="glyphicon sort-icon" ng-show="sortKey=='Reg'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
							<th ng-click="sort('Reg')">Payment ID<span class="glyphicon sort-icon" ng-show="sortKey=='Reg'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
	            <th ng-click="sort('colour')">Card No<span class="glyphicon sort-icon" ng-show="sortKey=='colour'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
							<th ng-click="sort('colour')">Exp Month <span class="glyphicon sort-icon" ng-show="sortKey=='colour'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
							<th ng-click="sort('colour')">Exp Year <span class="glyphicon sort-icon" ng-show="sortKey=='colour'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
							<th ng-click="sort('colour')">CVV <span class="glyphicon sort-icon" ng-show="sortKey=='colour'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
					</tr>
	    </thead>
	  <tbody>
	    <tr ng-model="searchresults" ng-repeat="i in orderdata | orderBy:sortKey:reverse | start: (currentPage - 1) * pageSizeInput3 | limitTo: pageSizeInput3">
					<td>{{i.orderID}}</td>
	        <td>{{i.carIndex}}</td>
					<td>{{i.customerID}}</td>
					<td>{{i.paymentID}}</td>
					<td>{{i.cardNo}}</td>
	        <td>{{i.expMonth}}</td>
	        <td>{{i.expYear}}</td>
					<td>{{i.CVV}}</td>
	  </tbody>
	</table>
	</div>
</div>
<div spinner></div>
</body>

</html>
