var app = angular.module('carApp', ['ui.bootstrap']);

function confirmCtrl($scope, $http, srvShareData) {
	$scope.sharedData = srvShareData.getData();

	$scope.date = new Date();
	var numberOfDaysAdded = 3;
  $scope.newdate = $scope.date.setDate($scope.date.getDate() + numberOfDaysAdded);
}

function adminCtrl($scope, $http, $filter) {
	$scope.currentPage = 1;
	$scope.data = [];
	$scope.data2 = [];
	$scope.orderdata = [];
	$scope.orderdata2 = [];

	$scope.url = '/displayOrders.php';
	$scope.url2 = '/displayAllCars.php';
	var data = {

	};
	$scope.changePageToFirst = function(page) {
		$scope.currentPage = 1;
	}

	$scope.displayOrders = function(page) {
		$scope.loading = true;
		var incr = $scope.pageSizeInput3 * $scope.currentPage;
		if($scope.currentPage == 1) {
					var start = 0;
		}
		else {
					var start = page;
		}
		var data = {
			start:start,
			incr: incr
};
$http.post($scope.url, data).
		success(function(data,status) {
			if(!$scope.orderdata.length) {
				$scope.orderdata= data[0];
			}
			else {
				$scope.loadMore = data[0];
				$scope.orderdata = $scope.orderdata.concat($scope.loadMore);
			}
						$scope.orderdata= data[0];
						$scope.orderdata2 = data[1];
						$scope.numberOfItems2 = $scope.orderdata2[0].count;
						$scope.controls = true;
						$scope.loading = false;
	});
}


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

								if($scope.data2[0].count == 0) {
									$scope.query_error = true;
									$scope.loading = false;
								}
								else {
									$scope.query_error = false;
									$scope.paginator = true;
									$scope.loading = false;
									$scope.perpage=true;
								}
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
    $http.post($scope.url, data);

$scope.data.push(data);

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

$scope.delete_item = function() {

    $scope.url = '/deleteRecord.php';
        var data = {
        index: $scope.record.carIndex
    };
    $scope.data.splice($scope.data.indexOf($scope.record.carIndex), 1); //remove deleted item from view
    $http.post($scope.url, data).
		success(function() {
        $scope.$apply(function(){
    });
		})
	};

}

