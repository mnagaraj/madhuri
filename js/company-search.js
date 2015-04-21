var myApp = angular.module('companysearch', []);

myApp.controller('menuCtrl', ['$scope', '$http', function ($scope, $http) {
	var xmlHttp = null;

	xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET", "http://default-environment-nqhpgmhyii.elasticbeanstalk.com/talentAttributes.php", false );
	xmlHttp.send( null );
	//var data = xmlHttp.responseText;
	$scope.attributes = xmlHttp.responseText;
	$scope.attributeUrl = "./attributes.json";
	xmlHttp.open( "GET", "http://default-environment-nqhpgmhyii.elasticbeanstalk.com/search.php?profile=talent", false );
	xmlHttp.send( null );
	//var data = xmlHttp.responseText;
	$scope.university = xmlHttp.responseText;
	$scope.majors = [];
	$scope.degrees = [];
	$scope.gpa = [];
	$scope.graduationyear = [2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018];
	//$scope.years = [];
	//$scope.companies = [];

	$scope.loadAttributes = function () {
		//$http.get($scope.attributeUrl).success( function (response) {
			response = JSON.parse($scope.attributes);

			$scope.universities = response.universities;
			$scope.degrees = response.degrees;
			$scope.majors = response.majors;
		//	$scope.gpa = response.gpa;
		//	$scope.graduationYear = response.graduationyear;
		//});
	};

	$scope.loadCompanies = function () {
		$//http.get($scope.companyUrl).success( function (response) {
			response = JSON.parse($scope.company);
			$scope.companies = response;
		//});
	};

	$scope.loadAttributes();
//	$scope.loadCompanies();

	$scope.universityFilter = function (item) {
	    if ($scope.byUniversityFilter === undefined || $scope.byUniversityFilter.length == 0) {
	        return true;
	    }

	    var filter = $scope.byUniversityFilter;

	    for (var i in filter) {
	    	var target = filter[i];
	    	var source = item.university;
	    	if (source.indexOf(target) >= 0) {
	    		return true;
	    	}
	    }

    	return false;
	}

	$scope.degreeFilter = function (item) {
	    if ($scope.byDegreeFilter === undefined || $scope.byDegreeFilter.length == 0) {
	        return true;
	    }

	    var filter = $scope.byDegreeFilter;

	    for (var i in filter) {
	    	var target = filter[i];
	    	var source = item.degree;
	    	if (source.indexOf(target) >= 0) {
	    		return true;
	    	}
	    }

    	return false;
	}

	$scope.majorFilter = function (item) {
	    if ($scope.byMajorFilter === undefined || $scope.byMajorFilter.length == 0) {
	        return true;
	    }

	    var filter = $scope.byMajorFilter;

	    for (var i in filter) {
	    	var target = filter[i];
	    	var source = item.major;
	    	if (source.indexOf(target) >= 0) {
	    		return true;
	    	}
	    }

    	return false;
	}

	$scope.graduationYearFilter = function (item) {
	    if ($scope.bygraduationYearFilter === undefined || $scope.bygraduationYearFilter.length == 0) {
	        return true;
	    }

	    var filter = $scope.bygraduationYearFilter;

	    for (var i in filter) {
	    	var target = filter[i];
	    	var source = item.graduationYear;
	    	if (source.indexOf(target) >= 0) {
	    		return true;
	    	}
	    }

    	return false;
	}

	$scope.gpaFilter = function (item) {
	    if ($scope.byGpaFilter === undefined || $scope.byGpaFilter.length == 0) {
	        return true;
	    }

	    console.log(item);

	    var filter = $scope.byGpaFilter;

	    console.log(filter);

	    for (var i in filter) {
	    	var target = filter[i];
	    	var source = item.gpa;
	    	if (source.indexOf(target) >= 0) {
	    		return true;
	    	}
	    }

    	return false;
	}
}]);