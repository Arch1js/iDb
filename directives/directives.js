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

app.directive("admin", function () {
	return {
		restrict: "A",
		templateUrl: "/views/admin_panel.php"
	}
});
app.directive("buy", function () {
	return {
		restrict: "A",
		templateUrl: "/views/buying_form.php"
	}
});
app.directive("spinner", function () {
	return {
		restrict: "A",
		templateUrl: "/views/loading_spinner.html"
	}
});
app.directive("breadcrumbs", function () {
	return {
		restrict: "A",
		templateUrl: "/views/checkout_breadcrumbs.html"
	}
});
