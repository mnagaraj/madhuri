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
		<link href="./css/style.css" rel="stylesheet">
		<link href="./css/style-talent.css" rel="stylesheet" />
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
					  <li><a href="talentSearch.php">Employers</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
					  <li class="active"><a href="universityNotification.php">Notifications <span class="sr-only">(current)</span></a></li>
					  <li><a href="talentUpdate.php">Update</a></li>
					</ul>
				  </div><!--/.nav-collapse -->
				</div><!--/.container-fluid -->
			</nav>
		
            <table id="user-list">
                <tr>
                    <td>
				    <div id="img-user-container">
				       <img src="./img/user_female-128.png" alt="user-image" class="img-responsive img-thumbnail"/>
                    </div>
                    </td>
                    <td>
                      <h4>User Name</h4>
						<a href="#sendMessage" data-toggle="modal">
						<img src="./img/email.png" alt="email-image" class="img-responsive"/>
					    </a>
                    </td>
				</tr>
            </table>
            
            
            <div id="pict" class="row">
              <div class="col-xs-3">
                 <a href="#" class="thumbnail">
                   <img src="img/2.png" class="img-responsive">
                </a>
              </div>
                <div class="col-xs-3">
                 <a href="#" class="thumbnail">
                   <img src="img/3.jpg" class="img-responsive">
                </a>
              </div>
                <div class="col-xs-3">
                 <a href="#" class="thumbnail">
                   <img src="img/4.png" class="img-responsive">
                </a>
              </div>
                <div class="col-xs-3">
                 <a href="#" class="thumbnail">
                   <img src="img/5.jpg" class="img-responsive">
                </a>
              </div>
            </div>
            
            <div id="pict" class="row">
              <div class="col-xs-2">
                 <a href="#">
                   <img src="img/1.png" class="img-responsive">
                </a>
              </div>
                <div class="col-xs-3">
                    <p>
                    Tell a story of why a talented person would
                    want to work at ABB.
                    </p>
                 <p id="ital">
                     "I loved that I could start a project and truly 
                     call it my own. I had a summer-long project 
                     that I truly was able to do all by myself and 
                     having all the directors, team members, and 
                     higher-ups watch me present then 
                     congratulate me on how well I did really 
                     was such a stellar feeling."
                </p>
              </div>
                <div class="col-xs-5">
                    <table class="tabTest">
                        <tr>
                            <td><img src="img/cornell.jpg" class="img-responsive"></td>
                            <td>
                                <h3>Cornell University</h3>
                                <p>
                                Bachelor’s – Business – Banking
                                Student: May 2013
                                4.0 GPA
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="img/abb.jpg" class="img-responsive"></td>
                            <td>
                                <h3>ABB Group</h3>
                                <p>
                                Internship – Consulting
                                Current: May 2013-Present
                                New York City, NY USA
                                </p>
                            </td>
                        </tr>
                    </table>
              </div>
            </div>
			<div id="sendMessage" class="modal fade" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal"></button>
							<h4 class="modal-title">Send Message</h4>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label for="recipient-name" class="control-label">To:</label>
									<input type="text" class="form-control" id="recipient-name">
								</div>
								<div class="form-group">
									<label for="message-text" class="control-label">Message:</label>
									<textarea class="form-control" id="message-text"></textarea>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" data-dismiss="modal" id="sendBtn">Send</button>
						</div>
					</div>
				</div>
			</div>
			
			<div id="message-feedback" class="modal fade" tab="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" id="headers">
							<button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal"></button>
							<h4 class="modal-title">Message</h4>
						</div>
						<div class="modal-body">
							<p>Message send successfully!</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div><!--container-->
        
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
	<script src="./js/script-talent.js"></script>
	</body>
</html>