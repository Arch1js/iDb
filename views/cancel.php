<!DOCTYPE html>
<html ng-app="carApp">
  <head>
    <meta charset="UTF-8">
    <title>CarGo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../dependencies/bootstrap/css/bootstrap.css"><!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/checkout.css"><!-- Checkout Stylesheet -->

    <script src="../dependencies/angular.min.js"></script><!-- AngularJS -->
    <script src="../dependencies/ui-bootstrap-tpls-1.2.5.js"></script> <!-- Bootstrap UI -->
    <script src="../dependencies/jquery-2.2.2.min.js"></script> <!-- JQuery -->
    <script src="../dependencies/bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->

    <!-- Services -->
    <script src="../functions.js"></script>
    <!-- Directives -->
    <script src="../directives/directives.js"></script>
  </head>
  <body>
    <div navbar></div><!-- Navigation bar directive -->
    <div class="col-md-10 col-centered"><!-- Error message container -->
      <div class="alert alert-danger" role="alert"><b>Oh snap!</b> Your payment was rejected!</div>
    </div>
  </body>
</html>
