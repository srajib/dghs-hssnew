<?php
session_start();
include('lib/connect.php');
if(empty($_SESSION['loginid']))
{
	print "<script>";
	print " self.location='index.php'"; // Comment this line if you don't want to redirect
	print "</script>";
}


if($_SESSION['loginid'] >= 3)
{
	print "<script>";
	print " self.location='org.php'"; // Comment this line if you don't want to redirect
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


<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script>
$("#sample-accordion").accordion({ active: 2 });
</script>

</head>

<body>
 	<div id="header">
	
	<div class="container">			
		
		<div style="height:100px; width:auto;"><img src="img/logo.png" style="height:80px; width:95px; border:none"><font style="font-family:'Arial Black', Gadget, sans-serif; font-size:25px;position:relative; bottom:15px; color:#CCC">Health System Strengthening</font><br>
<font style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:13px; left:95px; position:relative; bottom:40px; float:left; color:#CCC">Government of People's Republic of Bangladesh</font><br>
<font style="font-family:Arial, Helvetica, sans-serif; font-size:15px; left:95px; position:relative; bottom:42px;  color:#CCC"><b>Directorate General of Health Services</b></font></div>			
			
		
		<div id="info">				
			
			<a href="javascript:;" id="info-trigger">
				<i class="icon-cog"></i>
			</a>
			
			<div id="info-menu">
				
				<div class="info-details">
				
					<h4>Welcome, <font color="orange"><?php echo $_SESSION['email']; ?></font>.</h4>
					
					<p>
						Logged in as <?php echo $_SESSION['email']; ?>
						<br>
						 <a href="logout.php">Logout</a>
					</p>
					
				</div> <!-- /.info-details -->
				
				<div class="info-avatar">
					
					<img src="./img/avatar.jpg" alt="avatar">
					
				</div> <!-- /.info-avatar -->
				
			</div> <!-- /#info-menu -->
			
		</div> <!-- /#info -->
		
	</div> <!-- /.container -->

</div> <!-- /#header -->


<div id="nav">
		
	<div class="container">
		
		<a href="javascript:;" class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        	<i class="icon-reorder"></i>
      	</a>
		
		<div class="nav-collapse">
			
			<ul class="nav">
		
				<li class="nav-icon">
					<a href="./">
						<i class="icon-home"></i>
						<span>Home</span>
					</a>	    				
				</li>
				
				<li class="dropdown active" style="margin-left:-20px;">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-th"></i>
						Home
						<b class="caret"></b>
					</a>	
				<!--
					<ul class="dropdown-menu">
						<li><a href="./forms.html">Forms</a></li>
						<li><a href="./ui-elements.html">UI Elements</a></li>
						<li><a href="./grid.html">Grid Layout</a></li>
						<li><a href="./tables.html">Tables</a></li>
						<li><a href="./widgets.html">Widget Boxes</a></li>
						<li><a href="./charts.html">Charts</a></li>
						<li><a href="./tabs.html">Tabs & Accordion</a></li>
						<li><a href="./buttons.html">Buttons</a></li>
					</ul>   --> 				
				</li>

				<li class="dropdown">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-external-link"></i>
						Data Entry Form
						<b class="caret"></b>
					</a>	
				<!--
					<ul class="dropdown-menu">							
						<li><a href="./login.html">Login</a></li>
						<li><a href="./signup.html">Signup</a></li>
						<li><a href="./error.html">Error</a></li>
						<li class="dropdown">
							<a href="javascript:;">
								Dropdown Menu									
								<i class="icon-chevron-right sub-menu-caret"></i>
							</a>
							
							<ul class="dropdown-menu sub-menu">
		                        <li><a href="javascript:;">Dropdown #1</a></li>
		                        <li><a href="javascript:;">Dropdown #2</a></li>
		                        <li><a href="javascript:;">Dropdown #3</a></li>
		                        <li><a href="javascript:;">Dropdown #4</a></li>
		                    </ul>
						</li>
					</ul>    -->				
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
			    <a href="./">Home</a> <span class="divider">/</span>
			  </li>
			
			  <li class="active">Monitoring implementation of improvement plan of HSS <span style="color:blue;"></a></li>
			</ul>
			
		</div> <!-- /.page-title -->
		
		
		
			
		
		<div class="row">
			
			<div class="span6">
			
			    
				
				<div class="widget widget-accordion">
					
					
					<div class="widget-header">
						
						<h3>
							Monitoring implementation of improvement plan of HSS
						</h3>					
					</div> <!-- /.widget-header -->
				   
				 <h3>  <a href="add_question_type.php"> Add Question Types </a></h3>
				<form name="frm" action="add_question_type.php" method="post">
				
				Question type : <input type="text" name="type_name" >
				
				<input type="submit" name="submit" value="submit">
				</form>
				
				
				<?php	
				
				 
				         $question_type=mysql_query("SELECT * FROM hss_question_type");
						 
						   while($question_types = mysql_fetch_array($question_type))
						   {
							
           					echo $question_types['type_id'].'. ';	  
							echo $question_types['type_name'].'<br>';							
       						}
				  $date=date('d-m-Y');
                   if($submit)	{			
					$sql=mysql_query("INSERT INTO hss_question_type(type_id,type_name,type_active,type_created,type_modified,type_updated_by_user)
					VALUES('','$_POST[type_name]','1','$date','$date','1')");

					echo "1 record added";
					}

					//mysql_close($con);
					
					?>
				   </div>
				              </div>
				            </div>
				          </div>					
						
					</div> <!-- /.widget-content -->
					
				</div> <!-- /.widget -->
				
			</div> <!-- /.span6 -->
			
			
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
