var app = angular.module('carApp', ['ui.bootstrap']);

function confirmCtrl($scope, $http, srvShareData) {
	$scope.sharedData = srvShareData.getData();

	$scope.date = new Date();
	var numberOfDaysAdded = 3;
  $scope.newdate = $scope.date.setDate($scope.date.getDate() + numberOfDaysAdded);
}

function adminCtrl($scope, $http, $filter) {
	$scope.url = '/search.php';

	$scope.url2 = '/displayAllCars.php';
	$scope.displayAllData=function(){
	$http.post($scope.url2, data).
			success(function(data, status) {
							$scope.result = data;
							$scope.currentPage = 1;
	            $scope.pageSize = 45;
	            $scope.data = [];

	    for (var i=0; i<data.length; i++) {
	        $scope.data.push(i);
	    }
				$scope.paginator = true;
			});
		};

	var data = {
};
$scope.sort = function(keyname){
			$scope.sortKey = keyname;   //set the sortKey to the param passed
			$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
$scope.hideEdit = function() {
	$scope.edit_record = false;
}
$scope.hideDelete = function() {
	$scope.delete_record = false;
}
$scope.hideAdvanced = function() {
	$scope.advanced = false;
}

$scope.addRecord = function(i) {
 $scope.url = '/addRecord.php';

        var data = {
        make: $scope.add.make,
        model: $scope.add.model,
				Reg: $scope.add.reg,
				colour: $scope.add.colour,
				miles: $scope.add.miles,
				price: $scope.add.price,
				dealer: $scope.add.dealer,
				town: $scope.add.town,
				telephone: $scope.add.tel,
				description: $scope.add.desc,
				region: $scope.add.region,
    };

    $http.post($scope.url, data).
		success(function(data, status) {

		})
$scope.result.push(data);

}
$scope.updateRecord = function(record) {
 $scope.url = '/updateRecord.php';

        var data = {
        make: $scope.record.make,
        model: $scope.record.model,
				Reg: $scope.record.Reg,
				colour: $scope.record.colour,
				miles: $scope.record.miles,
				price: $scope.record.price,
				dealer: $scope.record.dealer,
				town: $scope.record.town,
				telephone: $scope.record.telephone,
				description: $scope.record.description,
				region: $scope.record.region,
				index: $scope.record.carIndex,
    };

    $http.post($scope.url, data).
		success(function(data, status) {

		})
// $scope.result.push(data);

}
$scope.open = function(i) {
		$scope.record = i;
}

$scope.delete_item = function(i) {
        $scope.item = i;
    $scope.url = '/deleteRecord.php';
        var data = {
        index: i.carIndex
    };
    $scope.result.splice($scope.result.indexOf(i), 1); //remove deleted item from view
    $http.post($scope.url, data).
		success(function() {
        $scope.$apply(function(){
    });
		})
    }

}

function SearchCtrl($scope, $http, srvShareData, $location, $filter) {

	$scope.sendEmail = function() {
	    $scope.url = '/sendEmail.php';

	        var data = {
	        email: $scope.userEmail
	    };

	    $http.post($scope.url, data).
			success(function(data, status) {
				$scope.result = data;
			})
	}

	$scope.sort = function(keyname){
        $scope.sortKey = keyname;
        $scope.reverse = !$scope.reverse;
    }
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
		 $scope.sortTools = false;
     }

    $scope.showResults = function(){
     $scope.results = true;
     $scope.display = false;
		 $scope.sortTools = true;
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
    }

	$scope.search = function() {
				$scope.sortTools = false;
        $scope.error = false;
        $scope.results = false;
        $scope.display = false;
        $scope.paginator = false;
        var data = {
        make: $scope.make,
        colour: $scope.colour,
        milage: $scope.milage,
        // carmodel: $scope.carmodel.model,
        minprice: $scope.minprice,
        maxprice: $scope.maxprice,
    };
        $scope.loading = true;

		$http.post($scope.url, data).

		success(function(data, status) {
			$scope.result = data;

						$scope.currentPage = 1;
						$scope.pageSize = 8;
            $scope.data = [];

    for (var i=0; i<data.length; i++) {
        $scope.data.push(i);
    }
		$scope.totalItems = $scope.data.length;
            if($scope.result == "") {
                $scope.error = true;
            }
            else {
                $scope.error = false;
                $scope.results = true;
                $scope.paginator = true;
								$scope.sortTools = true;
            }
            $scope.loading = false;
		})
        .catch(function(err) {
            $scope.error = true;
        })

	};
	// $scope.setPage = function () { //For bootstrap pagination
	//         $scope.currentPage = this.n;
	//     };

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

app.filter('start', function () {
    return function (input, start) {
        if (!input || !input.length) { return; }

        start = +start;
        return input.slice(start);
    };
});

// app.filter('startFrom', function() {
//     return function(input, start) {
//         start = +start; //parse to int
//         return input.slice(start);
//     }
// });

/*$scope.setPage = function () {
        $scope.currentPage = this.n;
};*/
