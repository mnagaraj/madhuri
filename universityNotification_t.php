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
	   <link href="./css/style.css" rel="stylesheet">
	   <link href="./css/style-message.css" rel="stylesheet">
	   <link href="./css/bootstrap.min.css" rel="stylesheet">
       <title>TalentPoolMe - Messages</title>
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
							<li><a href="./universityNotification.html">Notifications<span class="custom_bubble">9</span></a></li>
							<li class="active"><a href="./update.html">Update<span class="sr-only">(current)</span></a></li>
						</ul>
					</div>
				</div>
			</nav>

			<h2 id="notif">Notifications</h2>
            <div id="tab1" class="tabbable">
				<div class="row">
					<div class="col-md-1 col-lg-2">
						<ul class="nav nav-pills nav-stacked">
							<li class="active"><a href="#talent-panel-content" data-toggle="tab">Talent Messages</a></li>
							<li><a href="#company-panel-content" data-toggle="tab">Company Messages</a></li>
						</ul>
					</div>
					<div class="tab-content" class="col-md-11 col-lg-10">
						<div id="talent-panel-content" class="tab-pane fade active in">
							<div class="col-md-10 col-lg-8" id="userList">
								<ul class="nav nav-pills nav-stacked" id="chat-user-list">
									<li class="active" id = "startChat"><a href="#" data-toggle="tab"><img alt="avatar" src="./img/user_logo.jpg" /> sadas</a></li>
									<li><a href="#" data-toggle="tab"><img alt="avatar" src="./img/user_logo.jpg" /> sada</a></li>
									<li><a href="#" data-toggle="tab"><img alt="avatar" src="./img/user_logo.jpg" /> kslhg</a></li>
								</ul>
							</div>
							<div class="col-md-10 col-lg-8" id="chatbox">
								<div id="contents">
									<p id="title"></p>
									<div id="wrapper">
									</div>
								</div>
								<form id="message">
									<div id="messageInput" class="input-group">
										<input type="text" id="messageTextInput" class="form-control" placeholder="Message"/>
										<span class="input-group-btn">
											<button type="submit" id="send-button" class="btn btn-primary">Send</button>
										</span>
									</div>
									<br />
									<button class="btn btn-primary" id="backToList">Back to List</button>
								</form>
							</div>
						</div>
						<div id="company-panel-content" class="tab-pane fade in">
							<div class="col-md-10 col-lg-8" id="companyList">
								<ul class="nav nav-pills nav-stacked" id="chat-user-list-company">
									<li class="active" id = "startChat"><a href="#" data-toggle="tab"><img alt="avatar" src="./img/user_logo.jpg" /> ABB Group</a></li>
									<li><a href="#" data-toggle="tab"><img alt="avatar" src="./img/user_logo.jpg" /> Company1</a></li>
									<li><a href="#" data-toggle="tab"><img alt="avatar" src="./img/user_logo.jpg" /> Company2</a></li>
								</ul>
							</div>
							<div class="col-md-10 col-lg-8" id="chatboxCompany">
								<div id="contents">
									<p id="companyTitle"></p>
									<div id="wrapperCompany">
									</div>
								</div>
								<form id="companyMessage">
									<div id="companyMessageInput" class="input-group">
										<input type="text" id="companyMessageTextInput" class="form-control" placeholder="Message"/>
										<span class="input-group-btn">
											<button type="submit" id="send-button-company" class="btn btn-primary">Send</button>
										</span>
									</div>
									<br />
									<button type="submit" class="btn btn-primary" id="backToListCompany">Back to List</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	<!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/script-message-t.js"></script>
	</body>
</html>