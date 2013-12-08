<?php
session_start();
//error_reporting(0);
include('lib/connect.php');
include('inc.functions.generic.php');


$bd = $_GET['bd'];
//$division_bbs_code=$_GET['division_bbs_code'];
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

    <script src="js/demos/charts/bar.js"></script>

    <link rel="stylesheet" href="treeview/jquery.treeview.css" />
    <link rel="stylesheet" href="treeview/screen.css" />

    <script src="treeview/lib/jquery.js" type="text/javascript"></script>
    <script src="treeview/lib/jquery.cookie.js" type="text/javascript"></script>
    <script src="treeview/jquery.treeview.js" type="text/javascript"></script>
    <script type="text/javascript" src="treeview/demo.js"></script>


    <!-- Javascript -->


    <script type="text/javascript">
      function validate() {
        var filevalue = document.getElementById("file").value;
        if (filevalue == "" || filevalue.length < 1) {
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
    <?php include('header_login.php');
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





          </ul>


          <ul class="nav pull-right">



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
          <?php require_once 'left_menu.php'; ?>
          </div> <!-- /.span3 -->
          <div class="spane6"> <h3> Divisional Summary Report of Bangladesh</h3>
            <p>
           
<?php require_once 'tbl.divisional_summary_report.php'; ?>      
              <table border="1px">
                <tr>
                      <th>Division</th><th>&nbsp;Sept&nbsp;&nbsp;&nbsp; Oct&nbsp;&nbsp;&nbsp;    Nov </th>
                </tr>
<?php

myprint_r($dataArray);

foreach ($dataArray as $district => $districtData) {
  echo "<tr id='$district'>";
  echo "<td>$district</td>";
  echo "<td>";
  echo "<table border='1px'>";
  echo "<tr>";
  foreach ($districtData as $year => $yearData) {
    if ($yearData['countTotal'] > 0) {
      $percentage = round(($yearData['countAnswered'] * 100) / $yearData['countTotal'], 1);
      echo "<td width='50' align='center'>$percentage%</td>";
    } else {
      $percentage = 0;
    }
  }
  echo "</tr>";
  echo "</table>";
  echo "</td>";
  echo "</tr>";
}
?>
              </table>          


<!--<table class="table">
<tr>
<td><strong>Total Summary</strong></td>
<td><strong><? echo " $sum_sept"; ?></strong></td> <td><strong><? echo " $sum_oct"; ?></strong></td><td>0</td><td>0</td>

</tr>
</table>-->

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
