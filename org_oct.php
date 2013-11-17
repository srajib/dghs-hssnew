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
$answer_storage_month_year='10-2013';


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
			
			
 <div class="spane7" style="alignment-adjust: central"><h3>Upazila Detail Report </h3></div>
 <p>
<div class="spane6" > 
                        
<?php 
function questionReturn($qid,$org_code,$answer_storage_month_year)
{
 $question = mysql_query("SELECT q.question_id,q.question_desc,answer_storage_q".$qid."_answer FROM hss_answer_storage 
 JOIN hss_questions AS q ON q.question_id=".$qid." WHERE hss_answer_storage.answer_storage_month_year='".$answer_storage_month_year."' AND hss_answer_storage.answer_storage_org_id='".$org_code."'");
while($qa = mysql_fetch_array($question))
 {
  return $qa;
 }
}

$question_type=mysql_query("SELECT * FROM hss_question_type ORDER BY type_id ASC");
//echo $question_type;
   while($question_types = mysql_fetch_array($question_type))
   {?>
    <div >
    <a data-toggle="collapse" data-parent="#sample-accordion" href="#collapse<?php echo $question_types['type_id'];?>">
   <?php
        echo $question_types['type_name'];
         $question_types_id=$question_types['type_id'];
        ?>
        </a>
   </div>


        <?php
    $question = mysql_query("SELECT * FROM hss_questions where question_type_id=$question_types_id");
        $i=0;
        while($results = mysql_fetch_array($question))
                {   $i++;
               
                 $qid= $results['question_id'];
                 $answers = mysql_query("SELECT * FROM hss_answers where answer_q_id=$qid");
               //print_r($answers);	 
//                        echo "<pre>";
//                        print_r(questionReturn($qid));
                          $qa=questionReturn($qid,$org_code,$answer_storage_month_year);
                        
                       echo '<div style="width:800px">'.$i.'. '. $qa[1]. '&nbsp;&nbsp;&nbsp;&nbsp;';
                         // echo '<div style="width:800px">Q'.$i.' &nbsp;&nbsp;&nbsp;  ';

                          $ans=$qa[2];

                        while($answer = mysql_fetch_assoc($answers))
                        {

                         //print_r($answer);

                         $answer1 = $answer['answer_ans1'];
                         $answer2 = $answer['answer_ans2'];
                         $answer3 = $answer['answer_ans3'];
                         $answer_id = $answer['answer_id'];
                         $q_id = $answer['answer_q_id'];

                         if($answer1==$ans){ echo '----------- Answer : '.$answer1.'---------- <strong>October:</strong> 1';}
                         else{ echo '----------- Answer : '.$answer2.'  -----------  <strong>October :</strong> 0';}
                         
//                      if($answer1=='Yes'){echo 'Sept : 1'; }
                     
            }
             }
                ?>

<?php
        }
?> 
</div>
			</div>
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
