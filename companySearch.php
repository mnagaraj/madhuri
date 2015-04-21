<?PHP
session_start();
if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
    //header ("Location: login.php");
}
//print_r($_SESSION); 
?>
<!DOCTYPE html>
<html lang="en" ng-app="companysearch">
   <head>
       <title>TalentPoolMe</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link href="./css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/chosen.min.css" rel="stylesheet" />
		<link href="./css/style.css" rel="stylesheet">
		<link href="./css/style-searchPage.css" rel="stylesheet" />
       <script src="./js/jquery-1.11.2.min.js"></script> 
     <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
       
       <script "text/javascript">
	      $(document).ready(function() {
		  $("#inputGrp1").validate({
			rules: {
            },
            
           submitHandler: function(form) {
               $.ajax({
        url: 'http://default-environment-nqhpgmhyii.elasticbeanstalk.com/search.php',
        data: {
            profile: 'company',
            username: $('#companyName').val(),
        },
        dataType:'json',         
        error: function() {
        },
        success: function(data) {  
            var text="";
                var obj = data;
                text+=("<div ng-repeat=company in filtered = (companies | filter:stateFilter | filter:industryFilter | filter:sizeFilter | filter:typeFilter | filter:yearFilter)>");
                text+=("<table class=table table-strippedb>");
                text+=("<tr>");
                text+=("<td class=com-left>");
                text+=("<img width=200em height=200em src="+obj.image+" </img>");
                text+=("</td>");
                text+=("<td class=com-right>");
                text+=("<p>University Name: "+obj.name+"</p>");
                text+=("<p>Major: "+obj.major+"</p>");
                text+=("<p>Degree: "+obj.degree+"</p>");
                text+=("<p>Graduation Year: "+obj.graduationYear+"</p>");
                text+=("<p>GPA: "+obj.gpa+"</p>");
                text+=("</td>");
                text+=("</tr>");
                text+=("</table>");
                text+=("</div>");
            $("#companyList2").html(text);         
        },
        type: 'POST'
    });
        }, 
            
		});
        
});
	</script>
    </head>
	
    <body ng-controller="menuCtrl">
        <div id="top" class="container">
            <div id="talentMenu">
                <table id="talentTitle">
                    <tr>
						<td class="leftPart"><img alt="Brand" src="img/200.jpg"></td>
						<td class="rightPart">
							<img src="./img/user_logo.jpg"> User Name
						</td>
					</tr>
                </table>
            </div>
			<!-- Static navbar -->
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
				  <div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
				  </div>
				  <div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
					  <li class="active"><a href="#">Home</a></li>
					  <li><a href="talent.html">Talent</a></li>
					  <li><a href="#">Employers</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
					  <li class="active"><a href="#">Notifications <span class="sr-only">(current)</span><span class="custom_bubble">9</span></a></li>
					  <li><a href="#">Update</a></li>
					</ul>
				  </div><!--/.nav-collapse -->
				</div><!--/.container-fluid -->
			</nav>
		
			<div class="row">
				<div>
					<div class="col-sm-4 col-md-4 col-lg-4" id="titleArea">
						<h2>Viewing all {{filtered.length}} companies</h2>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4" id="searchBoxArea">
						<div id="nameSearchArea">
							<form id="inputGrp1" name="inputGrp1" method="POST" class="input-group">
	                            <input type="text" class="typeahead" autocomplete="off" id="companyName" name="companyName" spellcheck="false" placeholder="Search for a company" />
	                            <span>
	                            	<button id="searchBtn" class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
	                            </span>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-6" id="companyList2" name="companyList2">
					<div ng-repeat="company in filtered = (companies | filter:stateFilter | filter:industryFilter | filter:sizeFilter | filter:typeFilter | filter:yearFilter)">
						<table id="companyList" class="table table-strippedb">
							<tr>
								<td class="com-left">
									<img ng-src="{{company.imgUrl}}" width="100em" height="100em">
								</td>
								
							</tr>
						</table>
					</div>
				</div>

				<div class="col-sm-5 col-md-5 col-lg-5 col-sm-offset-1 col-md-offset-1 col-lg-offset-1" id="searchArea">					
					<div id="filterSearchArea">
						<h3><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> Refine your search</h3>
						<form id="inputGrp2">
							<table id="filters" class="table-responsive">
								<tr>
									<td>
										<h4>university</h4>
									</td>
									<td>
										<select multiple id="filterOption-university" class="form-control filter-item" ng-model="byUniversityFilter" data-placeholder="Choose University">
											<option value="">All</option>
											<option ng-repeat="university in universities" value="{{university.value}}">{{university.value}}</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<h4>major</h4>
									</td>
									<td>
										<select multiple name="major" id="major" class="form-control filter-item" ng-model="byMajorFilter" data-placeholder="Choose Major">
											<option value="">All</option>
											<option ng-repeat="major in majors" value="{{major.value}}">{{major.display}}</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<h4>graduation year</h4>
									</td>
									<td>
										<select multiple id="graduationyear" class="form-control filter-item" ng-model="byGraduationYearFilter" data-placeholder="Choose Graudation Year">
											<option value="">All</option>
											<option ng-repeat="graduation in graduations" value="{{graduation.value}}">{{graduation.value}}</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<h4>degree</h4>
									</td>
									<td>
										<select multiple name="degree" id="degree" class="form-control filter-item" ng-model="byDegreeFilter" data-placeholder="Choose Degree">
											<option value="">All</option>
											<option ng-repeat="degree in degrees" value="{{degree.value}}">{{degree.value}}</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<h4>gpa</h4>
									</td>
									<td>
										<select name="state" id="filterOption-Gpa" class="form-control">
											<option value="All">All</option>
										</select>
									</td>
								</tr>
							</table>
						</form><!-- /input-group2 -->
					</div>
				</div>
			</div>
		</div> <!-- /container -->
        
        <!-- Bootstrap core JavaScript
    ================================================== --> 
    <script src="./js/jquery-1.11.2.min.js"></script> 
    <script src="./js/bootstrap.min.js"></script>
	<script src="./js/angular.min.js"></script>
	<script src="./js/angular-route.min.js"></script>
    <script src="./js/chosen.jquery.min.js"></script>
	<script src="./js/typeahead.js"></script>
	<script src="./js/script-searchPage.js"></script>
    <script src="./js/company-search.js"></script>
    <script type="text/javascript"></script>

	</body>
</html>