<?php
session_start();
//error_reporting(0);
include('lib/connect.php');
include('inc.functions.generic.php');

if (empty($_SESSION['loginid'])) {
    print "<script>";
    print " self.location='index.php'"; // Comment this line if you don't want to redirect
    print "</script>";
}

if ($_SESSION['loginid'] <= 2) {
    print "<script>";
    print " self.location='admin.php'"; // Comment this line if you don't want to redirect
    print "</script>";
}

$org_code = $_SESSION['org_code'];

$answer_storage_month_year9 = '09-2013';
$answer_storage_month_year10 = '10-2013';
$answer_storage_month_year11 = '11-2013';
$answer_storage_month_year12 = '12-2013';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Health System Strengthening</title>

               <!-- Styles -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <link href="css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet">

        <link href="css/slate.css" rel="stylesheet">
        <link href="css/slate-responsive.css" rel="stylesheet">

        <!-- Javascript -->
        <script src="js/jquery-1.7.2.min.js"></script>
        <script src="js/bootstrap.js"></script>

        <link rel="stylesheet" type="text/css" href="css/jscal2.css"/>
        <link rel="stylesheet" type="text/css" href="css/border-radius.css"/>
        <link rel="stylesheet" type="text/css" href="css/steel/steel.css"/>

        <script src="js/demos/charts/bar.js"></script>

    </head>

    <body>
        
        <?php  include('header1.php');
       
        $print = "<div><input type=\"button\" onclick=\"javascript:window.print()\" value=\"Print HSS\" class=\"btn_print\" /></div><div class=\"rclear\"></div>";
        echo $print;
      
        
        ?>
    
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
                ?>

                <div class="span7"> 
                    <h3>Upazila Detail Report </h3></br>
                   
                    <?php
                    $org_sql = mysql_query("SELECT up.old_upazila_id FROM organization og 
                    INNER JOIN admin_upazila AS up ON og.upazila_id=up.old_upazila_id
                    WHERE og.org_code='$org_code' ");
                    $org_row = mysql_fetch_array($org_sql);
                    $upazilla_id = $org_row['old_upazila_id'];


                    $question_type = mysql_query("SELECT d.old_division_id,up.upazila_name,dd.division_name,ds.old_district_id,dd.district_name,qt.type_id,qt.type_name FROM hss_question_type qt
                    INNER JOIN hss_question_type_div_district AS dd ON qt.type_name=dd.type_name 
                    INNER JOIN admin_district AS ds ON dd.district_name=ds.district_name
                    INNER JOIN admin_division AS d ON dd.division_name=d.division_name
                    INNER JOIN admin_upazila AS up ON ds.old_district_id=up.old_district_id
                    WHERE up.old_upazila_id='$upazilla_id' group by qt.type_id ORDER BY qt.type_id ASC");
                    //echo $question_type;

                    while ($question_types = mysql_fetch_array($question_type)):
                        ?>
                        <h4><?php echo $question_types['type_name']; ?></h4>
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
                                $question_types_id = $question_types['type_id'];
                                $question = mysql_query("SELECT * FROM hss_questions where question_type_id=$question_types_id");
                                $i = 0;
                                while ($results = mysql_fetch_array($question)):
                                    $i++;
                                    $qid = $results['question_id'];
                                    $answers = mysql_query("SELECT * FROM hss_answers where answer_q_id=$qid");

                                    $qa = questionReturn($qid, $org_code, $answer_storage_month_year9);
                                    $qa10 = questionReturn($qid, $org_code, $answer_storage_month_year10);
                                    //print_r($qa1);
                                    //$qa11 = questionReturn($qid, $org_code, $answer_storage_month_year11);
                                    //$qa12 = questionReturn($qid, $org_code, $answer_storage_month_year12);
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $qa[1]; ?></td>
                                        <td><?php echo $ans = $qa[2]; ?></td>
                                        <td><?php echo $ans10 = $qa10[2]; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>  
                    <?php endwhile; ?>                                        

                </div> 

            </div> <!-- /.container -->

        </div>
        <div id="footer">	

            <div class="container">

                &copy; 2013 MIS, DGHS, All rights reserved.

            </div> <!-- /.container -->		

        </div> <!-- /#footer -->

    </body>
</html>
