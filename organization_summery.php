<?php
//error_reporting(0);
include('lib/connect.php');
include('inc.functions.generic.php');
require_once 'inc.function.temp.php';

$district_bbs_code = $_REQUEST['district_bbs_code'];
$upazila_thana_code = $_REQUEST['upazila_thana_code'];

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
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="./css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet">

<link href="./css/slate.css" rel="stylesheet">
<!--<link href="./css/slate-responsive.css" rel="stylesheet">-->
<link rel="stylesheet" href="treeview/jquery.treeview.css" />
<link rel="stylesheet" href="treeview/screen.css" />
	
<script src="treeview/lib/jquery.js" type="text/javascript"></script>
<script src="treeview/lib/jquery.cookie.js" type="text/javascript"></script>
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
					<a href="reporting.php">
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
							<a href="upozila_organization_summary.php">
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
			
			  <?php require_once 'tbl.upazila_org_summary_report.php';  ?>  
			
			<div class="spane6"> <h3> Organization Summary Report </h3>
    
              <table border="1">
             <tr><th width="200"> Organization</th><th><table border="0"><tr><td width="50"> Sept</td><td width="50"> Oct  </td><td width="50"> Nov </td></tr></table></th></tr>
                
    <?php
    
    
    
        
        foreach ($dataArray as $org => $orgData) {
            echo "<tr>";
            echo "<td  width='200'>$org</td>";
            echo "<td>";
            echo "<table border='0'>";
            echo "<tr>";
            foreach ($orgData as $year => $yearData) {   
                if($yearData['countTotal']>0){
                    $percentage=round(($yearData['countAnswered']*100)/$yearData['countTotal'],1);
                    $month_year = $yearData[month_year];
                    echo "<td width='50' align='center'><a href='org_report.php?org_code=$organization_code&&month=$month_year'>$percentage%</a></td>"; 
                }else{
                    $percentage=0;
                }
            }
            echo "</tr>";
            echo "</table>";
            echo "</td>";
            echo "</tr>";
        }
    
    ?>
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
