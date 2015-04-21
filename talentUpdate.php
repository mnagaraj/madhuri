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
       <link href="./css/style-updatePage.css" rel="stylesheet">
       <link href="./css/bootstrap.min.css" rel="stylesheet">
       <title>TalentPoolMe - Update</title>
       <script src="./js/jquery-1.11.2.min.js"></script> 
     <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
       <script text="text/javascript">
	      $(document).ready(function(){
              $.ajax({ url: "http://default-environment-nqhpgmhyii.elasticbeanstalk.com/search.php",
                      data: {
                          profile: 'student',
                          username: "<?php $variable=$_SESSION['username']; echo $variable; ?>"
                      },
                      dataType:'json', 
                      type: 'POST',
                      success: function(data){
                          $("#university").val(data.university); 
                          $("#grad_year").val(data.graduationyear);
                          $("#major").val(data.major);
                          $("#GPA").val(data.gpa);
        }});
});
	</script>
       
<script text="text/javascript">
	      $(document).ready(function() {
		  $("#profile-form").validate({
			rules: {
                university: {
					required: true,
				},
            graduationyear: {
					required: true,
				},
            major: {
					required: true,
				},
            gpa: {
					required: true,
				} 
            },
            
           submitHandler: function(form) {
               $.ajax({
        url: 'http://default-environment-nqhpgmhyii.elasticbeanstalk.com/update.php',
        data: {
            profile: 'student',
            username: 'testing8',
            university: $('#university').val(),
            graduationyear: $('#grad_year').val(),
            major: $('#major').val(),
            gpa: $('#GPA').val(),
            degree: 'Masters'
        },
        dataType:'text',         
        error: function() {
                alert('There was an error while submitting your request');
        },
        success: function(data) {            
                alert('Information updated');
        },
        type: 'POST'
    });
        }, 
            
		});
        
});
	</script>
       
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
							<li><a href="talent.php">Talent</a></li>
							<li><a href="employer.php">Employers</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="universityNotification.php">Notifications<span class="custom_bubble">9</span></a></li>
							<li class="active"><a href="talentUpdate.php">Update<span class="sr-only">(current)</span></a></li>
						</ul>
					</div>
				</div>
			</nav>

			<h2 id="notif">Update</h2>
            <div id="tab1" class="tabbable">
				<div class="col-sm-2 col-md-1 col-lg-2">
					<ul class="nav nav-pills nav-stacked">
						<li class="active"><a href="#profile-panel-content" data-toggle="tab">Profile</a></li>
						<li><a href="#password-panel-content" data-toggle="tab">Password</a></li>
					</ul>
				</div>
				<div class="tab-content" class="col-sm-10 col-md-11 col-lg-10">
					<div id="profile-panel-content" class="tab-pane fade active in">
						<div class="row">
							<div id="profile-form-container" class="col-lg-6 col-md-6 col-lg-offset-1 col-md-offset-1">
								<form id="profile-form" name="profile-form">
									<div class="form-group">
										<label for="">University</label>
										<input id="university" name="university" type="text" class="form-control" placeholder="University" />
									</div>
									<div class="form-group">
										<label for="">Graduate Year</label>
										<input id="grad_year" name="grad_year" type="text" class="form-control" placeholder="Graduate Year" />
									</div>
									<div class="form-group">
										<label for="">Major</label>
										<input id="major" name="major" type="text" class="form-control" id="Mj" placeholder="Major" />
									</div>
									<div class="form-group">
										<label for="">GPA</label>
										<input type="text" class="form-control" id="GPA" name="GPA" placeholder="GPA" />
									</div>
									<div class="form-group">
										<label for="">Work Experience</label>
										<input type="text" class="form-control" id="We" placeholder="Work Experience" />
									</div>
									<div class="form-group">
										<label for="">Skills</label>
										<input type="text" class="form-control" id="Sk" placeholder="Skills" />
									</div>
									<button type="submit" class="btn btn-default">Save</button>
								</form>
							</div>
						</div>
					</div>
					<div id="password-panel-content" class="tab-pane fade in">
						<div class="row">
							<div id="password-form-container" class="col-lg-6 col-md-6 col-lg-offset-1 col-md-offset-1">
								<form id="password-form">
									<div class="form-group">
										<label for="passwordInput">Old Password</label>
										<input type="password" class="form-control" id="passwordInput" placeholder="Enter Password" />
									</div>
									<div class="form-group">
										<label for="passwordInput">New Password</label>
										<input type="password" class="form-control" id="passwordInput" placeholder="Enter Password" />
									</div>
									<div class="form-group">
										<label for="passwordInput">Confirm New Password</label>
										<input type="password" class="form-control" id="passwordInput" placeholder="Enter Password" />
									</div>
									<button type="submit" class="btn btn-default">Update Password</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- container -->


	<!-- Bootstrap core JavaScript -->
    
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/talent_update.js"></script>
	</body>
</html>