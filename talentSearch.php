<?PHP
session_start();
if (!(isset($_COOKIE['username']))) {
  header ("Location: login.php");
}
//print_r($_COOKIE); 
?>
<!DOCTYPE html>
<html lang="en" ng-app="search">
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
                text+=("<p>Company Name: "+obj.name+"</p>");
                text+=("<p>Industry: "+obj.industry+"</p>");
                text+=("<p>Size: "+obj.size+"</p>");
                text+=("<p>Type: "+obj.type+"</p>");
                text+=("<p>Founded: "+obj.founded+"</p>");
                text+=("<p>State: "+obj.state+"</p>");
                text+=("<p>Perks: "+obj.perks+"</p>");
                text+=("<p>City: "+obj.city+"</p>");
                text+=("<p>EVP: "+obj.EVP+"</p>");
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
					  <li><a href="talent.php">Talent</a></li>
					  <li><a href="#">Employers</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
					  <li class="active"><a href="universityNotification.php">Notifications <span class="custom_bubble">9</span> <span class="sr-only">(current)</span></a></li>
					  <li><a href="talentUpdate.php">Update</a></li>
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
								<td class="com-right">
									<p>Company Name: {{company.name}}</p>
									<p>Industry: {{company.industry}}</p>
									<p>Size: {{company.size}}</p>
									<p>Type: {{company.type}}</p>
									<p>Founded: {{company.founded}}</p>
									<p>State: {{company.state}}</p>
									<p>Perks: {{company.perks}}</p>
									<p>City: {{company.city}}</p>
									<p>EVP: {{company.evp}}</p>
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
										<h4>Industry</h4>
									</td>
									<td>
										<select multiple id="filterOption-industry" class="form-control filter-item" ng-model="byIndustryFilter" data-placeholder="Choose Industry">
											<option value="">All</option>
											<option ng-repeat="industry in industries" value="{{industry.value}}">{{industry.value}}</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<h4>Size</h4>
									</td>
									<td>
										<select multiple id="size" class="form-control filter-item" ng-model="bySizeFilter" data-placeholder="Choose Size">
											<option value="">All</option>
											<option ng-repeat="size in sizes" value="{{size.value}}">{{size.display}}</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<h4>Type</h4>
									</td>
									<td>
										<select multiple id="type" class="form-control filter-item" ng-model="byTypeFilter" data-placeholder="Choose Type">
											<option value="">All</option>
											<option ng-repeat="type in types" value="{{type.value}}">{{type.value}}</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<h4>Founded</h4>
									</td>
									<td>
										<select multiple name="founded" id="founded" class="form-control filter-item" ng-model="byYearFilter" data-placeholder="Choose Year">
											<option value="">All</option>
											<option ng-repeat="year in years" value="{{year.value}}">{{year.value}}</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<h4>Perks</h4>
									</td>
									<td>
										<select name="state" id="filterOption-Perks" class="form-control">
											<option value="All">All</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<h4>State</h4>
									</td>
									<td>
										<select id="filterOption-state" multiple class="form-control" ng-model="byStateFilter" data-placeholder="Choose States">
											<option value="">All</option>
											<option ng-repeat="state in states" value="{{state.value}}">{{state.value}}</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<h4>City</h4>
									</td>
									<td>
										<select name="state" id="filterOption-city" class="form-control">
											<option value="All">All</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<h4>EVP</h4>
									</td>
									<td>
										<select name="state" id="filterOption-EVP" class="form-control">
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
    <script src="./js/bootstrap.min.js"></script>
	<script src="./js/angular.min.js"></script>
	<script src="./js/angular-route.min.js"></script>
    <script src="./js/chosen.jquery.min.js"></script>
	<script src="./js/typeahead.js"></script>
	<script src="./js/script-searchPage.js"></script>
    <script src="./js/angular-search.js"></script>

	</body>
</html>