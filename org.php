<?php
session_start();
//error_reporting(0);
include('lib/connect.php');
include('inc.functions.generic.php');
require_once 'inc.function.temp.php';

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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
   <?php include_once 'inc.head.php'; ?> 
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
            <?php  if (checkIfOrgIsTartiary($org_code)) { ?>
              <li class="dropdown">
                <a href="reporting_tartiary.php">
                  <i class="icon-home"></i>
                  <span>HSS Report Panel</span>
                </a>	    				
              </li><? } else { ?>
              <li class="dropdown">
                <a href="reporting.php">
                  <i class="icon-home"></i>
                  <span>HSS Report Panel</span>
                </a>	    				
              </li><? } ?>
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

                <?php  if (checkIfOrgIsTartiary($org_code))  { ?>
                  <li class="dropdown">
                    <a href="tartiry_organization_summry.php">
                      Organization Answer Report									
                      <i class="icon-chevron-right sub-menu-caret"></i>
                    </a>
                  </li>
                <?php } else { ?>
                  <li class="dropdown">
                    <a href="upozila_organization_summary.php">
                      Organization Answer Report									
                      <i class="icon-chevron-right sub-menu-caret"></i>
                    </a>
                  </li><? } ?>
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
          <input type="hidden" name="answer_storage_org_id" value="<?php echo $org_code; ?>">
          <input type="hidden" name="answer_storage_modified" value="<?php echo $date2 = date('Y-m-d h:m:i'); ?>">
          <input type="hidden" name="answer_storage_updated_by" value="<?php echo $user_email; ?>">

          <div class="row">
            <div class="span6">
              <!--Monitoring implementation of improvement plan of HSS-->
              <input type='hidden' name='answer_storage_form' value='1'>
              <!--Select Form 
              <select name="answer_storage_form" style="width:350px;">
                           
              <?php
              $forms = mysql_query("SELECT * FROM hss_forms");
              while ($form = mysql_fetch_array($forms)) {
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
              $first = strtotime('first day this month');
              $months = array();
              for ($i = 0; $i > -1; $i--) {
                array_push($months, date('F', strtotime("$i month", $first)));
              }
              ?><?php if (checkIfOrgIsTartiary($org_code))  { ?>
                <script>
                  function toggle() {
                    var v = $('#answer_storage_month_year option:selected').val();
                    var v = v.toString();
                    $(function()
                    {
                      //-----------------------------------------------------------------------
                      // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
                      //-----------------------------------------------------------------------
                      $.ajax({
                        url: 'api_tartiary.php', //the script to call to get data          
                        data: "org_id=<?php echo $org_code; ?>&month=" + v, //you can insert url argumnets here to pass to api.php
                        //for example "id=5&parent=6"
                        dataType: 'json', //data format      
                        type: "POST",
                        success: function(data)          //on recieve of reply
                        {

                          var v = $('#answer_storage_month_year option:selected').val();

                          var vname = data;    //get name
                          var t = v;           //get name


                          if (vname > 0)
                          {
                            $('#output').html("<b>You already inserted this month data.You can only update data.<a href='org_edit.php?month=" + t + "'>Please click here to update new datas.</a></b>"); //Set output element html
                            $('.widget-accordion').hide();
                          }
                          else {
                            $('#output').html("<b>You have not insert any data for this month. </b>"); //Set output element html
                            $('.widget-accordion').show();
                          }
                        }
                      });
                    });

                  }



                </script>
              <? } else { ?>

                <script>
                  function toggle() {
                    var v = $('#answer_storage_month_year option:selected').val();
                    var v = v.toString();
                    $(function()
                    {
                      //-----------------------------------------------------------------------
                      // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
                      //-----------------------------------------------------------------------
                      $.ajax({
                        url: 'api.php', //the script to call to get data          
                        data: "org_id=<?php echo $org_code; ?>&month=" + v, //you can insert url argumnets here to pass to api.php
                        //for example "id=5&parent=6"
                        dataType: 'json', //data format      
                        type: "POST",
                        success: function(data)          //on recieve of reply
                        {

                          var v = $('#answer_storage_month_year option:selected').val();

                          var vname = data;    //get name
                          var t = v;           //get name


                          if (vname > 0)
                          {
                            $('#output').html("<b>You already inserted this month data.You can only update data.<a href='org_edit.php?month=" + t + "'>Please click here to update new datas.</a></b>"); //Set output element html
                            $('.widget-accordion').hide();
                          }
                          else {
                            $('#output').html("<b>You have not insert any data for this month. </b>"); //Set output element html
                            $('.widget-accordion').show();
                          }
                        }
                      });
                    });

                  }

                </script>   
              <? } ?> 

              <?php
              $previous_month = date('m-Y', strtotime('last month'));
              $previous_month_text = date('F-Y', strtotime('last month'));


              $current_month = date('m-Y');
              $current_month_text = date('F-Y');
              ?>
              <select name="answer_storage_month_year" id="answer_storage_month_year" onchange="toggle()">
                <option value="">==Select Month==</option>
                <option value="<?php echo $current_month; ?>"><?php echo $current_month_text; ?></option>
                <option value="<?php echo $previous_month; ?>"><?php echo $previous_month_text; ?></option>
                <option value="<?php echo '09-2013'; ?>"><?php echo 'September-2013'; ?></option>

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
                      $org = mysql_query("SELECT organization.org_name,admin_division.division_name, admin_district.district_name, admin_upazila.old_upazila_id,admin_upazila.upazila_name FROM organization
                    LEFT JOIN admin_division ON organization.division_code=admin_division.division_bbs_code
                    LEFT JOIN admin_district ON organization.district_code=admin_district.district_bbs_code
                    LEFT JOIN admin_upazila  ON organization.upazila_id=admin_upazila.old_upazila_id where organization.org_code='" . $org_code . "'");

                      $org_detail = mysql_fetch_array($org);
                      $upazila_id = $org_detail['old_upazila_id'];
                       //echo "<h1>$org_code<br><h1>";

                      if(checkIfOrgIsTartiary($org_code)) {
                        //echo "<h1>org is Tartiary<br><h1>";
                        include_once 'question_tertiray_org.php';
                      }else {
                        include_once 'question_org.php';
                      }
                      ?>
                      <div style="margin-left:5px;"><input type="submit" name="submit" value="Save" class="btn btn-primary"> </div>
                    </div>
                  </div>
                </div>
              </div>					
              </form>
            </div> <!-- /.widget-content -->
            <?php
            if (@$_POST['submit']) {
             if(checkIfOrgIsTartiary($org_code)) {
                //print_r($_POST);
                $exception_field = array('submit', 'param');
                $str = createMySqlInsertString($_POST, $exception_field);
                /*                 * *************************************************** */
                $str_k = $str['k'];
                $str_v = $str['v'];
                //print_r($str_k);
                //print_r($str_v);
                $sql = mysql_query("INSERT INTO hss_tertiary_answer_storage($str_k)values($str_v)");
                print "<script>";
                print " self.location=org.php"; // Comment this line if you don't want to redirect
                print "</script>";
              }                        
              else {
                //print_r($_POST);
                $exception_field = array('submit', 'param');
                $str = createMySqlInsertString($_POST, $exception_field);
                // echo '$str';
                /*                 * *************************************************** */
                $str_k = $str['k'];
                $str_v = $str['v'];
                $sql = mysql_query("INSERT INTO hss_answer_storage($str_k)values($str_v)");
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
