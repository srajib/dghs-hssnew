
<?php
session_start();
if(!empty($_SESSION['loginid']))
{
	    if($_SESSION['loginid'] == 2 )
		{
			print "<script>";
			print " self.location='admin.php'"; // Comment this line if you don't want to redirect
			print "</script>";
		}
		else
		{
			print "<script>";
			print " self.location='org.php'"; // Comment this line if you don't want to redirect
			print "</script>";
		}
}
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>DGHS - Health System Strengthening</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">   
    
    <!-- Styles -->
    
     <link href="./css/bootstrap.css" rel="stylesheet">
     <link href="./css/bootstrap-overrides.css" rel="stylesheet">
    
     <link href="./css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet">
        
     <link href="./css/slate.css" rel="stylesheet">
    
     <link href="./css/components/signin.css" rel="stylesheet" type="text/css">   
    
    
    <!-- Javascript -->
    
    <script src="./js/jquery-1.7.2.min.js"></script>
	<script src="./js/jquery-ui-1.8.18.custom.min.js"></script>    
	<script src="./js/jquery.ui.touch-punch.min.js"></script>
	<script src="./js/bootstrap.js"></script>

	<script src="./js/demos/signin.js"></script>

    <style>
    /*Initialize*/
ul {
  text-align: left;
  display: inline;
  margin: 0;
  padding: 15px 4px 17px 0;
  list-style: none;
  -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
  
}
ul li {
  font: bold 12px/18px sans-serif;
  display: inline-block;
  margin-right: -4px;
  position: relative;
  padding: 15px 20px;
  background: #fff;
  cursor: pointer;
  -webkit-transition: all 0.2s;
  -moz-transition: all 0.2s;
  -ms-transition: all 0.2s;
  -o-transition: all 0.2s;
  transition: all 0.2s;
  margin-left:auto;
  margin-right:auto;
  width:250px;
}
ul li:hover {
  background: #ccc;
  color: #fff;
}
ul li ul {
  padding: 0;
  position: absolute;
  top: 48px;
  left: 0;
  width: 150px;
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  display: none;
  opacity: 0;
  visibility: hidden;
  -webkit-transiton: opacity 0.2s;
  -moz-transition: opacity 0.2s;
  -ms-transition: opacity 0.2s;
  -o-transition: opacity 0.2s;
  -transition: opacity 0.2s;
  color:#fff;
}
ul li ul li { 
  background: #ccc; 
  display: block; 
  color: #fff;
  text-shadow: 0 -1px 0 #0ccc;
}
ul li ul li:hover { background: #ccc;color:#fff; }
ul li:hover ul {
  display: block;
  opacity: 1;
  visibility: visible;
  color:#fff;
}
    </style>
    
    
</head>

<body>
<?php
include('lib/connect.php');
extract($_POST);
@$uname = preg_replace('/\s+/', '', $username);
@$pass2 = preg_replace('/\s+/', '', $password);
$pass = md5($pass2);

if(isset($_POST['submit']))
{
	$signin = mysql_query("SELECT * FROM user WHERE username='$uname' AND password='$pass'");
	$row = mysql_fetch_assoc($signin);
	$rowsign = mysql_num_rows($signin);
	if($rowsign > 0)
	{
	@$msg = '<font color="#009900"><b>Login Successful. Redirecting, please wait.</b></font>';
	$_SESSION['loginid'] = $row['user_id'];
	$_SESSION['org'] = $row['organization_id'];
	$_SESSION['org_code'] = $row['org_code'];
        $_SESSION['username'] = $row['username'];
	
		/*$ip = $_SERVER['REMOTE_ADDR'];
		$login = time();*/
		if($_SESSION['loginid'] == 2 || $_SESSION['loginid'] == 1)
		{
			echo "<meta http-equiv='refresh' content='2; url=admin.php'>";
		}else
                {
			echo "<meta http-equiv='refresh' content='2; url=org.php'>";
		}
			
	}
	else
	{
		@$msg = '<font color="#FF0000"><b>Login Failed. Check your ID & Password</b></font>';
	}
}
?>

<div style="height:100px; width:auto; background:url(img/background-gradient-small.jpg) repeat-x;"><img src="img/logo.png" height="90" width="110"><font style="font-family:'Arial Black', Gadget, sans-serif; font-size:25px;position:relative; bottom:15px;">Health System Strengthening </font><br>
<font style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:13px; left:110px; position:relative; bottom:50px">Government of People's Republic of Bangladesh</font><br>
<font style="font-family:Arial, Helvetica, sans-serif; font-size:15px; left:110px; position:relative; bottom:52px"><b>Directorate General of Health Services</b></font></div>

  <ul>
  <li>
    HSS Improvement Report
    <ul>
      <li><a href="cont_tartiary.php">Tertiary Hospitals</a></li> 
      <li> <a href="cont_login.php"> Upazila/District Level Facilities </a></li>
    </ul>
  </li>
</ul>
  
 

<div class="account-container login">
	
	<div class="content clearfix">
		
		<form action="" method="post">
		    
          <h3>For entering data please sign in below</h3>
			<h1>Sign In</h1>		
			
			<div class="login-fields">
				
			  <p>Sign in using your ID & Password:<br>
                HSS Improvement Monitoring:<br>
                <?php echo @$msg; ?></p>
				
				<div class="field">
					<label for="username">Username:</label>
					<input type="text" id="username" name="username" value="" placeholder="Username" class="login username-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<!--<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>-->
				</span>
									
				<button name="submit" class="button btn btn-secondary btn-large">Sign In</button>
		                Please Use HRM username and password. 
                                <div>
                                <a href="http://test.dghs.gov.bd/hrmnew/">Forgot password? </a></div>
			</div> <!-- .actions -->
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->

</body>
</html>
