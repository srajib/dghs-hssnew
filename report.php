<?php
session_start();
//error_reporting(2);
include('lib/connect.php');
include('_licts_include.php');

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
$answer_storage_month_year=$_REQUEST['month'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Health System Strengthening</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">

<style>
	body {
		font-size: 13px;
	}
	.btn_print{
		position: fixed;
		float: right;
		right: 0;
		padding: 5px 10px 5px 10px;
		color: #fff;
		background: #09F;
		font-size: 16px;
		font-weight: bold;
	}
	.rclear {
		clear: right;	
	}
	@media print {
		.btn_print{
			display: none;
		}	
	}
</style>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
	

</head>

<body>
<?php $print="<div><input type=\"button\" onclick=\"javascript:window.print()\" value=\"Print HSS\" class=\"btn_print\" /></div><div class=\"rclear\"></div>";
 	echo $print;?>
	<div id="header">
	


</div> <!-- /#header -->


<div id="nav">
		
	<div class="container">
		
		<a href="javascript:;" class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        	<i class="icon-reorder"></i>
      	</a>
		
		<div class="nav-collapse">
			
		
			
		</div> <!-- /.nav-collapse -->
		
	</div> <!-- /.container -->
	
</div> <!-- /#nav -->


<div id="content">
		
	<div class="container">
		
	
		<?php
		 $sql=mysql_query("select org_type_code from organization");
                        while($org_type_row=  mysql_fetch_array($sql)){
                         $org_type=$org_type_row['org_type_code'];
						 }
		if(@$org_type=='1002'||$org_type=='1028'||$org_type=='1005'||$org_type=='1022'||$org_type=='1023'){
				function questionReturn($qid,$org_code,$answer_storage_month_year)
								{
								 $question = mysql_query("SELECT q.question_id,q.question_desc,answer_storage_q".$qid."_answer FROM hss_tertiary_answer_storage JOIN hss_tertiary_question AS q ON q.question_id=".$qid." WHERE hss_tertiary_answer_storage.answer_storage_month_year='".$answer_storage_month_year."' AND hss_tertiary_answer_storage.answer_storage_org_id='".$org_code."'");
								
								while($qa = mysql_fetch_array($question))
								 {
								  return $qa;
								 }
								}
				function evidenceReturn($qid,$org_code,$answer_storage_month_year)
								{
								 $evidence = mysql_query("SELECT hss_tertiary_answer_storage.answer_storage_q".$qid."_evidence1,hss_tertiary_answer_storage.answer_storage_q".$qid."_evidence2,hss_tertiary_answer_storage.answer_storage_q".$qid."_evidence3 FROM hss_tertiary_answer_storage WHERE hss_tertiary_answer_storage.answer_storage_month_year='".$answer_storage_month_year."' AND hss_tertiary_answer_storage.answer_storage_org_id='".$org_code."'");
								
								while($ev = mysql_fetch_array($evidence))
								 {
								  return $ev;
								 }
								}	

					
					$score = 0;			
					for($i=1;$i<51;$i++)
                    {					
					$count = mysql_query("SELECT * FROM hss_tertiary_answer_storage  WHERE hss_tertiary_answer_storage.answer_storage_q".$i."_answer='Yes'  AND hss_tertiary_answer_storage.answer_storage_month_year='".$answer_storage_month_year."' AND hss_tertiary_answer_storage.answer_storage_org_id='".$org_code."'");
				    $count_row=(mysql_num_rows($count));
					 $score += $count_row;
					}	
				}else{
				
				function questionReturn($qid,$org_code,$answer_storage_month_year)
								{
								 $question = mysql_query("SELECT q.question_id,q.question_desc,answer_storage_q".$qid."_answer FROM hss_answer_storage JOIN hss_questions AS q ON q.question_id=".$qid." WHERE hss_answer_storage.answer_storage_month_year='".$answer_storage_month_year."' AND hss_answer_storage.answer_storage_org_id='".$org_code."'");
								
								while($qa = mysql_fetch_array($question))
								 {
								  return $qa;
								 }
								}
				function evidenceReturn($qid,$org_code,$answer_storage_month_year)
								{
								 $evidence = mysql_query("SELECT hss_answer_storage.answer_storage_q".$qid."_evidence1,hss_answer_storage.answer_storage_q".$qid."_evidence2,hss_answer_storage.answer_storage_q".$qid."_evidence3 FROM hss_answer_storage WHERE hss_answer_storage.answer_storage_month_year='".$answer_storage_month_year."' AND hss_answer_storage.answer_storage_org_id='".$org_code."'");
								
								while($ev = mysql_fetch_array($evidence))
								 {
								  return $ev;
								 }
								}	

					
					$score = 0;			
					for($i=1;$i<51;$i++)
                    {					
					$count = mysql_query("SELECT * FROM hss_answer_storage  WHERE hss_answer_storage.answer_storage_q".$i."_answer='Yes'  AND hss_answer_storage.answer_storage_month_year='".$answer_storage_month_year."' AND hss_answer_storage.answer_storage_org_id='".$org_code."'");
				    $count_row=(mysql_num_rows($count));
					 $score += $count_row;
				
				
				}}

					$url ="http://app.dghs.gov.bd/dghshrm/uploads/";

                  $org = mysql_query("SELECT organization.org_name,admin_division.division_name, admin_district.district_name, admin_upazila.upazila_name FROM organization
                    LEFT JOIN admin_division ON organization.division_code=admin_division.division_bbs_code
                    LEFT JOIN admin_district ON organization.district_code=admin_district.district_bbs_code
                    LEFT JOIN admin_upazila  ON organization.upazila_id=admin_upazila.old_upazila_id where organization.org_code='".$org_code."'");
					
                  $org_detail=mysql_fetch_array($org);					
					
			?>
			<div id="output"></div>
		
		<div class="row">
			
			<div class="span6">
			  
					
	<div class="fullpage">
    	<div id="headlogo">
    		<br> &nbsp; <br>
            <table align="center">
             <tbody>
              <tr>
               <td align="center" valign="middle">
                 <p><a href="#"><img src="./publish_files/gov.jpg" height="100px" alt="BD GOV"></a><br>
                   <span class="heading">Ministry of Health and Family Welfare (MOHFW)</span><br>
                   <span class="subheading" style="font-size: 18px">Health System Strengthening <? //echo $pdfdata->lhb_year; ?></span><br>
                  
                   <span class="subheading"><? echo $org_detail[0]; ?></span>
                </p>
                <p><span class="subheading" style="font-size: 18px">Upazila: <?php echo $org_detail[3]; ?>, District: <? echo $org_detail[2]; ?>, Division: <? echo $org_detail[1]; ?></span></p>
                <p>
				Report on<br>
				 <span class="subheading" style="font-size: 17px">Monitoring implementation of improvement plan of HSS</span> <br>
				 <span style="color:#000; font-weight: bold;">Report Period: <?php  $date='01-'.$answer_storage_month_year; echo date('F-Y',strtotime($date));
				 ?></span><br>
				 <span class="subheading" style="font-size: 20px">Score:  <?php echo $score_percentage=(($score*100)/50).'%';?> </span>
				</p>
				</td>
			  </tr>
             </tbody>
            </table>
            <br />
			
			
        </div><!--end of id headlogo -->
        <div class="headfoot">
            <img src="./publish_files/logo-hpnsdp.jpg" alt="HPNSDP" width="181" height="143"><br>
            <span class="black">Supported by:</span><br>
            <span style="color: #039">Management Information System (MIS)</span><br>
            <span class="black">Directorate General of Health Services (DGHS)</span><br>
            <span class="black">Ministry of Health &amp; Family Welfare (MOHFW)</span><br>
            <span class="black">Mohakhali, Dhaka-1212</span>
        </div><!--end of id headfoot -->
    </div><!--end of class fullpage -->
    <p style="page-break-before:always"></p>
    <div class="fullpage" style="height:6480px;">
    	<div style="width:100%; text-align:right;"><? //echo $pdfdata->orgname." | Health Bulletin ".$year." | " ; ?></div>
    	<fieldset>
            <legend><div id="lgndp">Question Answer</div></legend>
            <div class="preface"><div class="widget-content"> 
						
						<div class="accordion-group">
            
                        <?php 
                        $sql=mysql_query("select org_type_code from organization");
                        $org_type_row=  mysql_fetch_array($sql);
                         $org_type=$org_type_row['org_type_code'];
   
                            if(@$org_type=='1002'|| $org_type=='1028'|| $org_type=='1005'|| $org_type=='1022'|| $org_type=='1023')
                            {  

				$question_type=mysql_query("SELECT * FROM hss_tertiary_question_type");
				 while($question_types = mysql_fetch_array($question_type))
						   {?>
						    <div>
						    <a class="accordion-toggle" data-toggle="collapse" data-parent="#sample-accordion" href="#collapse<?php echo $question_types['type_id'];?>">
						   
						   <?php
							echo '<br><b>'.$question_types['type_name'].'</b>';
							     $question_types_id=$question_types['type_id'];
							?>
							</a>
							  <i class="icon-plus toggle-icon"></i>
				              </div>
						    <div>
				           <div class="accordion-inner"> 
                                               <?
                                               $question_type=mysql_query("SELECT * FROM hss_tertiary_question_type");
						   while($question_types = mysql_fetch_array($question_type))
						   {?>
						    <div>
						    <a class="accordion-toggle" data-toggle="collapse" data-parent="#sample-accordion" href="#collapse<?php echo $question_types['type_id'];?>">
						   
						   <?php
							echo '<br><b>'.$question_types['type_name'].'</b>';
							     $question_types_id=$question_types['type_id'];
							?>
							</a>
							  <i class="icon-plus toggle-icon"></i>
				              </div>
						    <div>
				           <div class="accordion-inner"> 
						   
							<?php
                                                       
						    $question = mysql_query("SELECT * FROM hss_tertiary_question where question_type_id=$question_types_id");
							$i=0;
							while($results = mysql_fetch_array($question))
								{   $i++;
								 $qid= $results['question_id'];
								 $answers = mysql_query("SELECT * FROM hss_questions_tertiary where answer_q_id=$qid");
								//print_r($answers);	 
									//echo "<pre>";
									//print_r(questionReturn($qid));
									 $qa=questionReturn($qid,$org_code,$answer_storage_month_year);
									 $ev=evidenceReturn($qid,$org_code,$answer_storage_month_year);
                                                                        
									 
									 
									 echo '<div class="">'.$i.'. '. $qa[1]. '&nbsp;&nbsp;';
									 $url1='upload/';
									$path1 =$url1.'q_'.$qid.'_'.$org_code.'_'.$answer_storage_month_year.'_1.gif';
									$imgurl_check1 = $path1;
									if ($ev[0]==NULL)
										  { ?><img src="images/no.jpg" width="50" height="50">&nbsp;
									     <?php }else{ ?><img src="upload/<?php echo $ev[0];?>" width="50" height="50">&nbsp;<?php }  
								 	echo '';
									$path2 =$url1.'q_'.$qid.'_'.$org_code.'_'.$answer_storage_month_year.'_2.gif';
									$imgurl_check2 = $path2;
								   if ($ev[1]==NULL)
										  { ?><img src="images/no.jpg" width="50" height="50">&nbsp;
									     <?php }else{ ?><img src="upload/<?php echo $ev[1];?>" width="50" height="50">&nbsp;<?php }  
								 	echo '';
									
									$path3 =$url1.'q'.$qid.'_'.$org_code.'_'.$answer_storage_month_year.'_3.jpeg';
									$imgurl_check3 = $path3;
								 if ($ev[2]==NULL)
										  { ?><img src="images/no.jpg" width="50" height="50">
									     <?php }else{ ?><img src="upload/<?php echo $ev[2];?>" width="50" height="50"><?php }  
								 	echo '</div>';
						
									 
									 $ans=$qa[2];
									 
									while($answer = mysql_fetch_assoc($answers))
									{
									
									 //print_r($answer);
									
									 $answer1 = $answer['answer_ans1'];
									 $answer2 = $answer['answer_ans2'];
									 $answer3 = $answer['answer_ans3'];
									 $answer_id = $answer['answer_id'];
									 $q_id = $answer['answer_q_id'];
									 
									 if($answer1==$ans){ echo 'Answer: '.$answer1;}
									 else{ echo 'Answer: '.$answer2;}

							
							    }
                                                             }
								?>
								
								</div>
								
				              </div>
								
						<?php
							}
						?> 	<div style="margin-left:5px;"> </div>
				            </div><?
	                                 }}else
                                             {
                        
////////////////////////
						   $question_type=mysql_query("SELECT * FROM hss_question_type");
						   while($question_types = mysql_fetch_array($question_type))
						   {?>
						    <div>
						    <a class="accordion-toggle" data-toggle="collapse" data-parent="#sample-accordion" href="#collapse<?php echo $question_types['type_id'];?>">
						   
						   <?php
							echo '<br><b>'.$question_types['type_name'].'</b>';
							     $question_types_id=$question_types['type_id'];
							?>
							</a>
							  <i class="icon-plus toggle-icon"></i>
				              </div>
						    <div>
				           <div class="accordion-inner"> 
						   
							<?php
                                                       
						    $question = mysql_query("SELECT * FROM hss_questions where question_type_id=$question_types_id");
							$i=0;
							while($results = mysql_fetch_array($question))
								{   $i++;
								 $qid= $results['question_id'];
								 $answers = mysql_query("SELECT * FROM hss_answers where answer_q_id=$qid");
								//print_r($answers);	 
									//echo "<pre>";
									//print_r(questionReturn($qid));
									 $qa=questionReturn($qid,$org_code,$answer_storage_month_year);
									 $ev=evidenceReturn($qid,$org_code,$answer_storage_month_year);
                                                                         //print_r($qa);
                                                                         //print_r($ev);
									 
									// print_r($ev);
									 
									 
									 echo '<div class="">'.$i.'. '. $qa[1]. '&nbsp;&nbsp;';
									 $url1='upload/';
									$path1 =$url1.'q_'.$qid.'_'.$org_code.'_'.$answer_storage_month_year.'_1.gif';
									$imgurl_check1 = $path1;
									if ($ev[0]==NULL)
										  { ?><img src="images/no.jpg" width="50" height="50">&nbsp;
									     <?php }else{ ?><img src="upload/<?php echo $ev[0];?>" width="50" height="50">&nbsp;<?php }  
								 	echo '';
									$path2 =$url1.'q_'.$qid.'_'.$org_code.'_'.$answer_storage_month_year.'_2.gif';
									$imgurl_check2 = $path2;
								   if ($ev[1]==NULL)
										  { ?><img src="images/no.jpg" width="50" height="50">&nbsp;
									     <?php }else{ ?><img src="upload/<?php echo $ev[1];?>" width="50" height="50">&nbsp;<?php }  
								 	echo '';
									
									$path3 =$url1.'q'.$qid.'_'.$org_code.'_'.$answer_storage_month_year.'_3.jpeg';
									$imgurl_check3 = $path3;
								 if ($ev[2]==NULL)
										  { ?><img src="images/no.jpg" width="50" height="50">
									     <?php }else{ ?><img src="upload/<?php echo $ev[2];?>" width="50" height="50"><?php }  
								 	echo '</div>';
						
									 
									 $ans=$qa[2];
									 
									while($answer = mysql_fetch_assoc($answers))
									{
									
									 //print_r($answer);
									
									 $answer1 = $answer['answer_ans1'];
									 $answer2 = $answer['answer_ans2'];
									 $answer3 = $answer['answer_ans3'];
									 $answer_id = $answer['answer_id'];
									 $q_id = $answer['answer_q_id'];
									 
									 if($answer1==$ans){ echo 'Answer: '.$answer1;}
									 else{ echo 'Answer: '.$answer2;}
										
									
									
							
							    }
}
								?>
								
								</div>
								
				              </div>
								
						<?php
							}}
						?> 	<div style="margin-left:5px;"> </div>
				            </div>
				             
						
						
						</div>
				          </div>
            <div id="prefacefooter"><? //echo $pdfdata->a2; ?><br><? //echo $pdfdata->orgname; ?></div>
     	</fieldset>
    </div>

					
					</div> <!-- /.widget-content -->
					
					
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
