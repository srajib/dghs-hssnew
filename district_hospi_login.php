<?php
session_start();
//error_reporting(0);
include('lib/connect.php');
include('inc.functions.generic.php');


 //$bd=$_GET['bd'];
 $district_bbs_code=$_GET['district_bbs_code'];

 $dis_sql=mysql_query("Select old_district_id,district_name from admin_district where district_bbs_code='$district_bbs_code'");
 $dis_row= mysql_fetch_array($dis_sql);
 $dis_name=$dis_row['district_name'];
 $dis_id=$dis_row['old_district_id']; 
 
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
 <?php include('header_login.php'); 
 
//$div_sql=mysql_query("Select division_name from admin_division where division_bbs_code='$division_bbs_code'");
// $div_row= mysql_fetch_array($div_sql);
// $div_name=$div_row['division_name'];
 	
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
				
			
			
				
			
			</ul>
			
			
			<ul class="nav pull-right">
		
				
				
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
               <?php require_once 'left_menu.php'; ?>
			</div> <!-- /.span3 -->
            
            
             <?php require_once 'tbl.upazila_districthospi_report.php';  ?>    
			<div class="spane6"> <h3> District Hospital Report of <? echo $dis_name ?></h3>
                           <p>
                         <table class='table'>
			  <tbody>
		 	   
			  </tbody>
               
              <table border="1">
                <tr>
                 <th> Upazila Name </th><td><table><tr><th width="200"> Organization</th><th><table border="0"><tr><td width="50"> Sept</td><td width="50"> Oct  </td><td width="50"> Nov </td></tr></table></th></tr></table></td></tr>
                
    <?php
    foreach ($dataArray as $upazila => $upazilaData) {
        echo "<tr>";
        echo "<td>$upazila</td>";
        echo "<td>";
        echo "<table border='0'>";
        foreach ($upazilaData as $org => $orgData) {
            echo "<tr>";
            echo "<td  width='200'>$org</td>";
            echo "<td>";
            echo "<table border='0'>";
            echo "<tr>";
            foreach ($orgData as $year => $yearData) {     
                if($yearData['countTotal']>0){
                    $percentage=round(($yearData['countAnswered']*100)/$yearData['countTotal'],1);
                    echo "<td width='50' align='center'>$percentage%</td>"; 
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
        //myprint_r($val);
        echo "</tr>";
    }
    ?>
</table>
                     
<table class="table" width="950px">
<!--
<tr>
<td><strong>Total Summary </strong></td>
<td><strong><? echo " $sum_sept" ;?></strong></td><td><strong><? echo 0 ;?></strong></td><td>0</td><td>0</td>

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
