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

 $division_bbs_code=$_GET['division_bbs_code'];
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
<link href="./css/slate-responsive.css" rel="stylesheet">
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
  $div_sql=mysql_query("Select division_name from admin_division where division_bbs_code='$division_bbs_code'");
 $div_row= mysql_fetch_array($div_sql);
 $div_name=$div_row['division_name'];
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
			<ul id="navigation" style="border:double; border-color:#AFDBFE;background-color:#EEF5FD" hieght="auto"> 
		<li><a href="cont_tartiary.php?bd=<?php echo $bd;?>">Bangladesh</a>
			<ul>
<?php
// tree part start
 $tree = mysql_query("SELECT * from admin_division");
    while($row = mysql_fetch_array($tree))
            {
                ?>
                <li style="background-color:#EEF5FD"><a href="division_tartiary.php?division_bbs_code=<?php echo $row['division_bbs_code'];?>"><?php echo $row['division_name']; ?></a>
                        <ul>
                <?php
                 $divid = $row['division_bbs_code'];
                 $dist = mysql_query("SELECT * FROM admin_district WHERE division_bbs_code='$divid'");
                 while($rowdist = mysql_fetch_array($dist))
                { ?>
                     <li style="background-color:#EEF5FD"><a href="district_tartiary.php?district_bbs_code=<?php echo $rowdist['district_bbs_code']; ?>"><?php echo $rowdist['district_name']; ?></a>
                            <ul>
							<?php
							 $disid=$rowdist['old_district_id'];
				            $upo = mysql_query("SELECT * FROM admin_upazila WHERE old_district_id='$disid'");
							while($rowupo = mysql_fetch_array($upo)){
							?>
                                <li style="background-color:#EEF5FD"><a href="upozilla_tartiary.php?upozilla_id=<?php echo $rowupo['old_upazila_id']?> "><?php echo $rowupo['upazila_name']; ?></a>
								
								</li>
                               <?php }?> </ul>
               		  </li>
                    <?php
                }?>
					</ul>
				</li>
                <?php
            }?>
			</ul>
		</li>
	</ul>	
				
			</div> <!-- /.span3 -->
			<div class="spane6"><h3> District wise Summary Report of <? echo $div_name ;?> Division</h3>
                            <p>
			<table class='table'>
			  <tbody>
			    <th> District Name</th><th> Answer </th><th> Sept </th><th> Oct </th><th> Nov </th><th>Dec </th>
			  </tbody>
                          <?
