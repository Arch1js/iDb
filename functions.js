var app = angular.module('carApp', []);


function adminCtrl($scope, $http) {
$scope.url = '/search.php';


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

		})

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

function SearchCtrl($scope, $http) {
	$scope.url = '/search.php'; 
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

/*$scope.setPage = function () {
        $scope.currentPage = this.n;
};*/   


