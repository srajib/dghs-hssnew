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

<!--<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">-->
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


<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
	

</head>

<body>
 <?php include('header.php');?> 

<div id="nav">
		 
	<div class="container">
           
		
		<a href="javascript:;" class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        	<i class="icon-reorder"></i>
      	</a>
		
		<div class="nav-collapse">
			
			<ul class="nav">
		
				
                                <?php    if(@$org_type=='1002'||$org_type=='1005'||$org_type=='1004'){?>
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
		
				<li >
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
			    <a href="index.php"><b>Home</b></a> <span class="divider">/</span>
			  </li>
			
			  <li class="active">Monitoring implementation of improvement plan of HSS <span style="color:blue;">(Click heading to see questions)</a></li>
			
			
			</ul>
			
			<script>
			var v = $('#answer_storage_month_year option:selected').val();
            //var t =$('#answer_storage_month_year_2').val(v);
			</script>
			
		</div> <!-- /.page-title -->
		
		<form name="orgfrom" action="" method="post" enctype="multipart/form-data">
		<!-- <input type="hidden" name="answer_storage_month_year_2" value="" id="answer_storage_month_year_2">-->
		<input type="hidden" name="answer_storage_org_id" value="<?php echo $org_code;?>">
		<input type="hidden" name="answer_storage_modified" value="<?php echo $date2=date('Y-m-d h:m:i');?>">
		<input type="hidden" name="answer_storage_updated_by" value="<?php echo $user_email;?>">
				
			<div class="row">
			<div class="span6">
			<!--Monitoring implementation of improvement plan of HSS-->
			<input type='hidden' name='answer_storage_form' value='1'>
			<!--Select Form 
			<select name="answer_storage_form" style="width:350px;">
                                     
                                         <?php
                                     $forms = mysql_query("SELECT * FROM hss_forms");
                                     while($form = mysql_fetch_array($forms))
                                     {
                                       ?>
                                            <option value="<?php echo $form['form_id']; ?>"><?php echo $form['form_name']; ?></option>
                                         <?php
				}
										 ?>
             </select>
             -->
			<br/>
			Report for the month of
			<?php
				$first  = strtotime('first day this month');
				$months = array();
				for ($i = 0; $i >-1; $i--) {
				array_push($months, date('F', strtotime("$i month", $first)));
				}
			
                        ?><?php
			if(@$org_type=='1002'||$org_type=='1005'||$org_type=='1004'){?>
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
					  	$('#output').html("<b>You already inserted this month data.You can only update data.<a href='org_edit.php?month="+t+"'>Please click here to update new datas.</a></b>"); //Set output element html
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
                        <?}  else {?>
                            
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
					  	$('#output').html("<b>You already inserted this month data.You can only update data.<a href='org_edit.php?month="+t+"'>Please click here to update new datas.</a></b>"); //Set output element html
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
                        
			<?php  $base_month ='09-2013';
			       $base_month_date ='01-09-2013';
				   $current_month=date('m-Y');
				  //$org_type;
			?>
<!--			<select name="answer_storage_month_year" id="answer_storage_month_year" onchange="toggle()">
				<option value="">==Select Month==</option>
				<?php if($base_month==$current_month) { } else { ?>
				<option value="<?php echo $base_month;?>"><?php echo date('F',strtotime($base_month_date)).'-'.date('Y'); ?></option>
				<?php } ?>
				<? foreach($months as $month): ?>
				<option value="<?php echo date('m',strtotime($month)).'-'.date('Y');?>"><?php echo $month.'-'.date('Y'); ?></option>
				<? endforeach; ?>
			</select>-->
                        <select name="answer_storage_month_year" id="answer_storage_month_year" onchange="toggle()">
					<option value="">==Select Month==</option>
				<option value="10-2013">October,2013</option>
				<option value="09-2013">September,2013</option>
				
				
			</select>
			</div>
		    </div>
			<div id="output"></div>
		
		<div class="row">
			
			<div class="span6">
			
			   
				
				<div class="widget widget-accordion" style="display:none;">
					
					
					<div class="widget-header">
						
						<h3>
							Monitoring implementation of improvement plan of HSS
						</h3>					
					</div> <!-- /.widget-header -->
					
						<div class="widget-content">
						<div class="accordion" id="sample-accordion">
						
						
						
						
				            <div class="accordion-group">

                        <?php 
						
						   if(@$org_type=='1002'||$org_type=='1005'||$org_type=='1004'){
						
						   $question_type=mysql_query("SELECT * FROM hss_tertiary_question_type ORDER BY type_id ASC");
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
							
						    $question = mysql_query("SELECT * FROM hss_tertiary_question where question_type_id=$question_types_id order by question_id asc" );
							 if($question_types['type_name']=='Co-ordination Meeting')
							 {
							  echo "Note:<br/>Inter Unit/Inter Department co-ordination meeting with service provider of indoor/Outdoor
/Labroatory/Radiology,etc.<br/>N.B. This is <b>not</b> the monthly field staff meeting.<br/><br/>";
							 
							 }
							 $i=0;
							  while($results = mysql_fetch_array($question))
								{   $i++;
									$qid= $results['question_id'];
									
								    echo '<div class="">'.$i.'. '.$results['question_desc'].'</div>';
									$answer_qid= $results['question_id'];
									
									$answers = mysql_query("SELECT * FROM hss_answers_tertiary where answer_q_id=$qid");
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
									 echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer1.'> '.$answer1.'&nbsp;&nbsp;';
									 echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer2.'> '.$answer2.'&nbsp;&nbsp;';
									
									if($answer3){ echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer3.'> '.$answer3;}else {}
									
									
									?>
									
									
									<?php } 
										//echo   '<div>&nbsp;&nbsp;  <a href="evidence.php?question_id='.$qid.'&&org_email='.$user_email.'&&month='.$month.'">Add Photograph</a> | <a href="doc.php?question_id='.$qid.'&&org_email='.$user_email.'&&month='.$month.'">Add Document</a></div><div></div>';
									//echo   '<div></div>';
								
}
								?>
								
								</div>
								
				              </div>
								
						<?php
							} 
							}
							else{
						   $question_type=mysql_query("SELECT * FROM hss_question_type ORDER BY type_id  ASC");
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
							
						    $question = mysql_query("SELECT * FROM hss_questions where question_type_id=$question_types_id order by question_id asc" );
							 if($question_types['type_name']=='Co-ordination Meeting')
							 {
							  echo "Note:<br/>Inter Unit/Inter Department co-ordination meeting with service provider of indoor/Outdoor
/Labroatory/Radiology,etc.<br/>N.B. This is <b>not</b> the monthly field staff meeting.<br/><br/>";
							 
							 }
			
							 $i=0;
							  while($results = mysql_fetch_array($question))
								{   $i++;
									$qid= $results['question_id'];
									
								    echo '<div class="">'.$i.'. '.$results['question_desc'].'</div>';
									$answer_qid= $results['question_id'];
									
									$answers = mysql_query("SELECT * FROM hss_answers where answer_q_id=$qid");
									while($answer = mysql_fetch_assoc($answers))
									{
									 $answer1 = $answer['answer_ans1'];
									 $answer2 = $answer['answer_ans2'];
									 //$answer3 = $answer['answer_ans3'];
									 $answer_id = $answer['answer_id'];
									 $q_id = $answer['answer_q_id'];
									 ?>
									
									 <?php
									 echo '<input type="hidden" name="answer_storage_q'.$q_id.'" value='.$q_id.'>&nbsp;';
									 echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer1.'> '.$answer1.'&nbsp;&nbsp;';
									 echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer2.'> '.$answer2.'&nbsp;&nbsp;';
									
									//if($answer3){ echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer3.'> '.$answer3;}else {}
									
									
									?>
									
									
									<?php } 
										//echo   '<div>&nbsp;&nbsp;  <a href="evidence.php?question_id='.$qid.'&&org_email='.$user_email.'&&month='.$month.'">Add Photograph</a> | <a href="doc.php?question_id='.$qid.'&&org_email='.$user_email.'&&month='.$month.'">Add Document</a></div><div></div>';
									//echo   '<div></div>';
								
                                                                }
								?>
								
								</div>
								
				              </div>
							<?} }?>
						<div style="margin-left:5px;"><input type="submit" name="submit" value="Save" class="btn btn-primary"> </div>
				            </div>
				              </div>
				            </div>
				          </div>					
						</form>
					</div> <!-- /.widget-content -->
					<?php 
                                        
				  if(@$_POST['submit']){	
				   if(@$org_type=='1002'||$org_type=='1005'||$org_type=='1004'){
					//print_r($_POST);
					$exception_field=array('submit','param');
					$str=createMySqlInsertString($_POST, $exception_field);
					/******************************************************/	
					$str_k=$str['k'];
					$str_v=$str['v'];
                                        //print_r($str_k);
                                        //print_r($str_v);
                                        $sql=mysql_query("INSERT INTO hss_tertiary_answer_storage($str_k)values($str_v)");
					print "<script>";
					print " self.location=org.php"; // Comment this line if you don't want to redirect
					print "</script>";
					}
//                                        
					else 
					{
                                            //print_r($_POST);
                                            $exception_field=array('submit','param');
                                            $str=  createMySqlInsertString($_POST, $exception_field);
                                           // echo '$str';
                                            /******************************************************/	
                                            $str_k=$str['k'];
                                            $str_v=$str['v'];
                                            //print_r($str_k);
                                           // print_r($str_v);
                                            $sql=mysql_query("INSERT INTO hss_answer_storage($str_k)values($str_v)");
                                            //mysql_query($sql);
                                            print "<script>";
                                            print " self.location=org.php'"; // Comment this line if you don't want to redirect
                                            print "</script>";
					}
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
