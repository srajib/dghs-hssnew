<?php
session_start();
//error_reporting(0);
include('lib/connect.php');
include('inc.functions.generic.php');

/*
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
*/
 $bd=$_GET['bd'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Health System Strengthening</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">

<!-- Styles -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet">

<link href="css/slate.css" rel="stylesheet">
<link href="css/slate-responsive.css" rel="stylesheet">

<!-- Javascript -->
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery-ui-1.8.21.custom.min.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<script src="js/bootstrap.js"></script>


<link rel="stylesheet" type="text/css" href="css/jscal2.css"/>
<link rel="stylesheet" type="text/css" href="css/border-radius.css"/>
<link rel="stylesheet" type="text/css" href="css/steel/steel.css"/>


<script src="js/demos/charts/bar.js"></script>
	
<script src="treeview/lib/jquery.js" type="text/javascript"></script>
<script src="treeview/lib/jquery.cookie.js" type="text/javascript"></script>

<link rel="stylesheet" href="treeview/jquery.treeview.css" />
<link rel="stylesheet" href="treeview/screen.css" />
<script src="treeview/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript" src="treeview/demo.js"></script>


<!-- Javascript -->


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
 <?php include('header.php'); 
 

 	
?>
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
                                
                                <li class="dropdown">
					<a href="reporting_tartiary.php">
						<i class="icon-home"></i>
						<span>HSS Report Panel</span>
					</a>	    				
				</li>
				
			
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
                                                 <li class="dropdown">
							<a href="tartiry_organization_summry.php">
								Organization Answer Report									
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
			
			
			<div class="span3">
		
				
			</div> <!-- /.span3 -->
			<div class="spane6"> <h3> Divisional Summary Report of Bangladesh</h3>
                           <p>
                          <table class='table'>
			
              <?php require_once('tbl.tartiary_summary_report.php') ;?>  
               <table border="1px">
                <tr><th width="200" align='left'> Division</th><th><table border="0"><tr><th width='200'>Organization</th><th width="50" align='right'> Sept</th><th width="50" align='right'> Oct  </th><th width="50" align='right'> Nov </th><th width="50" align='right'> Dec</th><th width="50" align='right'> Jan</th><th width="50" align='right'> Feb</th></tr></table></td></tr>
                             
   
<?php


foreach ($dataArray as $division => $districtData) {

        echo "<tr>";
        echo "<td>$division</td>";
        echo "<td>";
        echo "<table border='0'>";
        foreach ($districtData as $org => $orgData) {
         
            echo "<tr>";
            echo "<td  width='200'>$org</td>";
            echo "<td>";
            echo "<table border='0'>";
            echo "<tr>";
            foreach ($orgData as $year => $yearData) {     
                if($yearData['countTotal']>0){
                    $percentage=round(($yearData['countAnswered']*100)/$yearData['countTotal'],1);
                    //echo "<td width='50'>$percentage%</td>"; 
                      $org_code=$yearData['org_code'];
                      $month_year=$yearData['month_year'];
                      echo "<td width='50' align='center'><a href='org_report_tartiary.php?org_code=$org_code&&month=$month_year'>$percentage%</a></td>"; 
                }else{
                    $percentage=0;
                }
            }
            echo "</tr>";
            echo "</table>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</td>";
       // myprint_r($val);
        echo "</tr>";
    }

?>
  </table>  
			</table>
 <table class="table" width="950px">
<!--<tr>
<td><strong>Total Summary </strong></td>
<td><strong><? echo " $sum_sept" ;?></strong></td><td><strong><? echo " $sum_oct" ;?></strong></td><td>0</td><td>0</td>
</tr>-->
</table>
			
			</div><!-- /.span6 -->
			
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
