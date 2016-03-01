app.directive("navbar", function () {
	return {
		restrict: "A",
		templateUrl: "/views/nav-bar.html"
	}
});

app.directive("display", function () {
	return {
		restrict: "A",
		templateUrl: "/views/display.html"
	}
});

app.directive("search", function () {
	return {
		restrict: "A",
		templateUrl: "/views/search_view.php"
	}
});