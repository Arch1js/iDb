<!DOCTYPE html>
<html ng-app="carApp">
<head>
    <meta charset="UTF-8">
    <title>CarGo</title>
    <link rel="icon" href="../Asets/Logo.svg">
</head>
<body>
<div ng-controller="SearchCtrl"><!-- Search Controller class -->
  <div id="contents_container"><!-- start of contents container -->
      <div id="left_pane" class="col-md-3 col-xs-12"><!-- left search pane -->
        <div id="search_container" class="col-md-12 col-xs-12 col-centered"><!-- Search container -->
          <form name="formColor" class="form-inline"><!-- Min price and max price form-->
            <select ng-model="colour" ng-init="colour = colour || 'Any'" class="form-control">
              <option value="Any">Colour</option>
              <?php //Update select with all available colours
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

          <select class="form-control" ng-init="milage = milage || 'Any'" ng-model="milage"><!-- Milage form-->
            <option value="Any">Milage</option>
            <option value="100">Up to 100 miles</option>
            <option value="1000">Up to 1000 miles</option>
            <option value="10000">Up to 10000 miles</option>
            <option value="20000">Up to 20000 miles</option>
            <option value="50000">Up to 50000 miles</option>
            <option value="75000">Up to 75000 miles</option>
            <option value="100000">Up to 100000 miles</option>
            <option value="100000">More than 100000 miles</option>
          </select>
        </form>
        <form name="make" class="form-inline"><!-- Make and model form-->
          <div class="form-group">
            <select class="form-control" ng-model="make" ng-change="refine()" ng-init="make='Any'">
              <option value="Any" selected>Make</option>
              <?php //Update selector with all available makes
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
          <select class="form-control" ng-model="carmodel" ng-init="carmodel='Any'"> <!-- Update model selector based on make selection-->
            <option value="Any">Model</option>
            <option ng-repeat="i in result2 | unique: 'model'" value="{{i.model}}">{{i.model}}</option>
          </select>
        </div>
      </form>
      <form class="form-inline"><!-- Min price and max price form-->
        <select class="form-control" ng-model="minprice" ng-init="minprice='Any'">
          <option value="Any" selected>Min price</option>
          <option value="500">£500</option>
          <option value="1000">£1000</option>
          <option value="1500">£1500</option>
          <option value="2000">£2000</option>
          <option value="3000">£3000</option>
        </select>
        <select class="form-control" ng-model="maxprice" ng-init="maxprice='Any'">
          <option value="Any" selected>Max price</option>
          <option value="1000">£1000</option>
          <option value="2000">£2000</option>
          <option value="5000">£5000</option>
          <option value="10000">£10000</option>
          <option value="100000">£100000</option>
        </select>
      </form>
      <center>
        <button type="submit" id="submit" type="button" ng-click="search(1)">Search</button><!--Search button-->
      </center>
          </div>
    </div><!-- End of left pane-->
    <div id="right_pane" class="col-md-8 col-xs-12"><!--Start of right pane-->
      <div class="alert alert-danger" ng-show="error" class="col-xs-12"> <!-- Error message container-->
        <strong>Error!</strong> No records found. Please try again!
      </div>
      <div class="col-md-8 col-xs-12"> <!-- Carousel container-->
      <div id="carousel" class="carousel slide" data-ride="carousel" ng-show="carousel"><!-- Cars carousel-->
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel" data-slide-to="0" class="active"></li>
          <li data-target="#carousel" data-slide-to="1"></li>
          <li data-target="#carousel" data-slide-to="2"></li>
        </ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              <img id="carousel_img" src="../Asets/carousel/Audi.jpg" alt="Audi">
              <div class="carousel-caption">
              	<h3>Audi A6</h3>
                <p>See our range of Audi cars</p>
              </div>
            </div>
            <div class="item">
              <img id="carousel_img" src="../Asets/carousel/mercedes.jpg" alt="Mercedes">
              <div class="carousel-caption">
              	<h3>Mercedes AMG</h3>
                <p>See our range of Mercedes cars</p>
              </div>
            </div>
            <div class="item">
              <img id="carousel_img" src="../Asets/carousel/bmw.jpg" alt="BMW">
              <div class="carousel-caption">
              	<h3>BMW M4</h3>
                <p>See our range of BMW cars</p>
              </div>
            </div>
          </div>
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
      </div> <!--End of Carousel -->
    </div>
      <div id="sort" ng-show="sortTools" class="col-md-4 col-xs-12"> <!--Start of Sort tools-->
        <div class="col-md-4 col-xs-12"> <!-- Pagination-->
          <pagination ng-show="paginator" ng-change="search(currentPage)" total-items="numberOfItems" items-per-page="pageSizeInput2" ng-model="currentPage" max-size="5" class="pagination-sm"></pagination>
        </div>
        <div id="pageCount" class="col-md-2 col-xs-12"><!-- Page counter-->
          <p>Page {{currentPage}} of {{numberOfItems/pageSizeInput2 | roundup}}</p>
        </div>
        <div  id="dropdown" class="col-md-2 col-xs-12"><!-- Sort option selector-->
          <button class="btn btn-default dropdown-toggle" type="button" id="sortbtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Sort by
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="#" ng-click="sort('price')">Price <span class="glyphicon sort-icon" ng-show="sortKey=='price'" ng-class="{'glyphicon-chevron-down':!reverse, 'glyphicon-chevron-up':reverse}"></span></a></li>
            <li><a href="#" ng-click="sort('make')">Make <span class="glyphicon sort-icon" ng-show="sortKey=='make'" ng-class="{'glyphicon-chevron-down':!reverse, 'glyphicon-chevron-up':reverse}"></span></a></li>
            <li><a href="#" ng-click="sort('model')">Model <span class="glyphicon sort-icon" ng-show="sortKey=='model'" ng-class="{'glyphicon-chevron-down':!reverse, 'glyphicon-chevron-up':reverse}"></span></a></li>
          </ul>
        </div>
        <div id="page_size" class="col-md-2 col-xs-12"><!-- Page size selector-->
          <select class="form-control" ng-model="pageSizeInput2" ng-init="pageSizeInput2='5'" ng-change="search(currentPage)" ng-show="pages">
            <option value="5" selected>5</option>
            <option value="10">10</option>
            <option value="15">15</option>
          </select>
        </div>
      </div><!-- End of sort tools-->
      <div spinner></div><!-- Loader animation directive-->
      <div class="results_view" ng-show="results" ng-repeat="car in data |orderBy:sortKey:reverse | start: (currentPage - 1) * pageSizeInput2 | limitTo: pageSizeInput2" ><!-- Display Search results-->
        <div class="wrapper" class="col-md-12 col-xs-12"><!-- Search result wrapper-->
          <div id="car_preview" class="col-md-3 col-xs-12"><!-- Car image thumbnail-->
            <img class="img-thumbnail" ng-src="{{car.picture}}">
          </div>
          <div id="stats" class="col-md-3 col-xs-12"><!-- Car stats-->
            <p><p1 id="label">Make:</p1> {{ car.make }}</p>
            <p><p1 id="label">Model:</p1> {{ car.model }}</p>
            <p><p1 id="label">Colour:</p1> {{ car.colour }}</p>
            <p><p1 id="label">Miles:</p1> {{ car.miles }}</p>
          </div>
          <div id="price" class="col-md-3 col-xs-5"><!-- Price-->
            <p>£{{ car.price | number:0}}</p>
          </div>
          <div id="check" class="col-md-2 col-xs-5"><!-- Check car button-->
            <button type="button" id="button" class="btn btn-primary" ng-click="open(car); shareMyData(car); hideResults()">Check</button>
          </div>
        </div><!-- End of search result wrapper-->
      </div>
      <div ng-show="display" display></div><!-- Display selection directive-->
      <div class="col-md-4 col-xs-12"><!-- Bottom pagination-->
        <pagination ng-show="paginator" ng-change="search(currentPage)" total-items="numberOfItems" items-per-page="pageSizeInput2" ng-model="currentPage" max-size="5" class="pagination-sm"></pagination>
      </div>
    </div><!-- End of right pane-->
  </div><!-- End of contents container-->
</body>