function SearchCtrl($scope, $http, srvShareData, $location, $filter) { //Car search page controller
	$(function(){ //Carousel slide controller
    $('.carousel').carousel({
      interval: 4000
    });
	});
	$scope.carousel = true; //show carousel when page loads
	$scope.currentPage = 1;
	$scope.loadMore = []; //temporary array for storing additional loaded records
	$scope.data = []; //array for storing search results
	$scope.data2 = []; //search reslut count array
	$scope.result2 = []; //car make array

	$scope.url = '/search.php'; //data post urls
	$scope.url2 = '/refine_search.php';

	$scope.search=function(page){ //Main car search function
		$scope.paginator = false; //hide elements when new search results are loading
		$scope.loading = true;
		$scope.perpage=false;
		$scope.results = false;
		$scope.carousel = false;
		$scope.display = false;

		$scope.currentPage = page;
		var incr = $scope.pageSizeInput2 * $scope.currentPage; //increse limit passed to sql

		if($scope.currentPage == 1) { //if current page is 1, set start limit to 0
			var start = 0;
		}
		else {
			var start = page;
		}
				var data = { //data to be posted to php function
					dataCount: incr,
					start: start,
					make: $scope.make,
					colour: $scope.colour,
					milage: $scope.milage,
					carmodel: $scope.carmodel,
					minprice: $scope.minprice,
					maxprice: $scope.maxprice
		};

			$http.post($scope.url, data) //posts data to search.php
			.success(function(data,status) { //returned data from php

			if(!$scope.data.length) { //if data array is empty
				$scope.data= data[0]; //add search results to array
			}
			else { //if not
				$scope.loadMore = data[0]; //add new data to temporary array and concatonate with previous data
				$scope.data = $scope.data.concat($scope.loadMore);
			}
				$scope.data = data[0]; //search results
				$scope.data2 = data[1]; //search result count
				$scope.numberOfItems = $scope.data2[0].count;

				if($scope.data2[0].count == 0) { //if search query fails, display error message
					$scope.error = true;
					$scope.loading = false;
					$scope.sortTools = false;
				}
				else {
					$scope.sortTools = true;
					$scope.error = false;
					$scope.results = true;
					$scope.display = false;
					$scope.paginator = true;
					$scope.pages = true;
					$scope.loading = false;
				}
			});
		};

		$scope.transfer = function() { //transfer user to checkout page
	      window.location.href = "checkout.html?make="+$scope.carresult.make+"&model="+$scope.carresult.model+"&colour="+$scope.carresult.colour+"&miles="+$scope.carresult.miles+"&price="+$scope.carresult.price;
	  }
	$scope.sendEmail = function() { //send car information email to customer
	    $scope.url = '/sendEmail.php'; //data post url

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

	$scope.sort = function(keyname){ //sort results by make,model or price
        $scope.sortKey = keyname;
        $scope.reverse = !$scope.reverse;
    }

  $scope.hideResults = function(){ //function for multiple elemet hiding/showing
     $scope.results = false;
     $scope.display = true;
     $scope.paginator = false;
		 $scope.sortTools = false;
    }

    $scope.showResults = function(){ //function to show/hide multiple elements
     $scope.results = true;
     $scope.display = false;
		 $scope.sortTools = true;
     }

    $scope.open = function(car) { //share selected element data between search_view and display page
        $scope.carresult = car;
    }

    $scope.refine = function() { //refine all car models from database based on make selection
        var data = {
        make: $scope.make
    };

		$http.post($scope.url2, data).
		success(function(data, status) {
			$scope.result2 = data;
    })
    }
		$scope.shareMyData = function (car) {
				$scope.sharedData = srvShareData.removeData();
				srvShareData.addData(car);
		}
};

function CheckoutCtrl($scope, $http, $location) { //Checkout page controller
	$scope.url = '/displayCarInfo.php'; //data post url

	function getParameterByName(name, url) { //function to get url parameters
			if (!url) url = window.location.href;
			name = name.replace(/[\[\]]/g, "\\$&");
			var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
					results = regex.exec(url);
			if (!results) return null;
			if (!results[2]) return '';
			return decodeURIComponent(results[2].replace(/\+/g, " "));
	}

	//On page load get url parameters and post it to url above
	var make = getParameterByName('make');
	var model = getParameterByName('model');
	var colour = getParameterByName('colour');
	var price = getParameterByName('price');
	var miles = getParameterByName('miles');
		var data = {
			make: make,
			model: model,
			colour: colour,
			price: price,
			miles: miles
		};

		$http.post($scope.url, data).
			success(function(data, status) {
					$scope.result = data;
					if($scope.result == 0) { //if returened data count is 0, display error
						$scope.error = true;
					}
					else { //if not, display results
						$scope.carResults = true;
					}
				});

$(document).ready(function(){ //form validation function
	$('#submit').removeAttr("data-toggle", "modal");
	$("#customer-form").validate({
		submitHandler: function(form) {
    $('#submit').attr("data-toggle", "modal");
		$('#submit').click();
  },
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
					$('#submit').removeAttr("data-toggle", "modal");
				},
			success: function(element) {
				$(element).closest('.control-group').removeClass('has-error').addClass('has-success');
				$('#submit').removeClass('disabled');
			}
		});
 });

$scope.addCustomerInfo = function() { //function to add customer information to database
 $scope.url = '/addCustomerInfo.php';
        var data = {
        name: $scope.name,
        lastName: $scope.lastName,
        address: $scope.address,
        email: $scope.email,
        cardNo: $scope.cardNo,
        month: $scope.month,
        year: $scope.year,
        cvv: $scope.cvv,
				carIndex: $scope.data.carIndex
    };

    $http.post($scope.url, data);
  	window.location.href = "confirmedPage.html"; //redirect user to confirmed page when data is writen to database
};

$scope.sendEmail = function() { //send confirmation email
    $scope.url = '/sendConfirmEmail.php';
        var data = {
        email: $scope.email
    };
    $http.post($scope.url, data);
};

};

app.service('srvShareData', function($window) { //use session to store order information
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

app.filter('unique', function() { //unique records filter
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

app.filter('start', function () { //splice search results for pagination
    return function (input, start) {
        if (!input || !input.length) { return; }

        start = +start;
        return input.slice(start);
    };
});
app.filter('roundup', function () { //page number rounding filter
        return function (value) {
            return Math.ceil(value);
        };
    });
