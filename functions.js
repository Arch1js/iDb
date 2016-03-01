var app = angular.module('carApp', []);


function adminCtrl($scope, $http) {
$scope.url = '/search.php';
    
    
$scope.adminSearch = function() {
        
        var data = {    
        make: $scope.make,
        colour: $scope.colour,
        milage: $scope.milage,
        carmodel: $scope.carmodel.model,
        minprice: $scope.minprice,
        maxprice: $scope.maxprice
    };
    
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
        $scope.data.push("Item "+i);
    }
		})

}
}

function SearchCtrl($scope, $http) {
	$scope.url = '/search.php'; // The url of our search
    $scope.url2 = '/refine_search.php';
    
    $scope.hideResults = function(){
     $scope.hideme = true;
        $scope.paginator = false;
     }
    
    $scope.showResults = function(){
     $scope.hideme = false;
        $scope.paginator = true;
     }
   
    $scope.open = function(car) {
        $scope.carresult = car;
    }
	// The function that will be executed on button click (ng-click="search()")
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
        
        var data = {    
        make: $scope.make,
        colour: $scope.colour,
        milage: $scope.milage,
        carmodel: $scope.carmodel.model,
        minprice: $scope.minprice,
        maxprice: $scope.maxprice
    };
        if($scope.colour == "white") {
            $scope.picture = "/Asets/Audi.jpg";
        }
        if($scope.colour == "black") {
            $scope.picture = "/Asets/Black.jpg";
        }
        
		
        
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
        $scope.data.push("Item "+i);
    }
		})
	};
    
    };

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

   


