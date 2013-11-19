<?php
session_start();
//error_reporting(0);
include('lib/connect.php');
include('inc.functions.generic.php');
require_once 'inc.function.temp.php';

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
$org_code=$_SESSION['org_code'];
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
<!--
<link href="./css/bootstrap-overrides.css" rel="stylesheet">
-->
<link href="./css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet">

<link href="./css/slate.css" rel="stylesheet">



<!-- Javascript -->
<script src="./js/jquery-1.7.2.min.js"></script>
<script src="./js/jquery-ui-1.8.21.custom.min.js"></script>
<script src="./js/jquery.ui.touch-punch.min.js"></script>
<script src="./js/bootstrap.js"></script>

<script src="./js/Slate.js"></script>
<script src="./js/jscal2.js"></script>
<script src="./js/lang/en.js"></script>
<link rel="stylesheet" type="text/css" href="./css/jscal2.css"/>
<link rel="stylesheet" type="text/css" href="./css/border-radius.css"/>
<link rel="stylesheet" type="text/css" href="./css/steel/steel.css"/>

<script src="./js/plugins/flot/jquery.flot.js"></script>
<script src="./js/plugins/flot/jquery.flot.orderBars.js"></script>
<script src="./js/plugins/flot/jquery.flot.pie.js"></script>
<script src="./js/plugins/flot/jquery.flot.resize.js"></script>

<script src="./js/demos/charts/bar.js"></script>


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
					<a href="./">
						<i class="icon-home"></i>
						<span></span>
					</a>	    				
				</li>
				<? if($org_type=='1002'||$org_type=='1028'||$org_type=='1005'||$org_type=='1022'||$org_type=='1023'){?>
                                <li class="dropdown">
					<a href="reporting_tartiary.php">
						<i class="icon-home"></i>
						<span>HSS Report Panel</span>
					</a>	    				
				</li><?}else{?>
                                <li class="dropdown">
					<a href="reporting.php">
						<i class="icon-home"></i>
						<span>HSS Report Panel</span>
					</a>	    				
				</li><?}?>
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
			    <a href="index.php"><b>Home</b></a> <span class="divider"></span>
			  </li>
			
			  <li class="active">Monitoring implementation of improvement plan of HSS <span style="color:blue;"></a><span class="divider"></span></li>

			</ul>
			
			<script>
                           var v = $('#answer_storage_month_year option:selected').val();
                           var t =$('#answer_storage_month_year_2').val(v);
			</script>
			
		</div> <!-- /.page-title -->
		
		<form name="orgfrom" method="post" enctype="multipart/form-data" >
		<input type="hidden" name="answer_storage_org_id" value="<?php echo $org_code;?>">
		<input type="hidden" name="answer_storage_modified" value="<?php echo $date2=date('Y-m-d h:m:i');?>">
		<input type="hidden" name="answer_storage_updated_by" value="<?php echo $user_email;?>">
		
		
			<div class="row">
			<div class="span6">
			<input type='hidden' name='answer_storage_form' value='1'>
			
			Report for the Month of
			<select name="answer_storage_month_year" id="answer_storage_month_year" onchange="toggle()">
				<option value="">==Select Month==</option>
                                <option value="11-2013">November,2013</option>
				<option value="10-2013">October,2013</option>
				<option value="09-2013">September,2013</option>
				
				
			</select>
			
			</div>
		    </div>
                <?php
                                     
			  if (checkIfOrgIsTartiary($org_code)) {
                                                
                            ?>
			<script>
				function toggle() {
				var v = $('#answer_storage_month_year option:selected').val();
				var v = v.toString();
				$(function () 
			    {
				//-----------------------------------------------------------------------
				// 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
				//-----------------------------------------------------------------------
				$.ajax({  
				  url: 'api_tartiary.php',     //the script to call to get data          
				  data: "org_id=<?php echo $org_code; ?>&month="+v, //you can insert url argumnets here to pass to api.php
										   //for example "id=5&parent=6"
				  dataType: 'json',                //data format      
				  type: "POST",
				  success: function(data)          //on recieve of reply
				  { 
				    
				   	var v = $('#answer_storage_month_year option:selected').val();
					
					var vname = data;    //get name
					var t = v;           //get name
					
					
					if(vname > 0)
					{
					  	$('#output').html("<b><a href='report.php?month="+t+"' target='_blank'>Please click here to see your report.</a></b>"); //Set output element html
						$('.widget-accordion').hide();
					}
					else{
						$('#output').html("<b>You have not insert any data for this month. </b>"); //Set output element html
						$('.widget-accordion').show();
					}
				  } 
				});
  }); 
			  
			     }

			</script>
                        <?}  else {
                             ?>
                            
                             <script>
				function toggle() {
				var v = $('#answer_storage_month_year option:selected').val();
				var v = v.toString();
				$(function () 
			    {
				//-----------------------------------------------------------------------
				// 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
				//-----------------------------------------------------------------------
				$.ajax({  
				  url: 'api.php',     //the script to call to get data          
				  data: "org_id=<?php echo $org_code; ?>&month="+v, //you can insert url argumnets here to pass to api.php
										   //for example "id=5&parent=6"
				  dataType: 'json',                //data format      
				  type: "POST",
				  success: function(data)          //on recieve of reply
				  { 
				    
				   	var v = $('#answer_storage_month_year option:selected').val();
					
					var vname = data;    //get name
					var t = v;           //get name
					
					
					if(vname > 0)
					{
					  	$('#output').html("<b><a href='report_upo.php?month="+t+"' target='_blank'>Please click here to see your report.</a></b>"); //Set output element html
						$('.widget-accordion').hide();
					}
					else{
						$('#output').html("<b>You have not insert any data for this month. </b>"); //Set output element html
						$('.widget-accordion').show();
					}
				  } 
				});
  }); 
			  
			     }
			 
			</script>   
                          <?}?>
                        
                       			
			<div id="output"></div>
		
		<div class="row">
			
			<div class="span6">

					
				</div> <!-- /.widget -->
				
			</div> <!-- /.span6 -->
			
			</form>
			
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
