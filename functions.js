var app = angular.module('carApp', ['ui.bootstrap']);

function confirmCtrl($scope, $http, srvShareData) {
	$scope.sharedData = srvShareData.getData();

	$scope.date = new Date();
	var numberOfDaysAdded = 3;
  $scope.newdate = $scope.date.setDate($scope.date.getDate() + numberOfDaysAdded);
}

function adminCtrl($scope, $http, $filter) {
	var data = {

	};
	$scope.currentPage = 1;
	// $scope.loadMore = [];
		$scope.data = [];
	$scope.data2 = [];

	$scope.url2 = '/displayAllCars.php';

$scope.displayData=function(page){
	$scope.currentPage = page;
	$scope.loading = true;
	$scope.paginator = false;
	$scope.perpage=false;

		var incr = $scope.pageSizeInput * $scope.currentPage;
		$scope.first = 0;
			var data = {
				quick: $scope.quicksearch,
				set:$scope.first,
				dataCount: incr,
				make: $scope.search.make,
				model: $scope.search.model,
				reg:  $scope.search.Reg,
				colour:  $scope.search.colour,
				milage: $scope.search.miles,
				price:  $scope.search.price
	};

		$http.post($scope.url2, data).
				success(function(data,status) {
					// if(!$scope.data.length) {
					// 	$scope.data= data[0];
					// }
					// else {
					// 	$scope.loadMore = data[0];
					// 	$scope.data = $scope.data.concat($scope.loadMore);
					// }
								$scope.data= data[0];
								$scope.data2 = data[1];
								$scope.numberOfItems = $scope.data2[0].count;

					$scope.paginator = true;
					$scope.loading = false;
					$scope.perpage=true;
				});
		};

$scope.sort = function(keyname){
			$scope.sortKey = keyname;   //set the sortKey to the param passed
			$scope.reverse = !$scope.reverse; //if true make it false and vice versa
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
				picture: $scope.add.picture,
				status: $scope.add.status,
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
				status: $scope.record.status,
				picture: $scope.record.picture,
				index: $scope.record.carIndex,
    };

    $http.post($scope.url, data).
		success(function(data, status) {

		})

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

	$scope.currentPage = 1;
	$scope.data = [];
	$scope.data2 = [];

	$scope.url = '/search.php';
		$scope.url2 = '/refine_search.php';

	$scope.sendEmail = function() {
	    $scope.url = '/sendEmail.php';

	        var data = {
	        email: $scope.userEmail,
					make: $scope.carresult.make,
					model: $scope.carresult.model,
					miles: $scope.carresult.miles,
					price: $scope.carresult.price,
					colour: $scope.carresult.colour
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

		$scope.search=function(page){
			$scope.url2 = '/search.php';
			$scope.currentPage = page;
				var incr = $scope.pageSizeInput2 * $scope.currentPage;
				$scope.first = 0;
					var data = {
						dataCount: incr,
						make: $scope.make,
		        colour: $scope.colour,
		        milage: $scope.milage,
						carmodel: $scope.carmodel,
		        minprice: $scope.minprice,
		        maxprice: $scope.maxprice
			};

				$http.post($scope.url2, data).
						success(function(data,status) {
							$scope.sortTools = true;
							$scope.error = false;
							$scope.results = true;
							$scope.display = false;
							$scope.paginator = true;
							$scope.pages = true;

										$scope.data = data[0];
										$scope.data2 = data[1];
										$scope.numberOfItems = $scope.data2[0].count;

							// $scope.paginator = true;
							// $scope.loading = false;
							// $scope.perpage=true;
						});
				};

};

function CheckoutCtrl($scope, $http, srvShareData) {

$scope.sharedData = srvShareData.getData();

$(document).ready(function(){
$("#customer-form, #customer-form2").validate({
			 rules: {
					 name: {
							 minlength: 1,
							 required: true
					 },
					 last: {
							 minlength: 1,
							 required: true
					 },
					 address: {
							 minlength: 1,
							 required: true
					 },
					 email: {
							 minlength: 1,
							 required: true
					 },
					 card: {
							 minlength: 16,
							 required: true
					 },
					 month: {
							 minlength: 2,
							 required: true
					 },
					 year: {
							 minlength: 2,
							 required: true
					 },
					 cvv: {
							 minlength: 3,
							 required: true
					 }

			 },
			 highlight: function(element) {
	$(element).closest('.control-group').removeClass('has-success').addClass('has-error');
	$('#submit').addClass('disabled');
	// $('#submit').removeAttr("data-toggle", "modal");
},
success: function(element) {
	element

	.closest('.control-group').removeClass('has-error').addClass('has-success');
	$('#submit').removeClass('disabled');
	// $('#submit').attr("data-toggle", "modal");
}
});
$("#customer-form2").validate({
			 rules: {
					 card: {
							 minlength: 16,
							 required: true
					 },
					 month: {
							 minlength: 2,
							 required: true
					 },
					 year: {
							 minlength: 2,
							 required: true
					 },
					 cvv: {
							 minlength: 3,
							 required: true
					 }

			 },
			 highlight: function(element) {
	$(element).closest('.control-group').removeClass('has-success').addClass('has-error');
	$('#submit').addClass('disabled');
	$('#submit').removeAttr("data-toggle", "modal");
},
success: function(element) {
	element

	.closest('.control-group').removeClass('has-error').addClass('has-success');
	$('#submit').removeClass('disabled');
	$('#submit').attr("data-toggle", "modal");
}
});
 });

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
};

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
app.filter('roundup', function () {
        return function (value) {
            return Math.ceil(value);
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
