<?php
session_start();
//error_reporting(2);
include('lib/connect.php');
include('_licts_include.php');
include('inc.functions.generic.php');
require_once 'inc.function.temp.php';

$org_code = $_REQUEST['org_code'];
$answer_storage_month_year = $_REQUEST['month'];
//$org_email = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Health System Strengthening</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Health System Strengthening</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <!--//light box-->
        <script type="text/javascript" src="lightBox/js/jquery.js"></script>
        <script type="text/javascript" src="lightBox/js/jquery.lightbox-0.5.js"></script>

        <link rel="stylesheet" type="text/css" href="lightBox/css/jquery.lightbox-0.5.css" media="screen" />    


        <script type="text/javascript">
            $(function() {
                $('.gallery a').lightBox();
            });
        </script>
        <style type="text/css">
            /* jQuery lightBox plugin - Gallery style */
			
		    #lightbox-container-image-box{
			width:500px;
			height:500px;
			}
			
			#lightbox-image{
			width:500px;
			/*height:500px;*/
			}
            .gallery {
                /*		background-color: #444;*/
                padding: 10px;
                width: 520px;
            }
            .gallery ul { list-style: none; }
            .gallery ul li { display: inline; }
            .gallery ul img {
                border: 5px solid #3e3e3e;
                border-width: 5px 5px 20px;
            }
            .gallery ul a:hover img {
                border: 5px solid #fff;
                border-width: 5px 5px 20px;
                color: #fff;
            }
            .gallery ul a:hover { color: #fff; }

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
			
		#lightbox-container-image img { width:auto; max-height:520px; }
			
			
        </style>
		
		<!--#lightbox-container-image-box{width: 510px; display: block; height: 706px;}-->
		
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php
        $print = "<div><input type=\"button\" onclick=\"javascript:window.print()\" value=\"Print HSS\" class=\"btn_print\" /></div><div class=\"rclear\"></div>";
        
        ?>
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

                function questionReturn($qid, $org_code, $answer_storage_month_year) {
                    $question = mysql_query("SELECT q.question_id,q.question_desc,answer_storage_q" . $qid . "_answer FROM hss_answer_storage 
			 JOIN hss_questions AS q ON q.question_id=" . $qid . " WHERE hss_answer_storage.answer_storage_month_year='" . $answer_storage_month_year . "' AND hss_answer_storage.answer_storage_org_id='" . $org_code . "'");

                    while ($qa = mysql_fetch_array($question)) {
                        return $qa;
                    }
                }

                function evidenceReturn($qid, $org_code, $answer_storage_month_year) {
                    $evidence = mysql_query("SELECT hss_answer_storage.answer_storage_q" . $qid . "_evidence1,hss_answer_storage.answer_storage_q" . $qid . "_evidence2,hss_answer_storage.answer_storage_q" . $qid . "_evidence3 FROM hss_answer_storage WHERE hss_answer_storage.answer_storage_month_year='" . $answer_storage_month_year . "' AND hss_answer_storage.answer_storage_org_id='" . $org_code . "'");

                    while ($ev = mysql_fetch_array($evidence)) {
                        return $ev;
                    }
                }
                function docReturn($qid,$org_code,$answer_storage_month_year)
								{
								 $doc = mysql_query("SELECT hss_answer_storage.answer_storage_q".$qid."_doc1,hss_answer_storage.answer_storage_q".$qid."_doc2,hss_answer_storage.answer_storage_q".$qid."_doc3 FROM hss_answer_storage WHERE hss_answer_storage.answer_storage_month_year='".$answer_storage_month_year."' AND hss_answer_storage.answer_storage_org_id='".$org_code."'");
								
								while($dc = mysql_fetch_array($doc))
								 {
								  return $dc;
								 }
								}

                $org_upo = mysql_query("SELECT organization.org_name,admin_division.division_name, admin_district.district_name, admin_upazila.old_upazila_id,admin_upazila.upazila_name FROM organization
                LEFT JOIN admin_division ON organization.division_code=admin_division.division_bbs_code
                LEFT JOIN admin_district ON organization.district_code=admin_district.district_bbs_code
                LEFT JOIN admin_upazila  ON organization.upazila_id=admin_upazila.old_upazila_id where organization.org_code='" .$org_code . "'");

                $org_upo_row = mysql_fetch_array($org_upo);
                $upa_id=$org_upo_row['old_upazila_id'];
                $dis_name=$org_upo_row['district_name'];
                
                $qtype_sql = mysql_query("SELECT qs.question_desc FROM hss_question_type qt
INNER JOIN hss_question_type_div_district AS dd ON qt.type_name=dd.type_name 
INNER JOIN hss_questions AS qs ON qt.type_id=qs.question_type_id
INNER JOIN admin_district AS ds ON dd.district_name=ds.district_name
INNER JOIN admin_division AS d ON dd.division_name=d.division_name
INNER JOIN admin_upazila AS up ON ds.old_district_id=up.old_district_id
WHERE ds.district_name='$dis_name' and up.old_upazila_id='$upa_id'");
               // $qtype=  mysql_fetch_array($qtype_sql);
                $count_question = (mysql_num_rows($qtype_sql));
		
		 $score2 = 0;
				  for ($i = 1; $i < $count_question; $i++) {
                    $count = mysql_query("SELECT * FROM hss_answer_storage  WHERE hss_answer_storage.answer_storage_q" . $i . "_answer='Yes' AND hss_answer_storage.answer_storage_month_year='" . $answer_storage_month_year . "' AND hss_answer_storage.answer_storage_org_id='" . $org_code . "'");
                    $count_row = (mysql_num_rows($count));
                    $score2 += $count_row;
                }
                   // echo " total : $score2";
                //$url ="http://app.dghs.gov.bd/dghshrm/uploads/";

                $org = mysql_query("SELECT organization.org_name,admin_division.division_name, admin_district.district_name, admin_upazila.old_upazila_id,admin_upazila.upazila_name FROM organization
                    LEFT JOIN admin_division ON organization.division_code=admin_division.division_bbs_code
                    LEFT JOIN admin_district ON organization.district_code=admin_district.district_bbs_code
                    LEFT JOIN admin_upazila  ON organization.upazila_id=admin_upazila.old_upazila_id where organization.org_code='" . $org_code . "'");

                $org_detail = mysql_fetch_array($org);
                $upazila_id=$org_detail['old_upazila_id'];
				
				//echo "<pre>";
				//print_r($org_detail);
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
                                                    <span class="heading">Health System Strengthening <? //echo $pdfdata->lhb_year;   ?></span><br>

                                                    <span class="subheading" style="font-size: 18px"><?php echo $org_detail[0]; ?></span>
                                                </p>
                                                <p><span class="subheading" style="font-size: 18px">Upazila: <?php echo $org_detail[4];//echo $org_detail[3]; ?>, District: <? echo $org_detail[2]; ?>, Division: <? echo $org_detail[1]; ?></span></p>
                                                <p>
                                                    Report on<br>
                                                    <span class="subheading" style="font-size: 17px">Monitoring implementation of improvement plan of HSS</span> <br>
                                                    <span style="color:#000; font-weight: bold;">Report Period: <?php
                                                        $date = '01-' . $answer_storage_month_year;
                                                        echo date('F-Y', strtotime($date));
                                                        ?></span><br>
                                                    <span class="subheading" style="font-size: 20px">Score:
                                                    <?php $answersToBeCountedArray = array('Yes');
                                                      $time= explode('-', $answer_storage_month_year);
                                                      //echo countAllAnswerFrmOrgTar($org_code, $time[0], $time[1], $answersToBeCountedArray, $additoinalQueryString = '');
                                                      $core_percentage = (countAllAnswerFrmOrg($org_code, $time[0], $time[1], $answersToBeCountedArray, $additoinalQueryString = '')*100)/countOfQuestoinsAssignedToOrg($org_code);
                        
                                                      echo round($core_percentage)."% <br/>";?></span>
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
                                <span style="color: #039">ADG Planning and Development,DGHS</span><br>
                                <span class="black">Mohakhali, Dhaka-1212</span>
                            </div><!--end of id headfoot -->
                        </div><!--end of class fullpage -->
                        <p style="page-break-before:always"></p>
                        <div class="fullpage" style="height:auto;">
                            <div style="width:100%; text-align:right;"><? //echo $pdfdata->orgname." | Health Bulletin ".$year." | " ;   ?></div>
                            <fieldset>
                                <legend><div id="lgndp">Question Answer</div></legend>
                                <div class="preface"><div class="widget-content"> 

                                        <div class="accordion-group">

                                            <?php
                                       $question_type = mysql_query("SELECT * FROM hss_question_type");
                                          while ($question_types = mysql_fetch_array($question_type)) {
                                          if (questionTypeBelongsToOrg($question_types['type_id'], $org_code)) {
                                                ?>
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#sample-accordion" href="#collapse<?php echo $question_types['type_id']; ?>">
                                                        <?php
                                                        echo $question_types['type_name'];
                                                        $question_types_id = $question_types['type_id'];
                                                        ?>
                                                    </a>
                                                    <i class="icon-plus toggle-icon"></i>
                                                </div>
                                                <div id="collapse<?php echo $question_types['type_id']; ?>" class="accordion-body collapse">
                                                    <div class="accordion-inner">

                                                        <?php
                                                        $question = mysql_query("SELECT * FROM hss_questions where question_type_id=$question_types_id");
                                                        $i = 0;
                                                        while ($results = mysql_fetch_array($question)) {
                                                            $i++;
                                                            $qid = $results['question_id'];
                                                            $answers = mysql_query("SELECT * FROM hss_answers where answer_q_id=$qid");

                                                            $qa = questionReturn($qid, $org_code, $answer_storage_month_year);
                                                            $ev = evidenceReturn($qid, $org_code, $answer_storage_month_year);
                                                            $dc=docReturn($qid,$org_code,$answer_storage_month_year);
                                                           //echo '<div>';
                                                             echo '<div class="gallery">' . $i . '. ' . $qa[1] . '&nbsp;&nbsp;';
                                                            $url1 = 'upload/';
                                                            $path1 = $url1 . 'q_' . $qid . '_' . $org_code . '_' . $answer_storage_month_year . '_1.gif';
                                                            $imgurl_check1 = $path1;
                                                            if ($ev[0] == NULL) {
                                                                ?><img src="images/no.jpg" width="50" height="50">&nbsp;
                                                            <?php } else { ?><a href="upload/<?php echo $ev[0]; ?>" title=""><img src="upload/<?php echo $ev[0]; ?>" width="50" height="50"></a>&nbsp;<?php
                                                            }
                                                            echo '';
                                                            $path2 = $url1 . 'q_' . $qid . '_' . $org_code . '_' . $answer_storage_month_year . '_2.gif';
                                                            $imgurl_check2 = $path2;
                                                            if ($ev[1] == NULL) {
                                                                ?><img src="images/no.jpg" width="50" height="50">&nbsp;
                                                            <?php } else { ?><a href="upload/<?php echo $ev[1]; ?>" title=""><img src="upload/<?php echo $ev[1]; ?>" width="50" height="50"></a>&nbsp;<?php
                                                            }
                                                            echo '';

                                                            $path3 = $url1 . 'q' . $qid . '_' . $org_code . '_' . $answer_storage_month_year . '_3.jpeg';
                                                            $imgurl_check3 = $path3;
                                                            if ($ev[2] == NULL) {
                                                                ?><img src="images/no.jpg" width="50" height="50">
                                                            <?php } else { ?><a href="upload/<?php echo $ev[2]; ?>" title=""><img src="upload/<?php echo $ev[2]; ?>" width="50" height="50"></a><?php
                                                            }
                                                            
                                                          
                                                            echo '</div>'  ;                                                 
                                                           

                                                            $ans = $qa[2];

                                                            while ($answer = mysql_fetch_assoc($answers)) {

                                                                //print_r($answer);

                                                                $answer1 = $answer['answer_ans1'];
                                                                $answer2 = $answer['answer_ans2'];
                                                                $answer3 = $answer['answer_ans3'];
                                                                $answer_id = $answer['answer_id'];
                                                                $q_id = $answer['answer_q_id'];

                                                                if ($answer1 == $ans) {
                                                                    echo 'Answer: ' . $answer1;
                                                                } elseif ($answer2 == $ans)  {
                                                                    echo 'Answer: ' . $answer2;
                                                                }else
																echo 'Answer: ' . 'Not Answered';
                                                            }
                                                            
                                                            echo '<span>'.'&nbsp;&nbsp;';
                                                            
                                                                         //////////////// Doc/pdf/docx 
                                                                       
                                                                        $doc_url='docs/';
                                                                        $doc_path1 =$doc_url.'q_'.$qid.'_'.$org_code.'_'.$answer_storage_month_year.'_1.doc';
                                                                        $docurl_check1 = $doc_path1;    
                                                                        if ($dc[0]==NULL){}else
								        { ?><a href="docs/<?php echo $dc[0];?>">Doc1 </a>&nbsp;<?php }  
								 	echo ' ';
                                                                        
                                                                        $doc_path2 =$doc_url.'q_'.$qid.'_'.$org_code.'_'.$answer_storage_month_year.'_2.doc';
                                                                        $docurl_check2 = $doc_path2;
                                                                        if ($dc[1]==NULL){}else
								        { ?><a href="docs/<?php echo $dc[1];?>">Doc2</a>&nbsp;<?php }  
								 	echo ' ';
                                                                        
                                                                        $doc_path3 =$doc_url.'q_'.$qid.'_'.$org_code.'_'.$answer_storage_month_year.'_3.doc';
                                                                        $docurl_check3 = $doc_path3;
                                                                        if ($dc[2]==NULL){}else
                                                                            { ?><a href="docs/<?php echo $dc[2];?>">Doc3</a>&nbsp;<?php }  
								 	
                                                                    echo'</span>' ;
                                                                    ////////////
                                                        }
                                                        ?>



                                                        <?php
                                                    }
                                                    }
                                                    ?> 	<div style="margin-left:5px;"> </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div id="prefacefooter"><? //echo $pdfdata->a2;  ?><br><? //echo $pdfdata->orgname;  ?></div>
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
