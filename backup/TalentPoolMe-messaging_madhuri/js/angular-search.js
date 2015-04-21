var myApp = angular.module('search', []);

myApp.controller('menuCtrl', ['$scope', '$http', function ($scope, $http) {
	var xmlHttp = null;

	xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET", "http://default-environment-nqhpgmhyii.elasticbeanstalk.com/attributes.php", false );
	xmlHttp.send( null );
	//var data = xmlHttp.responseText;
	$scope.attributes = xmlHttp.responseText;
	$scope.attributeUrl = "./attributes.json";
	xmlHttp.open( "GET", "http://default-environment-nqhpgmhyii.elasticbeanstalk.com/search.php", false );
	xmlHttp.send( null );
	//var data = xmlHttp.responseText;
	$scope.company = xmlHttp.responseText;
	$scope.companyUrl = "./company.json";
	$scope.states = [];
	$scope.industries = [];
	$scope.sizes = [];
	$scope.types = [];
	$scope.years = [];
	$scope.companies = [];

	$scope.loadAttributes = function () {
		//$http.get($scope.attributeUrl).success( function (response) {
			response = JSON.parse($scope.attributes);

			$scope.states = response.states;
			$scope.industries = response.industries;
			$scope.sizes = response.sizes;
			$scope.types = response.types;
			$scope.years = response.years;
		//});
	};

	$scope.loadCompanies = function () {
		$//http.get($scope.companyUrl).success( function (response) {
			response = JSON.parse($scope.company);
			$scope.companies = response;
		//});
	};

	$scope.loadAttributes();
	$scope.loadCompanies();

	$scope.stateFilter = function (item) {
	    if ($scope.byStateFilter === undefined || $scope.byStateFilter.length == 0) {
	        return true;
	    }

	    var filter = $scope.byStateFilter;

	    for (var i in filter) {
	    	var target = filter[i];
	    	var source = item.state;
	    	if (source.indexOf(target) >= 0) {
	    		return true;
	    	}
	    }

    	return false;
	}

	$scope.industryFilter = function (item) {
	    if ($scope.byIndustryFilter === undefined || $scope.byIndustryFilter.length == 0) {
	        return true;
	    }

	    var filter = $scope.byIndustryFilter;

	    for (var i in filter) {
	    	var target = filter[i];
	    	var source = item.industry;
	    	if (source.indexOf(target) >= 0) {
	    		return true;
	    	}
	    }

    	return false;
	}

	$scope.sizeFilter = function (item) {
	    if ($scope.bySizeFilter === undefined || $scope.bySizeFilter.length == 0) {
	        return true;
	    }

	    var filter = $scope.bySizeFilter;

	    for (var i in filter) {
	    	var target = filter[i];
	    	var source = item.size;
	    	if (source.indexOf(target) >= 0) {
	    		return true;
	    	}
	    }

    	return false;
	}

	$scope.typeFilter = function (item) {
	    if ($scope.byTypeFilter === undefined || $scope.byTypeFilter.length == 0) {
	        return true;
	    }

	    var filter = $scope.byTypeFilter;

	    for (var i in filter) {
	    	var target = filter[i];
	    	var source = item.type;
	    	if (source.indexOf(target) >= 0) {
	    		return true;
	    	}
	    }

    	return false;
	}

	$scope.yearFilter = function (item) {
	    if ($scope.byYearFilter === undefined || $scope.byYearFilter.length == 0) {
	        return true;
	    }

	    console.log(item);

	    var filter = $scope.byYearFilter;

	    console.log(filter);

	    for (var i in filter) {
	    	var target = filter[i];
	    	var source = item.founded;
	    	if (source.indexOf(target) >= 0) {
	    		return true;
	    	}
	    }

    	return false;
	}
}]);