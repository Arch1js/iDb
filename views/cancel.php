<!DOCTYPE html>
<html ng-app="carApp">
    <head>
        <meta charset="UTF-8">
        <title>CarGo error</title>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular.js"></script><!-- AngularJS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="../css/confirmation_style.css"><!-- Stylesheet -->
        <!-- Services -->
        <script src="../functions.js"></script>

        <!-- Directives -->
        <script src="../directives/directives.js"></script>
</head>
<body ng-controller="confirmCtrl" data-ng-init="getOrderNo()">
    <div navbar></div><!-- Link to navigation bar html -->
    <div class="col-md-10 col-centered">
      <div class="alert alert-danger" role="alert"><b>Oh snap!</b> Your payment was rejected!</div>
    </div>
    </body>
</html>
