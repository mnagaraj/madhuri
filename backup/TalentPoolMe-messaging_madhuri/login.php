<html lang="en">
   <head>
       <title>TalentPoolMe</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-searchPage.css" rel="stylesheet">
       
       <script "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
       <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
       
       <script type="text/javascript" src="http://platform.linkedin.com/in.js">
    api_key:   758iseoj7tvq16
    authorize: true
    onLoad: onLinkedInLoad
</script>
       
       
       <script type="text/javascript">
    
    // Setup an event listener to make an API call once auth is complete
    function onLinkedInLoad() {
        IN.Event.on(IN, "auth", getProfileData);
        
    }
    // Handle the successful return from the API call
    function onSuccess(data) {
        window.location = "talent.php";
    }
    // Handle an error response from the API call
    function onError(error) {
        //console.log(error);
    }
    // Use the API call wrapper to request the member's basic profile data
    function getProfileData() {
        IN.API.Raw("/people/~").result(onSuccess).error(onError);
    }
</script>
       
    </head>
    
    
<script "text/javascript">
        $(document).ready(function() {
      $("#loginForm").validate({
      rules: {
                loginText: {
          required: true
        },
                passwordText: {
          required: true
        }
            },
            
           submitHandler: function(form) {
               $.ajax({
        url: 'http://default-environment-nqhpgmhyii.elasticbeanstalk.com/login.php',
        data: {
            username: $('#loginText').val(),
            password: $('#passwordText').val(),
            type: 'login',
            profile: 'student'
        },
        dataType:'text',         
        error: function() {
                alert('There was an error while submitting your request');
        },
        success: function(data) {            
            if (data=="Password is valid!"){
              document.cookie = "username=" + document.getElementById("loginText").value +";path=/";  
                <?php
                session_start();
                //echo "here";
                if( isset( $_COOKIE['username'] )) {
                  $_SESSION['username'] = $_COOKIE['username'];
          
                }

            //    print_r(_POST);
                ?>

                window.location = "talent.php";
            }
            else
                alert('Incorrect login/password. Please try again');          
        },
        type: 'POST'
    });
        }, 
            
    });
        
});
  </script>
  
    <body id="loginPage">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=774503252635386&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        
        <script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not. 
    }
  }
  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '774503252635386',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });
  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
  };
  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    FB.api('/me', function(response) {
      window.location = "talent.php";
    });
  }
</script>
        <div class="container">
            <div id="centered">
                <img src="./img/logo.jpg">
            <form name="loginForm" id="loginForm" method="POST" action ="login.php" type="login" class="input-group">
                            <h3 id="loginh3">Sign In</h3>
                            <input type="text" name="loginText" id="loginText" placeholder="Login">
                            <input type="password" name="passwordText" id="passwordText" placeholder="Password">
                            <button id="loginBtn" class="btn btn-default" type="submit">Sign In</button>
                            <div id="logindiv">Not a member? <a href="" data-toggle="modal" data-target="#myModal">Join now!</a></div>
            </form><!-- /input-group1 -->
            </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel">Registration</h2>
      </div>
      <div class="modal-body">
        <form name="signupForm" id="signupForm" class="input-group">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
                        <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1" required>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
            <input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2" required>
          </div>
        </div>
      </div>
            <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <input type="text" name="university" id="university" class="form-control input-lg" placeholder="University" tabindex="3" required>
      </div>
                </div>
            </div>
            <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4" required>
      </div>
                    </div>
            </div>
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6" required>
          </div>
        </div>
      </div>
      
      <hr class="colorgraph">
      <div class="row">
        <div class="col-xs-12 col-md-6"><div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="false" onlogin="checkLoginState();"></div></div>
        <div class="col-xs-12 col-md-6"><script type="in/Login"></script></div>
      </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Sign up</button>
      </div>
    </div>
  </div>
</div>
    </div> <!-- /container -->
        
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="js/bootstrap.min.js"></script>
  <script src="js/typeahead.js"></script>
  <script src="js/script-searchPage.js"></script>
  </body>
</html>