//                          $district1=mysql_query("select o.district_name from organization o 
//                          inner join hss_tertiary_answer_storage as a on (o.org_code=a.answer_storage_org_id)
//                          where o.division_code='$division_bbs_code' group by o.district_name ");
                          
                          $district1=mysql_query("SELECT o.district_name FROM admin_district o 
INNER JOIN admin_division AS a ON (o.division_bbs_code=a.division_bbs_code)
WHERE o.division_bbs_code='$division_bbs_code' GROUP BY o.district_name ");
                     $sum_sept=0; 
                     $sum_oct=0;
                     $sum_nov=0;
                      while ($row_dis=  mysql_fetch_array($district1)){
                      $dis1= $row_dis['district_name']; 
                          
                          $sql_con=mysql_query(" SELECT o.district_name,
  SUM(CASE WHEN answer_storage_q1_answer = 'yes' THEN 1 ELSE 0 END) AS q1,
  SUM(CASE WHEN answer_storage_q2_answer = 'yes' THEN 1 ELSE 0 END) AS q2,
  SUM(CASE WHEN answer_storage_q3_answer = 'yes' THEN 1 ELSE 0 END) AS q3, 
  SUM(CASE WHEN answer_storage_q4_answer = 'yes' THEN 1 ELSE 0 END) AS q4, 
  SUM(CASE WHEN answer_storage_q5_answer = 'yes' THEN 1 ELSE 0 END) AS q5,
  SUM(CASE WHEN answer_storage_q6_answer = 'yes' THEN 1 ELSE 0 END) AS q6,
  SUM(CASE WHEN answer_storage_q7_answer = 'yes' THEN 1 ELSE 0 END) AS q7, 
  SUM(CASE WHEN answer_storage_q8_answer = 'yes' THEN 1 ELSE 0 END) AS q8, 
  SUM(CASE WHEN answer_storage_q9_answer = 'yes' THEN 1 ELSE 0 END) AS q9,
  SUM(CASE WHEN answer_storage_q10_answer = 'yes' THEN 1 ELSE 0 END) AS q10,
  
  SUM(CASE WHEN answer_storage_q11_answer = 'yes' THEN 1 ELSE 0 END) AS q11,
  SUM(CASE WHEN answer_storage_q12_answer = 'yes' THEN 1 ELSE 0 END) AS q12,
  SUM(CASE WHEN answer_storage_q13_answer = 'yes' THEN 1 ELSE 0 END) AS q13, 
  SUM(CASE WHEN answer_storage_q14_answer = 'yes' THEN 1 ELSE 0 END) AS q14, 
  SUM(CASE WHEN answer_storage_q15_answer = 'yes' THEN 1 ELSE 0 END) AS q15,
  SUM(CASE WHEN answer_storage_q16_answer = 'yes' THEN 1 ELSE 0 END) AS q16,
  SUM(CASE WHEN answer_storage_q17_answer = 'yes' THEN 1 ELSE 0 END) AS q17, 
  SUM(CASE WHEN answer_storage_q18_answer = 'yes' THEN 1 ELSE 0 END) AS q18, 
  SUM(CASE WHEN answer_storage_q19_answer = 'yes' THEN 1 ELSE 0 END) AS q19,
  SUM(CASE WHEN answer_storage_q20_answer = 'yes' THEN 1 ELSE 0 END) AS q20,
  
  SUM(CASE WHEN answer_storage_q21_answer = 'yes' THEN 1 ELSE 0 END) AS q21,
  SUM(CASE WHEN answer_storage_q22_answer = 'yes' THEN 1 ELSE 0 END) AS q22,
  SUM(CASE WHEN answer_storage_q23_answer = 'yes' THEN 1 ELSE 0 END) AS q23, 
  SUM(CASE WHEN answer_storage_q24_answer = 'yes' THEN 1 ELSE 0 END) AS q24, 
  SUM(CASE WHEN answer_storage_q25_answer = 'yes' THEN 1 ELSE 0 END) AS q25,
  SUM(CASE WHEN answer_storage_q26_answer = 'yes' THEN 1 ELSE 0 END) AS q26,
  SUM(CASE WHEN answer_storage_q27_answer = 'yes' THEN 1 ELSE 0 END) AS q27, 
  SUM(CASE WHEN answer_storage_q28_answer = 'yes' THEN 1 ELSE 0 END) AS q28, 
  SUM(CASE WHEN answer_storage_q29_answer = 'yes' THEN 1 ELSE 0 END) AS q29,
  SUM(CASE WHEN answer_storage_q30_answer = 'yes' THEN 1 ELSE 0 END) AS q30,
  
  SUM(CASE WHEN answer_storage_q31_answer = 'yes' THEN 1 ELSE 0 END) AS q31,
  SUM(CASE WHEN answer_storage_q32_answer = 'yes' THEN 1 ELSE 0 END) AS q32,
  SUM(CASE WHEN answer_storage_q33_answer = 'yes' THEN 1 ELSE 0 END) AS q33, 
  SUM(CASE WHEN answer_storage_q34_answer = 'yes' THEN 1 ELSE 0 END) AS q34, 
  SUM(CASE WHEN answer_storage_q35_answer = 'yes' THEN 1 ELSE 0 END) AS q35,
  SUM(CASE WHEN answer_storage_q36_answer = 'yes' THEN 1 ELSE 0 END) AS q36,
  SUM(CASE WHEN answer_storage_q37_answer = 'yes' THEN 1 ELSE 0 END) AS q37, 
  SUM(CASE WHEN answer_storage_q38_answer = 'yes' THEN 1 ELSE 0 END) AS q38, 
  SUM(CASE WHEN answer_storage_q39_answer = 'yes' THEN 1 ELSE 0 END) AS q39,
  SUM(CASE WHEN answer_storage_q40_answer = 'yes' THEN 1 ELSE 0 END) AS q40,
  
  SUM(CASE WHEN answer_storage_q41_answer = 'yes' THEN 1 ELSE 0 END) AS q41,
  SUM(CASE WHEN answer_storage_q42_answer = 'yes' THEN 1 ELSE 0 END) AS q42,
  SUM(CASE WHEN answer_storage_q43_answer = 'yes' THEN 1 ELSE 0 END) AS q43, 
  SUM(CASE WHEN answer_storage_q44_answer = 'yes' THEN 1 ELSE 0 END) AS q44, 
  SUM(CASE WHEN answer_storage_q45_answer = 'yes' THEN 1 ELSE 0 END) AS q45,
  SUM(CASE WHEN answer_storage_q46_answer = 'yes' THEN 1 ELSE 0 END) AS q46,
  SUM(CASE WHEN answer_storage_q47_answer = 'yes' THEN 1 ELSE 0 END) AS q47, 
  SUM(CASE WHEN answer_storage_q48_answer = 'yes' THEN 1 ELSE 0 END) AS q48, 
  SUM(CASE WHEN answer_storage_q49_answer = 'yes' THEN 1 ELSE 0 END) AS q49,
  SUM(CASE WHEN answer_storage_q50_answer = 'yes' THEN 1 ELSE 0 END) AS q50,
  
  SUM(CASE WHEN answer_storage_q51_answer = 'yes' THEN 1 ELSE 0 END) AS q51, 
  SUM(CASE WHEN answer_storage_q52_answer = 'yes' THEN 1 ELSE 0 END) AS q52,
  SUM(CASE WHEN answer_storage_q53_answer = 'yes' THEN 1 ELSE 0 END) AS q53,
  
a.answer_storage_month_year FROM hss_tertiary_answer_storage a
INNER JOIN organization AS o ON (a.answer_storage_org_id=o.org_code)
WHERE  o.division_code='$division_bbs_code' and o.district_name='$dis1' and a.answer_storage_month_year='09-2013' GROUP BY o.district_name");

$sept=0;
                          while($row= mysql_fetch_array($sql_con)){
//                               echo '<pre>';
//                              print_r($row);
                      
                          $q1=$row['q1'];
                          $q2=$row['q2'];
                          $q3=$row['q3'];
                          $q4=$row['q4'];
                          $q5=$row['q5'];
                          $q6=$row['q6'];
                          $q7=$row['q7'];
                          $q8=$row['q8'];
                          $q9=$row['q9'];
                          $q10=$row['q10'];
                          
                          $q11=$row['q11'];
                          $q12=$row['q12'];
                          $q13=$row['q13'];
                          $q14=$row['q14'];
                          $q15=$row['q15'];
                          $q16=$row['q16'];
                          $q17=$row['q17'];
                          $q18=$row['q18'];
                          $q19=$row['q19'];
                          $q20=$row['q20'];
                          
                          $q21=$row['q21'];
                          $q22=$row['q22'];
                          $q23=$row['q23'];
                          $q24=$row['q24'];
                          $q25=$row['q25'];
                          $q26=$row['q26'];
                          $q27=$row['q27'];
                          $q28=$row['q28'];
                          $q29=$row['q29'];
                          $q30=$row['q30'];
                          
                          $q31=$row['q31'];
                          $q32=$row['q32'];
                          $q33=$row['q33'];
                          $q34=$row['q34'];
                          $q35=$row['q35'];
                          $q36=$row['q36'];
                          $q37=$row['q37'];
                          $q38=$row['q38'];
                          $q39=$row['q39'];
                          $q40=$row['q40'];
                          
                          $q41=$row['q41'];
                          $q42=$row['q42'];
                          $q43=$row['q43'];
                          $q44=$row['q44'];
                          $q45=$row['q45'];
                          $q46=$row['q46'];
                          $q47=$row['q47'];
                          $q48=$row['q48'];
                          $q49=$row['q49'];
                          $q50=$row['q50'];
                          
                          $q51=$row['q51'];
                          $q52=$row['q52'];
                          $q53=$row['q53'];
                          
                         $sept=$q1+$q2+$q3+$q4+$q5+$q6+$q7+$q8+$q9+$q10+$q11+$q12+$q13+$q14+$q15+$q16+$q17+$q18+$q19+$q20+$q21+$q22+$q23+$q24+$q25+$q26+$q27+$q28+$q29+$q30+$q31+$q32+$q33+$q34+$q35+$q36+$q37+$q38+$q39+$q40+$q41+$q42+$q43+$q44+$q45+$q46+$q47+$q48+$q49+$q50+$q51+$q52+$q53;
                         
                        // $sept_score=round(($sept * .53)).'%';
                         } 
 //////////////////////////////////////////////// October
                          
  $sql_con_oct=mysql_query(" SELECT o.district_name,
  SUM(CASE WHEN answer_storage_q1_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q1,
  SUM(CASE WHEN answer_storage_q2_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q2,
  SUM(CASE WHEN answer_storage_q3_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q3, 
  SUM(CASE WHEN answer_storage_q4_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q4, 
  SUM(CASE WHEN answer_storage_q5_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q5,
  SUM(CASE WHEN answer_storage_q6_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q6,
  SUM(CASE WHEN answer_storage_q7_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q7, 
  SUM(CASE WHEN answer_storage_q8_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q8, 
  SUM(CASE WHEN answer_storage_q9_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q9,
  SUM(CASE WHEN answer_storage_q10_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q10,
  
  SUM(CASE WHEN answer_storage_q11_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q11,
  SUM(CASE WHEN answer_storage_q12_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q12,
  SUM(CASE WHEN answer_storage_q13_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q13, 
  SUM(CASE WHEN answer_storage_q14_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q14, 
  SUM(CASE WHEN answer_storage_q15_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q15,
  SUM(CASE WHEN answer_storage_q16_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q16,
  SUM(CASE WHEN answer_storage_q17_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q17, 
  SUM(CASE WHEN answer_storage_q18_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q18, 
  SUM(CASE WHEN answer_storage_q19_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q19,
  SUM(CASE WHEN answer_storage_q20_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q20,
  
  SUM(CASE WHEN answer_storage_q21_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q21,
  SUM(CASE WHEN answer_storage_q22_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q22,
  SUM(CASE WHEN answer_storage_q23_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q23, 
  SUM(CASE WHEN answer_storage_q24_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q24, 
  SUM(CASE WHEN answer_storage_q25_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q25,
  SUM(CASE WHEN answer_storage_q26_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q26,
  SUM(CASE WHEN answer_storage_q27_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q27, 
  SUM(CASE WHEN answer_storage_q28_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q28, 
  SUM(CASE WHEN answer_storage_q29_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q29,
  SUM(CASE WHEN answer_storage_q30_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q30,
  
  SUM(CASE WHEN answer_storage_q31_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q31,
  SUM(CASE WHEN answer_storage_q32_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q32,
  SUM(CASE WHEN answer_storage_q33_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q33, 
  SUM(CASE WHEN answer_storage_q34_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q34, 
  SUM(CASE WHEN answer_storage_q35_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q35,
  SUM(CASE WHEN answer_storage_q36_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q36,
  SUM(CASE WHEN answer_storage_q37_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q37, 
  SUM(CASE WHEN answer_storage_q38_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q38, 
  SUM(CASE WHEN answer_storage_q39_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q39,
  SUM(CASE WHEN answer_storage_q40_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q40,
  
  SUM(CASE WHEN answer_storage_q41_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q41,
  SUM(CASE WHEN answer_storage_q42_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q42,
  SUM(CASE WHEN answer_storage_q43_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q43, 
  SUM(CASE WHEN answer_storage_q44_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q44, 
  SUM(CASE WHEN answer_storage_q45_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q45,
  SUM(CASE WHEN answer_storage_q46_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q46,
  SUM(CASE WHEN answer_storage_q47_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q47, 
  SUM(CASE WHEN answer_storage_q48_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q48, 
  SUM(CASE WHEN answer_storage_q49_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q49,
  SUM(CASE WHEN answer_storage_q50_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q50,
  
  SUM(CASE WHEN answer_storage_q51_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q51, 
  SUM(CASE WHEN answer_storage_q52_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q52,
  SUM(CASE WHEN answer_storage_q53_answer = 'yes' THEN 1 ELSE 0 END) AS oct_q53,
  
  a.answer_storage_month_year FROM hss_tertiary_answer_storage a
  LEFT JOIN organization AS o ON (a.answer_storage_org_id=o.org_code)
  WHERE o.division_code='$division_bbs_code' and o.district_name='$dis1' and a.answer_storage_month_year='10-2013' GROUP BY o.district_name");
$oct=0;
                          while($row_oct= mysql_fetch_array($sql_con_oct)){
//                              echo '<pre>';
//                              print_r($row_oct);
                          //$disname=$row['district_name'];
                          $oct_q1=$row_oct['oct_q1'];
                          $oct_q2=$row_oct['oct_q2'];
                          $oct_q3=$row_oct['oct_q3'];
                          $oct_q4=$row_oct['oct_q4'];
                          $oct_q5=$row_oct['oct_q5'];
                          $oct_q6=$row_oct['oct_q6'];
                          $oct_q7=$row_oct['oct_q7'];
                          $oct_q8=$row_oct['oct_q8'];
                          $oct_q9=$row_oct['oct_q9'];
                          $oct_q10=$row_oct['oct_q10'];
                          
                          $oct_q11=$row_oct['oct_q11'];
                          $oct_q12=$row_oct['oct_q12'];
                          $oct_q13=$row_oct['oct_q13'];
                          $oct_q14=$row_oct['oct_q14'];
                          $oct_q15=$row_oct['oct_q15'];
                          $oct_q16=$row_oct['oct_q16'];
                          $oct_q17=$row_oct['oct_q17'];
                          $oct_q18=$row_oct['oct_q18'];
                          $oct_q19=$row_oct['oct_q19'];
                          $oct_q20=$row_oct['oct_q20'];
                          
                          $oct_q21=$row_oct['oct_q21'];
                          $oct_q22=$row_oct['oct_q22'];
                          $oct_q23=$row_oct['oct_q23'];
                          $oct_q24=$row_oct['oct_q24'];
                          $oct_q25=$row_oct['oct_q25'];
                          $oct_q26=$row_oct['oct_q26'];
                          $oct_q27=$row_oct['oct_q27'];
                          $oct_q28=$row_oct['oct_q28'];
                          $oct_q29=$row_oct['oct_q29'];
                          $oct_q30=$row_oct['oct_q30'];
                          
                          $oct_q31=$row_oct['oct_q31'];
                          $oct_q32=$row_oct['oct_q32'];
                          $oct_q33=$row_oct['oct_q33'];
                          $oct_q34=$row_oct['oct_q34'];
                          $oct_q35=$row_oct['oct_q35'];
                          $oct_q36=$row_oct['oct_q36'];
                          $oct_q37=$row_oct['oct_q37'];
                          $oct_q38=$row_oct['oct_q38'];
                          $oct_q39=$row_oct['oct_q39'];
                          $oct_q40=$row_oct['oct_q40'];
                          
                          $oct_q41=$row_oct['oct_q41'];
                          $oct_q42=$row_oct['oct_q42'];
                          $oct_q43=$row_oct['oct_q43'];
                          $oct_q44=$row_oct['oct_q44'];
                          $oct_q45=$row_oct['oct_q45'];
                          $oct_q46=$row_oct['oct_q46'];
                          $oct_q47=$row_oct['oct_q47'];
                          $oct_q48=$row_oct['oct_q48'];
                          $oct_q49=$row_oct['oct_q49'];
                          $oct_q50=$row_oct['oct_q50'];
                          
                          $oct_q51=$row_oct['oct_q51'];
                          $oct_q52=$row_oct['oct_q52'];
                          $oct_q53=$row_oct['oct_q53'];
                          
                          
                            $oct=$oct_q1+$oct_q2+$oct_q3+$oct_q4+$oct_q5+$oct_q6+$oct_q7+$oct_q8+$oct_q9+$oct_q10+$oct_q11+$oct_q12+$oct_q13+$oct_q14+$oct_q15+$oct_q16+$oct_q17+$oct_q18+$oct_q19+$oct_q20+$oct_q21+$oct_q22+$oct_q23+$oct_q24+$oct_q25+$oct_q26+$oct_q27+$oct_q28+$oct_q29+$oct_q30+$oct_q31+$oct_q32+$oct_q33+$oct_q34+$oct_q35+$oct_q36+$oct_q37+$oct_q38+$oct_q39+$oct_q40+$oct_q41+$oct_q42+$oct_q43+$oct_q44+$oct_q45+$oct_q46+$oct_q47+$oct_q48+$oct_q49+$oct_q50+$oct_q51+$oct_q52+$oct_q53;
                   
                         // $oct_score=round(($oct * .53)).'%';
                          }
                           $sum_sept+= $sept;
                          $sum_oct+= $oct;
                          ?>
                          <tr>
				<td> <? echo $dis1; ?>  </td><td> Yes </td><td> <? echo $sept ;?></td><td> <?php echo $oct; ?> </td><td> 0 </td><td> 0 </td> </tr>
			 
			<? } ?>			  
			</table>
<table class="table" width="950px">
<tr>
<td><strong>Total Summary </strong></td>
<td><strong><? echo " $sum_sept" ;?></strong></td><td><strong><? echo " $sum_oct" ;?></strong></td><td>0</td><td>0</td>

</tr>
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
