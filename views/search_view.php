<!DOCTYPE html>
<html ng-app="carApp">
<head>
    <meta charset="UTF-8">
    <title>Car sales</title>    
</head>

<body>   
<div ng-controller="SearchCtrl"><!-- Controller class -->
  <div id="contents_container"><!-- start of contents container -->
      <div id="left_pane" class="col-md-4"><!-- left search pane -->
        <div id="search_container"><!-- Search container -->
        <center>
   <h1></h1>
     </center>
             
    <form name="formColor" class="form-inline"><!-- Min price and max price form-->
 <select ng-model="colour" class="form-control">
     <option value="" selected disabled>Colour</option>
     <option value="Any">Any</option>
<?php
     $sql = 'SELECT DISTINCT(colour) FROM cars ORDER BY colour';
   include_once '../dbconnect.php';
    
    // Check connection
    if ($mysqli->connect_error) {
        
        die("Connection failed: " . $mysqli->connect_error);
    }
    $mysqli->query($sql);
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['colour'] . "'>" . $row['colour'] . "</option>\n";	
    }
}

?>
</select>
        
<select class="form-control" ng-model="milage">
  <option value="" selected disabled>Milage</option>
  <option value="Any">Any</option>
  <option value="<= 100">Up to 100 miles</option>
  <option value="<= 1000">Up to 1000 miles</option>
  <option value="<= 10000">Up to 10000 miles</option>
  <option value="<= 20000">Up to 20000 miles</option>
  <option value="<= 50000">Up to 50000 miles</option>
  <option value="<= 750000">Up to 75000 miles</option>
  <option value="<= 100000">Up to 100000 miles</option>
    <option value=">= 100000">More than 100000 miles</option>
</select>

</form>
<form name="make" class="form-inline"><!-- Make and model form-->
<div class="form-group">
 <select class="form-control" ng-model="make" ng-change="refine()">
    <option selected disabled>Make</option>
     <?php
    $sql = "SELECT DISTINCT(make) FROM cars ORDER BY make";
   include_once '../dbconnect.php';
    
    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    $mysqli->query($sql);
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['make'] . "'>" . $row['make'] . "</option>\n";	
    }
}

?>
</select>
    <select class="form-control" ng-model="carmodel" ng-disabled="!make" ng-options="car.model for car in result2 | unique: 'model'">
     <option value="">Model</option>
</select>
</div>
</form>
          
<form class="form-inline"><!-- Min price and max price form-->
<select class="form-control" ng-model="minprice">
  <option value="" selected disabled>Min price</option>
  <option value="500">£500</option>
  <option value="1000">£1000</option>
  <option value="1500">£1500</option>
  <option value="2000">£2000</option>
  <option value="3000">£3000</option>
</select>
<select class="form-control" ng-model="maxprice">
  <option value="" selected disabled>Max price</option>
  <option value="1000">£1000</option>
  <option value="2000">£2000</option>
  <option value="5000">£5000</option>
  <option value="10000">£10000</option>
  <option value="100000">£100000</option>
</select>
</form>
<center>
    <div><button type="submit" id="submit" type="button" ng-click="search()">Search</button></div><!--Search button-->
</center>
          </div>
          </div>
      <div id="right_pane" class="col-md-8"><!--Start of right pane-->
        <div spinner></div>
        <div class="results_view" ng-show="results" ng-repeat="car in result | startFrom:currentPage*pageSize | limitTo:pageSize" ><!-- Display results-->
 <div class="wrapper">
                  <div id="car_preview">
                    <img class="img-thumbnail" ng-src="{{car.picture}}">
                  </div>
                  <div id="stats">
                    <p><p1 id="label">Make:</p1> {{ car.make }}</p>
                    <p><p1 id="label">Model:</p1> {{ car.model }}</p> 
                    <p><p1 id="label">Colour:</p1> {{ car.colour }}</p>
                    <p><p1 id="label">Miles:</p1> {{ car.miles }}</p>
                  </div>
                    <div id="price">
                    <p>£{{ car.price | number:0}}</p>
                   </div>
                  <div id="check">
                 <button type="button" id="button" class="btn btn-primary" ng-click="open(car); shareMyData(car); hideResults()">Check</button>
                  </div>
              </div>
</div>
  
    <ul class="pagination pull-right" ng-show="paginator">
  <li><a href ng-disabled="currentPage == 0" ng-click="currentPage=currentPage - 1">« Prev</a>
  <li><a href="#">{{currentPage+1}}/{{numberOfPages()}}</a></li>

  <li><a href ng-disabled="currentPage >= data.length/pageSize - 1" ng-click="currentPage=currentPage+1">Next »</a></li>
</ul>
          <div ng-show="display" display></div>
     </div>
      </div>     
    </body>