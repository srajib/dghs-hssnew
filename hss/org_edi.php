<?php
session_start();
//error_reporting(0);
include('lib/connect.php');
include('inc.functions.generic.php');

$id=$_GET['id'];

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
<!--
<link href="./css/bootstrap-overrides.css" rel="stylesheet">
-->
<link href="./css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet">

<link href="./css/slate.css" rel="stylesheet">
<link href="./css/slate-responsive.css" rel="stylesheet">


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
<script>
$("#sample-accordion").accordion({ active: 2 });

    //]]>
</script>	

</head>

<body>
 	<div id="header">
	
	<div class="container">			
		
		<div style="height:100px; width:auto;"><img src="img/logo.png" style="height:80px; width:95px; border:none"><font style="font-family:'Arial Black', Gadget, sans-serif; font-size:25px;position:relative; bottom:15px; color:#CCC">Health System Strength </font><br>
<font style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:13px; left:95px; position:relative; bottom:40px; float:left; color:#CCC">Government of People's Republic of Bangladesh</font><br>
<font style="font-family:Arial, Helvetica, sans-serif; font-size:15px; left:95px; position:relative; bottom:42px;  color:#CCC"><b>Directorate General of Health Services</b></font></div>			
			
		
		<div id="info">				
			
			<a href="javascript:;" id="info-trigger">
				<i class="icon-cog"></i>
			</a>
			
			<div id="info-menu">
				
				<div class="info-details">
				
					<h4>Welcome back, <?php echo $_SESSION['email']; ?>.</h4>
					
					<p>
						Logged in as <?php echo $user_email=$_SESSION['email'];
					
						?>.
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
					
				</li>

				<li class="dropdown">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-external-link"></i>
						Data Entry Form
						<b class="caret"></b>
					</a>	
						
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
			
			  <li class="active">Monitoring implementation of improvement plan of HSS <span style="color:blue;">(Click heading to see questions)</a></li>
			
			<?php $month=mysql_query("SELECT * FROM hss_answer_storage where answer_storage_org_id='$user_email'"); 
			      echo 'Month: ';
				   while($row=mysql_fetch_array($month))
				   {
					 echo '<a href="org_edi.php?id='.$row['answer_storage_id'].'">';
				     echo date('M-Y',strtotime($row['answer_storage_month_year'])).'&nbsp;||&nbsp;';
					 echo '</a>';
				   }
				   
		         $res=mysql_query("SELECT * FROM hss_answer_storage where answer_storage_id='$id'");   
				   while($row=mysql_fetch_array($res))
				   {
				    //echo "<pre>";
				    //print_r($row);
				   }
			?>
			</ul>
			
		</div> <!-- /.page-title -->
		
		<form name="orgfrom" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="answer_storage_org_id" value="<?php echo $user_email;?>">
		<input type="hidden" name="answer_storage_modified" value="<?php  $date2=date('d-m-Y h:m:i');?>">
		<input type="hidden" name="answer_storage_updated_by" value="<?php echo $user_email;?>">
		
		
			<div class="row">
			<div class="span6">
			Select Form 
			<select name="answer_storage_form" style="width:350px;">
			<option value="monitoring_improvement">Monitoring implementation of improvement plan of HSS</option>
			<option value="test">Test</option>
			</select><br/>
			Select Period
		    <input name="answer_storage_month_year" id="period" type="text" style="width:90px;" class="input-medium">
			 <button id="f_btn1">...</button>
			<script>
			
			  Calendar.setup({
				inputField : "period",
				trigger    : "f_btn1",
				onSelect   : function() { this.hide() },
				dateFormat : "%Y-%m-%d"
			  });
			</script>
			
			</div>
		    </div>
			
		
		<div class="row">
			
			<div class="span6">
			
			   
				
				<div class="widget widget-accordion">
					
					
					<div class="widget-header">
						
						<h3>
							Monitoring implementation of improvement plan of HSS
						</h3>					
					</div> <!-- /.widget-header -->
					
						<div class="widget-content">
						<div class="accordion" id="sample-accordion">
				            <div class="accordion-group">
				             
				               
                        <?php 
						   $question_type=mysql_query("SELECT * FROM hss_question_type");
						   while($question_types = mysql_fetch_array($question_type))
						   {?>
						    <div class="accordion-heading">
						    <a class="accordion-toggle" data-toggle="collapse" data-parent="#sample-accordion" href="#collapse<?php echo $question_types['type_id'];?>">
						   <?php
							echo $question_types['type_name'];
							$question_types_id=$question_types['type_id'];
							?>
							</a>
							  <i class="icon-plus toggle-icon"></i>
				              </div>
						    <div id="collapse<?php echo $question_types['type_id'];?>" class="accordion-body collapse">
				           <div class="accordion-inner">
						   
							<?php
						    $question = mysql_query("SELECT * FROM hss_questions where question_type_id=$question_types_id");
							 
							 $i=0;
							  while($results = mysql_fetch_array($question))
								{   $i++;
									echo '<div class="">'.$i.'. '.$results['question_desc'].   '</div><div></div>';
									$qid= $results['question_id'];
									//$answer_qid= $results['question_id'];
									
									$answers = mysql_query("SELECT * FROM hss_answers where answer_q_id=$qid");
									while($answer = mysql_fetch_assoc($answers))
									{
									 $answer1 = $answer['answer_ans1'];
									 $answer2 = $answer['answer_ans2'];
									 $answer3 = $answer['answer_ans3'];
									 $answer_id = $answer['answer_id'];
									 $q_id = $answer['answer_q_id'];
									 ?>
									
									 <?php
									 echo '<input type="hidden" name="answer_storage_q'.$q_id.'" value='.$q_id.'>&nbsp;';
									 echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer1.' checked> '.$answer1.'&nbsp;&nbsp;';
									 echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer2.'> '.$answer2.'&nbsp;&nbsp;';
									
									if($answer3){ echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer3.'> '.$answer3;}else {}
									?> <br>
										Please select Evidence1
										<input type="file" name=answer_storage_q<?php echo $q_id;?>_evidence1>
										<br/>
										Please select Evidence2
										<input type="file" name=answer_storage_q<?php echo $q_id;?>_evidence2>
										
										<br/>
										Please select Evidence3
										<input type="file" name=answer_storage_q<?php echo $q_id;?>_evidence3>        
									 
									   <br>
									  
										 <br> Please select Doc1
										<input type="file" name=answer_storage_q<?php echo $q_id;?>_doc1>
										<br/>
										Please select Doc2
										<input type="file" name=answer_storage_q<?php echo $q_id;?>_doc2>
										<br/>
										Please select Doc3
										<input type="file" name=answer_storage_q<?php echo $q_id;?>_doc3>
									
									<?php }
}
								?>
								
								</div>
								
				              </div>
								
						<?php
							}
						?> 	<div style="margin-left:5px;"><input type="submit" name="submit" value="Save" class="btn btn-primary"> </div>
				            </div>
				              </div>
				            </div>
				          </div>					
						</form>
					</div> <!-- /.widget-content -->
					<?php 
				    if($_POST['submit']){			
$exception_field=array('submit','param');
$str=createMySqlInsertString($_POST, $exception_field);
/******************************************************/	
$str_k=$str['k'];
$str_v=$str['v'];
$sql="INSERT INTO hss_answer_storage($str_k) values($str_v)";
mysql_query($sql);
//echo "<pre>";
//print_r($_POST); 
//echo $sql;
//myprint_r($str);

print "<script>";
print " self.location='success.php'"; // Comment this line if you don't want to redirect
print "</script>";
	}
	?>
					
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
