<?php
session_start();
//error_reporting(0);
include('lib/connect.php');
include('inc.functions.generic.php');
if(empty($_SESSION['loginid']))
{
	print "<script>";
	print " self.location='index.php'"; // Comment this line if you don't want to redirect
	print "</script>";
}

if($_SESSION['loginid'] <= 2)
{
	print "<script>";
	print " self.location='admin.php'"; // Comment this line if you don't want to redirect
	print "</script>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Health System Strengthening</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">

<!-- Styles -->
<link href="./css/bootstrap.css" rel="stylesheet">
<link href="./css/bootstrap-responsive.css" rel="stylesheet">
<link href="./css/bootstrap-overrides.css" rel="stylesheet">

<link href="./css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet">

<link href="./css/slate.css" rel="stylesheet">
<link href="./css/slate-responsive.css" rel="stylesheet">


<!-- Javascript -->
<script src="./js/jquery-1.7.2.min.js"></script>
<script src="./js/jquery-ui-1.8.21.custom.min.js"></script>
<script src="./js/jquery.ui.touch-punch.min.js"></script>
<script src="./js/bootstrap.js"></script>

<script src="./js/Slate.js"></script>

<script src="./js/plugins/flot/jquery.flot.js"></script>
<script src="./js/plugins/flot/jquery.flot.orderBars.js"></script>
<script src="./js/plugins/flot/jquery.flot.pie.js"></script>
<script src="./js/plugins/flot/jquery.flot.resize.js"></script>

<script src="./js/demos/charts/bar.js"></script>

<script type="text/javascript">
function validate(){ 
var filevalue=document.getElementById("file").value; 
if(filevalue=="" || filevalue.length<1){
alert("Select File.");
document.getElementById("file").focus();
return false;
} 
return true; 
}
</script> 
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>
 	<?php include('header.php'); ?>
<div id="nav">
		
	<div class="container">
		
		<a href="javascript:;" class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        	<i class="icon-reorder"></i>
      	</a>
		
		<div class="nav-collapse">
			
			<ul class="nav">
		
				<li class="nav-icon">
					<a href="index.php">
						<i class="icon-home"></i>
						<span>Home</span>
					</a>	    				
				</li>
				<!--
				<li class="dropdown active" style="margin-left:-20px;">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-th"></i>
						Home
						<b class="caret"></b>
					</a>	
					
				</li>
-->
			
				<li class="dropdown">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-external-link"></i>
						Report
						<b class="caret"></b>
					</a>	
			
					<ul class="dropdown-menu">							
						<li><a href="basic_report.php">Basic Report</a></li>
						<li class="dropdown">
							<a href="javascript:;">
								Report									
								<i class="icon-chevron-right sub-menu-caret"></i>
							</a>
						</li>
					</ul>   			
				</li>
				
			
			</ul>
			
			
			<ul class="nav pull-right">
		
				<li class="">
					<form class="navbar-search pull-left">
						<input type="text" class="search-query" placeholder="Search">
						<button class="search-btn"><i class="icon-search"></i></button>
					</form>	    				
				</li>
				
			</ul>
			
		</div> <!-- /.nav-collapse -->
		
	</div> <!-- /.container -->
	
</div> <!-- /#nav -->


<div id="content">
		
	<div class="container">
		
		<div id="page-title" class="clearfix">
			
			<ul class="breadcrumb">
			  <li>
			    <a href="org.php">Home</a> <span class="divider">/</span>
			  </li>
			
			  <li class="active">Health System Strengthening Evaluation Form</li>
			</ul>
			
		</div> <!-- /.page-title -->
		
		
		
		<div class="row">
		
<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form action="multiple_upload_ac.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td><strong>multiple Files Upload </strong></td>
</tr>
<tr>
<td>Select file
<input name="ufile[]" type="file" id="ufile[]" size="50" /></td>
</tr>
<tr>
<td>Select file
<input name="ufile[]" type="file" id="ufile[]" size="50" /></td>
</tr>
<tr>
<td>Select file
<input name="ufile[]" type="file" id="ufile[]" size="50" /></td>
</tr>

<input type="hidden" name="question_id" value="<?php echo $_REQUEST['question_id'];?>">
<input type="hidden" name="org_code" value="<?php echo $_SESSION['org_code'];?>">
<input type="hidden" name="month" value="<?php echo $_GET['month'];?>">
<tr>
<td align="center"><input type="submit" name="submit" value="submit" /></td>
</tr>
</table>
</td>
</form>
</tr>
</table> 
			
			<div class="span6">
				
	
		
				
				
			</div> <!-- /.span6 -->
			
		</div> <!-- /.row -->
		
		
		
	</div> <!-- /.container -->
	
</div> <!-- /#content -->



<div id="footer">	
		
	<div class="container">
		
		&copy; 2013 MIS, DGHS, All rights reserved.
		
	</div> <!-- /.container -->		
	
</div> <!-- /#footer -->





  </body>
</html>
