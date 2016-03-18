var app = angular.module('carApp', []);

function adminCtrl($scope, $http, $filter) {
$scope.url = '/search.php';

$scope.url2 = '/displayAllCars.php';
    
$http.post($scope.url2, data).
		success(function(data, status) {
			$scope.result = data;

        $scope.currentPage = 0;
            $scope.pageSize = 25;
            $scope.data = [];
            
    for (var i=0; i<data.length; i++) {
        $scope.data.push(i);
    }
		});
    
$scope.numberOfPages=function(){
                
            var myFilteredData = $filter('filter')($scope.data,$scope.search);
                
            return Math.ceil(myFilteredData.length/$scope.pageSize);                
        };
$scope.currentPage = 0;
$scope.pageSize = 25;   
$scope.data = [];
    
 $scope.numberOfPages=function(){
                
            var myFilteredData = $filter('filter')($scope.data,$scope.search);
                
            return Math.ceil(myFilteredData.length/$scope.pageSize);                

 }
        var data = {    
    };
    
$scope.paginator = true;
$scope.addRecord = function(i) {
 $scope.url = '/addRecord.php';   
    
        var data = {    
        make: $scope.add.make,
        model: $scope.add.model
        
    };
    
    $http.post($scope.url, data).
		success(function(data, status) {
			$scope.result = data;
            $scope.result.push(i);
		})
    
}
    
$scope.adminSearch = function() {
  $scope.url = '/displayAllCars.php';       
        var data = {    
        /*make: $scope.make,
        colour: $scope.colour,
        milage: $scope.milage,
        carmodel: $scope.carmodel.model,
        minprice: $scope.minprice,
        maxprice: $scope.maxprice*/
    };
    
    $http.post($scope.url, data).
		success(function(data, status) {
			$scope.result = data;

        $scope.currentPage = 0;
            $scope.pageSize = 25;
            $scope.data = [];
            $scope.numberOfPages=function(){
                
            var myFilteredData = $filter('filter')($scope.data,$scope.search);
                
            return Math.ceil(myFilteredData.length/$scope.pageSize);                
        }
    for (var i=0; i<data.length; i++) {
        $scope.data.push(i);
    }
		})
$scope.paginator = true;
}

$scope.delete_item = function(i) {
        $scope.item = i;
    $scope.url = '/deleteRecord.php';       
        var data = {    
        make: i.make     
    };
    $scope.result.splice($scope.result.indexOf(i), 1); //remove deleted item from view
    $http.post($scope.url, data).
		success(function() {
        $scope.$apply(function(){
      
    });
		}) 
    }


}

function SearchCtrl($scope, $http, srvShareData, $location) {
      
  $scope.shareMyData = function (car) {
      $scope.sharedData = srvShareData.removeData();
      srvShareData.addData(car);  
  }
  
  $scope.transfer = function() {
      window.location.href = "checkout.html";
  }
    
	$scope.url = '/search.php'; 
    $scope.url2 = '/refine_search.php';
    
    $scope.hideResults = function(){
     $scope.results = false;
     $scope.display = true;
     $scope.paginator = false;
     }
    
    $scope.showResults = function(){
     $scope.results = true;
     $scope.display = false;
     }
    $scope.showPaginator = function() {
      $scope.paginator = true;  
    }
   
    $scope.open = function(car) {
        $scope.carresult = car;
    }
    
    $scope.refine = function() {
        
        var data = {    
        make: $scope.make
           
    };
		
		$http.post($scope.url2, data).
		success(function(data, status) {
			$scope.result2 = data;
    })
    };
                
	$scope.search = function() {
        $scope.results = false;
        $scope.display = false;
        $scope.paginator = false;
        var data = {    
        /*make: $scope.make,
        colour: $scope.colour,
        milage: $scope.milage,
        carmodel: $scope.carmodel.model,
        minprice: $scope.minprice,
        maxprice: $scope.maxprice*/
    };
        $scope.loading = true;
        
		$http.post($scope.url, data).
        
		success(function(data, status) {
			$scope.result = data;

            $scope.currentPage = 0;
            $scope.pageSize = 5;
            $scope.data = [];
            $scope.numberOfPages=function(){
                
            return Math.ceil($scope.data.length/$scope.pageSize);                
        }
    for (var i=0; i<data.length; i++) {
        $scope.data.push(i);
    }
		})
        .catch(function (err) {
      // Log error somehow.
    })
    .finally(function () {
      // Hide loading spinner whether our call succeeded or failed.
      $scope.loading = false;
      $scope.results = true;
      $scope.paginator = true;
    });
        
	};
    
};

function CheckoutCtrl($scope, $http, srvShareData) {
    
$scope.sharedData = srvShareData.getData();
    
$scope.addCustomerInfo = function() {
 $scope.url = '/addCustomerInfo.php';   
    
        var data = {    
        name: $scope.name,
        lastName: $scope.lastName,
        address: $scope.address,
        email: $scope.email,
        cardNo: $scope.cardNo,
        month: $scope.month,
        year: $scope.year,
        cvv: $scope.cvv
        
    };
    
    $http.post($scope.url, data).
		success(function(data, status) {
			$scope.result = data;
		})
  window.location.href = "confirmedPage.html";  
};

$scope.sendEmail = function() {
    $scope.url = '/sendEmail.php';   
    
        var data = {    
        email: $scope.email      
    };
    
    $http.post($scope.url, data).
		success(function(data, status) {
			$scope.result = data;
		})
}
};

app.service('srvShareData', function($window) {
        var KEY = 'Value';

        var addData = function(newObj) {

              mydata = [];
            
            mydata.push(newObj);
            $window.sessionStorage.setItem(KEY, JSON.stringify(mydata));
        };

        var getData = function(){
            var mydata = $window.sessionStorage.getItem(KEY);
            if (mydata) {
                mydata = JSON.parse(mydata);
            }
            return mydata;
        };
    var removeData = function(){
          $window.sessionStorage.removeItem(KEY);
        }

        return {
            addData: addData,
            getData: getData,
            removeData: removeData
        };
    });

app.filter('unique', function() {
    return function(input, key) {
        var unique = {};
        var uniqueList = [];
        for(var i = 0; i < input.length; i++){
            if(typeof unique[input[i][key]] == "undefined"){
                unique[input[i][key]] = "";
                uniqueList.push(input[i]);
            }
        }
        return uniqueList;
    };
});

app.filter('startFrom', function() {
    return function(input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
});

/*$scope.setPage = function () {
        $scope.currentPage = this.n;
};*/   


