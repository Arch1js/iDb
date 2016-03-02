<!DOCTYPE html>
<html ng-app="carApp">
<head>
    <meta charset="UTF-8">
    <title>Car sales</title>
    <script src="http://code.angularjs.org/angular-1.0.0.min.js"></script><!-- AngularJS -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><!-- JQuery -->
    <script src='https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js'></script>

    <script src='https://http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.css'><!-- Bootstrap -->

    <link rel="stylesheet" href="../css/admin_panel.css"><!-- Stylesheet -->
      
    <!-- Services -->
    <script src="../functions.js"></script>
    
    <!-- Directives -->
    <script src="../directives/directives.js"></script>
    
</head>

<body>
<div ng-controller="adminCtrl"><!-- Controller class -->
    <p>Admin tools</p>
    <div id="admin_tools" class="row">
  <div class="col-md-2">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-search"></i></div>
        <input type="text" class="form-control" ng-model="search" placeholder="Type to Search">
      </div>
  </div>
  <div class="col-md-1 col-xs-2">
    <div class="input-group">
      <button id="button" type="button" class="btn btn-primary" ng-click="adminSearch(); title=true">Load All Data</button>
    </div>
  </div>
    <div class="col-md-1 col-xs-2">
    <div class="input-group">
      <button id="button" type="button" class="btn btn-primary" ng-click="add_record = !add_record">Add record</button>
    </div>
  </div>
    <div class="col-md-1 col-xs-2">
    <div class="input-group">
      <button id="button" type="button" class="btn btn-primary" ng-click="adminSearch()">Delete record</button>
    </div>
  </div>
</div>
<div id="add_data" class="col-md-8" ng-show="add_record">
<form class="form-inline">
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Make">
    <input type="text" class="form-control" placeholder="Model">
      <input type="text" class="form-control" placeholder="Reg">
      <input type="text" class="form-control" placeholder="Colour">
      <input type="text" class="form-control" placeholder="Miles">
      <input type="text" class="form-control" placeholder="Price">
      <input type="text" class="form-control" placeholder="Dealer">
      <input type="text" class="form-control" placeholder="Town">
      <input type="text" class="form-control" placeholder="Telephone">
      <input type="text" class="form-control" placeholder="Description">
      <input type="text" class="form-control" placeholder="Car Index">
      <input type="text" class="form-control" placeholder="Region">
      <button type="submit" class="btn btn-primary">Add Record</button>
  </div>
</form>
    </div>
<table class="table table-striped" ng-show="title">
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
        </tr>
    </thead>  
  <tbody>
    <tr ng:repeat="i in result | filter:search">        
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
    </tr>
  </tbody>
</table>
  
</div>
          

    </body>