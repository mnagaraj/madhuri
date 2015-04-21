<?PHP
session_start();
if (!(isset($_COOKIE['username']))) {
  header ("Location: login.php");
}
//print_r($_COOKIE); 
?>
<html lang="en">
   <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link href="./css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/style-university.css" rel="stylesheet">
		<link href="./css/style.css" rel="stylesheet">
		<title>TalentPoolMe - University</title>
    </head>
	
    <body>    
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
					  <li><a href="employer.html">Employers</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="./universityNotification.html">Notifications</a></li>
						<li class="active"><a href="./update.html">Update<span class="sr-only">(current)</span><span class="custom_bubble">9</span></a></li>
					</ul>
				  </div>
				</div>
			</nav>
		
			<h2 id="notif">Notifications</h2>
            <div id="tab1" class="tabbable">
                <ul class="nav nav-pills">
                    <li class="active"><a href="#users-panel-content" data-toggle="tab">Users</a></li>
                    <li><a href="#insights-panel-content" data-toggle="tab">Insights</a></li>
                    <li><a href="#intern-panel-content" data-toggle="tab">Internships</a></li>
                    <li><a href="#jobs-panel-content" data-toggle="tab">Jobs</a></li>
                    <li><a href="#skills-panel-content" data-toggle="tab">Skills</a></li>
                </ul>
                <div class="tab-content">
                    <div id="users-panel-content" class="tab-pane active">
						<div class="row">
							<div class="col-sm-2 col-md-1 col-lg-2">
								<ul class="nav nav-pills nav-stacked">
									<li class="active left-menu"><a href="#users-panel" data-toggle="tab">Users</a></li>
									<li class="left-menu"><a href="#aver-panel" data-toggle="tab">Average</a></li>
									<li class="left-menu"><a href="#degree-panel" data-toggle="tab">Degree</a></li>
									<li class="left-menu"><a href="#grad-panel" data-toggle="tab">Grad year</a></li>
									<li class="left-menu"><a href="#interv-panel" data-toggle="tab">Interviews</a></li>
									<li class="left-menu"><a href="#intern-panel" data-toggle="tab">Internships</a></li>
									<li class="left-menu"><a href="#jobs-panel" data-toggle="tab">Jobs</a></li>
									<li class="left-menu"><a href="#stat-panel" data-toggle="tab">Statistics</a></li>
								</ul>
							</div>
							<div class="col-sm-10 col-md-11 col-lg-10">
								<div id="users-tab-content" class="tab-content">
									<div id="users-panel" class="tab-pane fade active in">
										<table id="user-list">
											<tr>
												<td>
													<div id="img-user-container">
														<img src="./img/user_male-128.png" alt="user-image" class="img-responsive img-thumbnail"/>
													</div>
												</td>
												<td>
													<h4>User-Name</h4>
												</td>
											</tr>
											<tr>
												<td>
													<div id="img-user-container">
														<img src="./img/user_female-128.png" alt="user-image" class="img-responsive img-thumbnail"/>
													</div>
												</td>
												<td>
													<h4>User-Name</h4>
												</td>
											</tr>
											<tr>
												<td>
													<div id="img-user-container">
														<img src="./img/user_male-128.png" alt="user-image" class="img-responsive img-thumbnail"/>
													</div>
												</td>
												<td>
													<h4>User-Name</h4>
												</td>
											</tr>
											<tr>
												<td>
													<div id="img-user-container">
														<img src="./img/user_female-128.png" alt="user-image" class="img-responsive img-thumbnail"/>
													</div>
												</td>
												<td>
													<h4>User-Name</h4>
												</td>
											</tr>
										</table>
									</div>
									<div id="aver-panel" class="tab-pane fade">
										<p>This will demonstrate average information</p>
									</div>
									<div id="degree-panel" class="tab-pane fade">
										<p>This will demonstrate degree information</p>
									</div>
									<div id="grad-panel" class="tab-pane fade">
										<p>This will demonstrate grad year information</p>
									</div>
									<div id="interv-panel" class="tab-pane fade">
										<table id="interv-table">
											<tr>
												<td class="item">
													<p>Number of Interview Requests</p>
												</td>
												<td class="stat">
													<p>273</p>
												</td>
											</tr>
											<tr>
												<td class="item">
													<p>Accepted</p>
												</td>
												<td class="stat">
													<p>253</p>
												</td>
											</tr>
											<tr>
												<td class="item">
													<p>Denied</p>
												</td>
												<td class="stat">
													<p>20</p>
												</td>
											</tr>
											<tr>
												<td class="item">
													<p>Top Employer</p>
												</td>
												<td class="stat">
													<p>ExxonMobil</p>
												</td>
											</tr>
										</table>
									</div>
									<div id="intern-panel" class="tab-pane fade">
										<p>This will demonstrate internship information</p>
									</div>
									<div id="jobs-panel" class="tab-pane fade">
										<p>This will demonstrate jobs information</p>
									</div>
									<div id="stat-panel" class="tab-pane fade">
										<p>This will demonstrate static information</p>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div id="insights-panel-content" class="tab-pane">
						<table id="insights-table">
							<tr>
								<td class="item">
									<p>Average Time Spend</p>
								</td>
								<td class="stat">
									<p>1.5</p>
								</td>
							</tr>
							<tr>
								<td class="item">
									<p>Undergraduate</p>
								</td>
								<td class="stat">
									<p>345345</p>
								</td>
							</tr>
							<tr>
								<td class="item">
									<p>Graduate</p>
								</td>
								<td class="stat">
									<p>3445</p>
								</td>
							</tr>
							<tr>
								<td class="item">
									<p>Graduation Year: 2015</p>
								</td>
								<td class="stat">
									<p>567</p>
								</td>
							</tr>
						</table>
                    </div>
                    <div id="intern-panel-content" class="tab-pane">
						<table id="intern-table">
							<tr>
								<td class="item">
									<p>Internships</p>
								</td>
								<td class="stat">
									<p>546</p>
								</td>
							</tr>
							<tr>
								<td class="item">
									<p>Current</p>
								</td>
								<td class="stat">
									<p>253</p>
								</td>
							</tr>
							<tr>
								<td class="item">
									<p>Old</p>
								</td>
								<td class="stat">
									<p>20</p>
								</td>
							</tr>
							<tr>
								<td class="item">
									<p>Top Employer</p>
								</td>
								<td class="stat">
									<p>ExxonMobil</p>
								</td>
							</tr>
						</table>
                    </div>
                    <div id="jobs-panel-content" class="tab-pane">
						<table id="jobs-table">
							<tr>
								<td class="item">
									<p>Jobs</p>
								</td>
								<td class="stat">
									<p>546</p>
								</td>
							</tr>
							<tr>
								<td class="item">
									<p>Current</p>
								</td>
								<td class="stat">
									<p>253</p>
								</td>
							</tr>
							<tr>
								<td class="item">
									<p>Old</p>
								</td>
								<td class="stat">
									<p>20</p>
								</td>
							</tr>
							<tr>
								<td class="item">
									<p>Top Employer</p>
								</td>
								<td class="stat">
									<p>ExxonMobil</p>
								</td>
							</tr>
						</table>
                    </div>
                    <div id="skills-panel-content" class="tab-pane">
						<table id="skills-table">
							<tr>
								<td class="item">
									<p>Skills</p>
								</td>
								<td class="stat">
									<p>X</p>
								</td>
							</tr>
							<tr>
								<td class="item">
									<p>Most Requested</p>
								</td>
								<td class="stat">
									<p>X</p>
								</td>
							</tr>
							<tr>
								<td class="item">
									<p>Least Common</p>
								</td>
								<td class="stat">
									<p>X</p>
								</td>
							</tr>
							<tr>
								<td class="item">
									<p>Most Common</p>
								</td>
								<td class="stat">
									<p>X</p>
								</td>
							</tr>
						</table>
                    </div>
                </div>
            </div>

		</div> <!-- /container -->
        
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>