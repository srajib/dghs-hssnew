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

</script>	

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
                                                <? if($org_type=='1002'||$org_type=='1005'||$org_type=='1004')
                                                    {?>
                                                <li class="dropdown">
							<a href="tartiry_organization_summry.php">
								Organization Answer Report									
								<i class="icon-chevron-right sub-menu-caret"></i>
							</a>
						</li>
                                                <?}else{?>
                                                 <li class="dropdown">
							<a href="upozila_organization_summary.php">
								Organization Answer Report									
								<i class="icon-chevron-right sub-menu-caret"></i>
							</a>
						</li><?}?>
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
			    <a href="index.php"><b>Home</b></a> <span class="divider">/</span>
			  </li>
			
			  <li class="active">Monitoring implementation of improvement plan of HSS <span style="color:blue;">(Click heading to see questions)</a></li>
			
			
			</ul>
			
			<script>
			var v = $('#answer_storage_month_year option:selected').val();
			
            $('#answer_storage_month_year_2').val(v);
			
			</script>
			
		</div> <!-- /.page-title -->
		
		<form name="orgfrom" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="answer_storage_month_year_2" value="" id="answer_storage_month_year_2">
		<input type="hidden" name="answer_storage_org_id" value="<?php echo $org_code;?>">
		<input type="hidden" name="answer_storage_modified" value="<?php echo $date2=date('Y-m-d h:m:i');?>">
		<input type="hidden" name="answer_storage_updated_by" value="<?php echo $user_email;?>">
		
		
			<div class="row">
			<div class="span6">
			
			
			
			
			<?php
				$first  = strtotime('first day this month');
				$months = array();
				for ($i = 5; $i >-1; $i--) {
				array_push($months, date('F', strtotime("-$i month", $first)));
				}
				
				
			?>
			
			<script>
			
		       /*
			
				function toggle() {
			
				var v = $('#answer_storage_month_year option:selected').val();
				 //var v = v.toString();
				$(function () 
			    {
				
				 	
				
				//-----------------------------------------------------------------------
				// 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
				//-----------------------------------------------------------------------
				$.ajax({                                      
				  url: 'api.php',                  //the script to call to get data          
				  data: "org_id=<?php echo $org_code;?>&month="+v,                        //you can insert url argumnets here to pass to api.php
												   //for example "id=5&parent=6"
				  dataType: 'json',                //data format      
				  type: "POST",
				  success: function(data)          //on recieve of reply
				  { 
				    
				    
					var vname = data;           //get name
					if(vname > 0)
					{
					  	$('#output').html("<b>You already inserted this month data.You can only update data.<br><a href='org_edit.php?month="+t+"'>Please click here to update new datas.</a></b>"); //Set output element html
						$('.widget-accordion').hide();
					}
					else{
						$('#output').html("<b>You have not insert any data for this month. </b>"); //Set output element html
						$('.widget-accordion').show();
					}
					//alert(data);
					//--------------------------------------------------------------------
					// 3) Update html content
					//--------------------------------------------------------------------
				
					//recommend reading up on jquery selectors they are awesome 
					// http://api.jquery.com/category/selectors/
				  } 
				});
  }); 
			  
			     }
				 
				    $("#myanchorid").click(function () {
					  $(".widget-accordion").show();
				    });
				 
				 */
			</script>
			
			
			</div>
		    </div>
			
			
			<div id="output"></div>
		
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
                        $org = mysql_query("SELECT organization.org_name,admin_division.division_name, admin_district.district_name, admin_upazila.old_upazila_id,admin_upazila.upazila_name FROM organization
                    LEFT JOIN admin_division ON organization.division_code=admin_division.division_bbs_code
                    LEFT JOIN admin_district ON organization.district_code=admin_district.district_bbs_code
                    LEFT JOIN admin_upazila  ON organization.upazila_id=admin_upazila.old_upazila_id where organization.org_code='" . $org_code . "'");

                $org_detail = mysql_fetch_array($org);
                $upazila_id=$org_detail['old_upazila_id'];
                          if($org_type=='1002'||$org_type=='1005'||$org_type=='1004'){
                            $org_code=$_SESSION['org_code'] ;
							$month=$_REQUEST['month'];	
							$query=mysql_query("SELECT answer_storage_org_id FROM hss_tertiary_answer_storage WHERE answer_storage_month_year='$month' AND answer_storage_org_id='$org_code'");
					
							//print_r($rows);
						while($row=mysql_fetch_object($query)){
						   $ans_strg_id=$row->answer_storage_org_id;
							}
							
						   function questionReturn($qid,$month,$org_code )
						   {
						   
						    $question = mysql_query("SELECT q.question_id,q.question_desc,answer_storage_q".$qid."_answer FROM hss_tertiary_answer_storage JOIN hss_tertiary_question AS q ON q.question_id=hss_tertiary_answer_storage.answer_storage_q".$qid." WHERE hss_tertiary_answer_storage.answer_storage_q".$qid.'='.$qid);
						   
						    while($qa = mysql_fetch_array($question))
							 {
							  return $qa;
							 }
						   }
						   
						    function answerReturn($qid,$month,$org_code )
						   {
						   
						    $answer = mysql_query("SELECT q.question_id,q.question_desc,answer_storage_q".$qid."_answer FROM hss_tertiary_answer_storage JOIN hss_tertiary_question AS q ON q.question_id=hss_tertiary_answer_storage.answer_storage_q".$qid." WHERE hss_tertiary_answer_storage.answer_storage_org_id='".$org_code."' AND hss_tertiary_answer_storage.answer_storage_month_year='".$month."' AND hss_tertiary_answer_storage.answer_storage_q".$qid.'='.$qid);
						   
						    while($an = mysql_fetch_array($answer))
							 {
							  return $an;
							 }
						   }
						   				  
						
						   $question_type=mysql_query("SELECT d.old_division_id,up.upazila_name,dd.division_name,ds.old_district_id,dd.district_name,qt.type_id,qt.type_name FROM hss_tertiary_question_type qt
INNER JOIN hss_question_type_div_district_tertiary AS dd ON qt.type_name=dd.type_name 
INNER JOIN admin_district AS ds ON dd.district_name=ds.district_name
INNER JOIN admin_division AS d ON dd.division_name=d.division_name
INNER JOIN admin_upazila AS up ON ds.old_district_id=up.old_district_id
WHERE up.old_upazila_id='$upazila_id' group by qt.type_id ORDER BY qt.type_id ASC");
						   $j=1;
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
                                                        
						    $question = mysql_query("SELECT * FROM hss_tertiary_question where question_type_id=$question_types_id");
							$i=0;
							while($results = mysql_fetch_array($question))
								{   $i++;
								    $qid= $results['question_id'];
									//echo '<div class="">'.$i.'. '.$results['question_desc'].   '&nbsp;&nbsp; <a href="evidence.php?question_id='.$qid.'&&org_email='.$user_email.'">Add Evidence</a> | <a href="doc.php?question_id='.$qid.'&&org_email='.$user_email.'">Add Doc</a></div><div></div>';
								
									$answers = mysql_query("SELECT * FROM hss_answers_tertiary where answer_q_id=$qid");
									
									$q_answers = mysql_query("SELECT * FROM hss_tertiary_answer_storage where answer_storage_id='$ans_strg_id' AND answer_q_id='$qid'");
									
									//print_r($results = mysql_fetch_array($q_answers ));
									
									 $month=$_REQUEST['month'];
									 $org_code=$_SESSION['org_code'] ;
									questionReturn($qid,$month,$org_code);
									$qa=questionReturn($qid,$month,$org_code);
									$qans=answerReturn($qid,$month,$org_code);
									 echo '<div class="">'.$i.'. '.$ques=$qa[1]. '&nbsp;&nbsp;  <a href="evidence_tartiary.php?question_id='.$qid.'&&org_email='.$org_code.'&&month='.$month.'">Add Photograph</a> | <a href="doc_tartiary.php?question_id='.$qid.'&&org_email='.$org_code.'&&month='.$month.'">Add Document</a></div>';
									 $ans=$qans[2];
									
									
									while($answer = mysql_fetch_assoc($answers))
									{
									 $k=$j++;
									 $answer1 = $answer['answer_ans1'];
									 $answer2 = $answer['answer_ans2'];
									 $answer3 = $answer['answer_ans3'];
									 $answer_id = $answer['answer_id'];
									 $q_id = $answer['answer_q_id'];
									 
									 
									 ?>
									
									 <?php
									echo '<input type="hidden" name="answer_storage_q'.$q_id.'" value='.$q_id.'>&nbsp;';
									echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer1;if($answer1==$ans){ echo ' checked=checked';}echo '> '.$answer1.'&nbsp;&nbsp;';
									echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer2;if($answer2==$ans){ echo ' checked=checked';}echo ' > '.$answer2.'&nbsp;&nbsp;';
									if($answer3){ echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer3;if($answer3==$ans){ echo ' checked=checked';}echo ' > '.$answer3;}else {}
									?>
									<?php }
}
								?>
								
								</div>
								
				              </div>    
                       						
                                                        <?
                                                   }}
                                                   else { //moly
                                                   	
						$org_code=$_SESSION['org_code'] ;
							$month=$_REQUEST['month'];	
							$query=mysql_query("SELECT answer_storage_id FROM hss_answer_storage WHERE answer_storage_month_year='$month' AND answer_storage_org_id='$org_code'");
					
							//print_r($rows);
						while($row=mysql_fetch_object($query)){
						   $ans_strg_id=$row->answer_storage_id;
							}
							
						   function questionReturn($qid,$month,$org_code )
						   {
						   
						    $question = mysql_query("SELECT q.question_id,q.question_desc,answer_storage_q".$qid."_answer FROM hss_answer_storage JOIN hss_questions AS q ON q.question_id=hss_answer_storage.answer_storage_q".$qid." WHERE hss_answer_storage.answer_storage_q".$qid.'='.$qid);
						   
						    while($qa = mysql_fetch_array($question))
							 {
							  return $qa;
							 }
						   }
						   
						    function answerReturn($qid,$month,$org_code )
						   {
						   
						    $answer = mysql_query("SELECT q.question_id,q.question_desc,answer_storage_q".$qid."_answer FROM hss_answer_storage JOIN hss_questions AS q ON q.question_id=hss_answer_storage.answer_storage_q".$qid." WHERE hss_answer_storage.answer_storage_org_id='".$org_code."' AND hss_answer_storage.answer_storage_month_year='".$month."' AND hss_answer_storage.answer_storage_q".$qid.'='.$qid);
						   
						    while($an = mysql_fetch_array($answer))
							 {
							  return $an;
							 }
						   }
						   				  
						 
						   $question_type=mysql_query("SELECT d.old_division_id,up.upazila_name,dd.division_name,ds.old_district_id,dd.district_name,qt.type_id,qt.type_name FROM hss_question_type qt
INNER JOIN hss_question_type_div_district AS dd ON qt.type_name=dd.type_name 
INNER JOIN admin_district AS ds ON dd.district_name=ds.district_name
INNER JOIN admin_division AS d ON dd.division_name=d.division_name
INNER JOIN admin_upazila AS up ON ds.old_district_id=up.old_district_id
WHERE up.old_upazila_id='$upazila_id' ORDER BY qt.type_id ASC");
						   $j=1;
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
								    $qid= $results['question_id'];
									//echo '<div class="">'.$i.'. '.$results['question_desc'].   '&nbsp;&nbsp; <a href="evidence.php?question_id='.$qid.'&&org_email='.$user_email.'">Add Evidence</a> | <a href="doc.php?question_id='.$qid.'&&org_email='.$user_email.'">Add Doc</a></div><div></div>';
								
									$answers = mysql_query("SELECT * FROM hss_answers where answer_q_id=$qid");
									
									$q_answers = mysql_query("SELECT * FROM hss_answer_storage where answer_storage_id='$ans_strg_id' AND answer_q_id='$qid'");
									
									//print_r($results = mysql_fetch_array($q_answers ));
									
									 $month=$_REQUEST['month'];
									 $org_code=$_SESSION['org_code'] ;
									questionReturn($qid,$month,$org_code);
									$qa=questionReturn($qid,$month,$org_code);
									$qans=answerReturn($qid,$month,$org_code);
									 echo '<div class="">'.$i.'. '.$ques=$qa[1]. '&nbsp;&nbsp;  <a href="evidence.php?question_id='.$qid.'&&org_email='.$org_code.'&&month='.$month.'">Add Photograph</a> | <a href="doc.php?question_id='.$qid.'&&org_email='.$org_code.'&&month='.$month.'">Add Document</a></div>';
									 $ans=$qans[2];
									
									
									while($answer = mysql_fetch_assoc($answers))
									{
									 $k=$j++;
									 $answer1 = $answer['answer_ans1'];
									 $answer2 = $answer['answer_ans2'];
									 $answer3 = $answer['answer_ans3'];
									 $answer_id = $answer['answer_id'];
									 $q_id = $answer['answer_q_id'];
									 
									 
									 ?>
									
									 <?php
									echo '<input type="hidden" name="answer_storage_q'.$q_id.'" value='.$q_id.'>&nbsp;';
									echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer1;if($answer1==$ans){ echo ' checked=checked';}echo '> '.$answer1.'&nbsp;&nbsp;';
									echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer2;if($answer2==$ans){ echo ' checked=checked';}echo ' > '.$answer2.'&nbsp;&nbsp;';
									if($answer3){ echo '<input type="radio" name="answer_storage_q'.$q_id.'_answer" value='.$answer3;if($answer3==$ans){ echo ' checked=checked';}echo ' > '.$answer3;}else {}
									?>
									<?php }
}
								?>
								
								</div>
								
				              </div>		
						<?php
							}}
						?> 	<div style="margin-left:5px;"><input type="submit" name="submit" value="Save" class="btn btn-primary"> </div>
				            </div>
				              </div>
				            </div>
				          </div>					
						</form>
					</div> <!-- /.widget-content -->
					<?php 
					$month=$_GET['month'];
				
		
				    if($_POST['submit']){
                                        
                                     if($org_type=='1002'||$org_type=='1005'||$org_type=='1004'){
                                      
                                        $exception_field=array('submit','param','answer_storage_month_year_2');
					$str=createMySqlUpdateString($_POST, $exception_field);
					
					$sql="UPDATE hss_tertiary_answer_storage SET $str where answer_storage_org_id='$org_code' and answer_storage_month_year='$month'"; 
					
					mysql_query($sql);
					print "<script>";
					print " self.location='org.php'"; // Comment this line if you don't want to redirect
					print "</script>";
                                        
                                        
                                    }    
                                    else{
					$exception_field=array('submit','param','answer_storage_month_year_2');
					$str=createMySqlUpdateString($_POST, $exception_field);
					
					$sql="UPDATE hss_answer_storage SET $str where answer_storage_org_id='$org_code' and answer_storage_month_year='$month'"; 
					
					mysql_query($sql);
					print "<script>";
					print " self.location='org.php'"; // Comment this line if you don't want to redirect
					print "</script>";
	}}
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
