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

$org_code=$_SESSION['org_code'];

$answer_storage_month_year9='09-2013';
$answer_storage_month_year10='10-2013';
$answer_storage_month_year11='11-2013';
$answer_storage_month_year12='12-2013';


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
		                    
<?php 
function questionReturn($qid,$org_code,$answer_storage_month_year)
{
 $question = mysql_query("SELECT q.question_id,q.question_desc,hss_tertiary_answer_storage.answer_storage_q".$qid."_answer FROM hss_tertiary_answer_storage 
 JOIN hss_tertiary_question AS q ON q.question_id=".$qid." WHERE hss_tertiary_answer_storage.answer_storage_month_year='".$answer_storage_month_year."' AND hss_tertiary_answer_storage.answer_storage_org_id='".$org_code."'");
while($qa = mysql_fetch_array($question))
 {
  return $qa;
 }
}
?>
<div class="span7"> 
<?php               
    $org_sql=mysql_query("SELECT og.org_name,up.old_upazila_id FROM organization og 
    INNER JOIN admin_upazila AS up ON og.upazila_id=up.old_upazila_id
    WHERE og.org_code='$org_code' ");
    $org_row=  mysql_fetch_array($org_sql);
    $upazilla_id=$org_row['old_upazila_id'];

    $org_name=$org_row['org_name'];
    echo '<h4>'. $org_name.'</h4>'.'</br>'; 
    $question_type=mysql_query("SELECT qt.type_id,qt.type_name FROM hss_tertiary_question_type qt
    INNER JOIN hss_question_type_div_district_tertiary AS dd ON qt.type_name=dd.type_name 
    INNER JOIN admin_district AS ds ON dd.district_name=ds.district_name
    INNER JOIN admin_division AS d ON dd.division_name=d.division_name
    INNER JOIN admin_upazila AS up ON ds.old_district_id=up.old_district_id
    WHERE up.old_upazila_id='$upazilla_id' group by qt.type_id  ORDER BY qt.type_id ASC");
//echo $question_type;
    
   while($question_types = mysql_fetch_array($question_type))
   {?>
     <h4> <?php echo $question_types['type_name'];?></h4>   
     <table class="table table-highlight">
                            <thead>
                                <tr>
                                    <td><strong>#</strong></td>
                                    <td><strong>Question</strong></td>
                                    <td><strong>September</strong></td>
                                    <td><strong>October</strong></td>
                                </tr>
                            </thead>
                            <tbody>
  
    <?php
     $question_types_id=$question_types['type_id'];
     $question = mysql_query("SELECT * FROM hss_questions_tertiary where question_type_id=$question_types_id");
    
        $i=0;
        while($results = mysql_fetch_array($question))
                {$i++;
                 $qid= $results['question_id'];
                 $answers = mysql_query("SELECT * FROM hss_answers_tertiary where answer_q_id=$qid");

                 $qa=questionReturn($qid,$org_code,$answer_storage_month_year9);

                 $qa10=questionReturn($qid,$org_code,$answer_storage_month_year10);
              // $qa11=questionReturn($qid,$org_code,$answer_storage_month_year11);
              //$qa12=questionReturn($qid,$org_code,$answer_storage_month_year12);
             
          ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $qa[1]; ?></td>
                <td><?php echo $ans = $qa[2]; ?></td>
                <td><?php echo $ans10 = $qa10[2]; ?></td>
            </tr>
           <?php }?>
          </tbody>
        </table>
      <?php } ?>

              </div>

        </div>
						
		
</div> <!-- /.container -->
	

<div id="footer">	
		
	<div class="container">
		
			&copy; 2013 MIS, DGHS, All rights reserved.
		
	</div> <!-- /.container -->		
	
</div> <!-- /#footer -->





  </body>
</html>

