<?php

include('lib/connect.php');
include('inc.functions.generic.php');

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
        <?php include('header_login.php'); ?>
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
                        <ul id="navigation" style="border:double; border-color:#AFDBFE;background-color:#EEF5FD" hieght="auto"> 
                            <li><a href="cont_login.php?bd=<?php echo $bd; ?>">Bangladesh</a>
                                <ul>
                                    <?php
                                    // tree part start
                                    $tree = mysql_query("SELECT * from admin_division");
                                    while ($row = mysql_fetch_array($tree)) {
                                        ?>
                                        <li style="background-color:#EEF5FD"><a href="division_login.php?division_bbs_code=<?php echo $row['division_bbs_code']; ?>"><?php echo $row['division_name']; ?></a>
                                            <ul>
                                                <?php
                                                $divid = $row['division_bbs_code'];
                                                $dist = mysql_query("SELECT * FROM admin_district WHERE division_bbs_code='$divid'");
                                                while ($rowdist = mysql_fetch_array($dist)) {
                                                    ?>
                                                    <li style="background-color:#EEF5FD"><a href="district_login.php?district_bbs_code=<?php echo $rowdist['district_bbs_code']; ?>"><?php echo $rowdist['district_name']; ?></a>
                                                        <ul>
                                                            <?php
                                                            $disid = $rowdist['old_district_id'];
                                                            $upo = mysql_query("SELECT * FROM admin_upazila WHERE old_district_id='$disid'");
                                                            while ($rowupo = mysql_fetch_array($upo)) {
                                                                ?>
                                                                <li style="background-color:#EEF5FD"><a href="organization_summery.php?upozilla_id=<?php echo $rowupo['old_upazila_id'] ?> "><?php echo $rowupo['upazila_name']; ?></a>

                                                                </li>
                                                            <?php } ?> </ul>
                                                    </li>
                                                <?php }
                                                ?>
                                            </ul>
                                        </li>
                                    <?php }
                                    ?>
                                </ul>
                            </li>
                        </ul>	
                    </div> <!-- /.span3 -->
                    <div class="spane6"> <h3> Divisional Summary Report of Bangladesh</h3>
                        <p>
                           <?php //include('tbl.divisional_summary_report.php')?>
                         <table border="1px">
                <tbody><tr>
                      <th>Division</th><th>&nbsp;Sept&nbsp;&nbsp;&nbsp; Oct&nbsp;&nbsp;&nbsp;    Nov </th>
                </tr>
<tr id="Dhaka"><td>Dhaka</td><td><table border="1px"><tbody><tr><td align="center" width="50">7.7%</td><td align="center" width="50">10%</td><td align="center" width="50">1.5%</td></tr></tbody></table></td></tr><tr id="Chittagong"><td>Chittagong</td><td><table border="1px"><tbody><tr><td align="center" width="50">12.9%</td><td align="center" width="50">22.9%</td><td align="center" width="50">5.9%</td></tr></tbody></table></td></tr><tr id="Rajshahi"><td>Rajshahi</td><td><table border="1px"><tbody><tr><td align="center" width="50">46.7%</td><td align="center" width="50">55.1%</td><td align="center" width="50">15%</td></tr></tbody></table></td></tr><tr id="Rangpur"><td>Rangpur</td><td><table border="1px"><tbody><tr><td align="center" width="50">9.1%</td><td align="center" width="50">8.1%</td><td align="center" width="50">0%</td></tr></tbody></table></td></tr><tr id="Khulna"><td>Khulna</td><td><table border="1px"><tbody><tr><td align="center" width="50">24.8%</td><td align="center" width="50">25.3%</td><td align="center" width="50">5.1%</td></tr></tbody></table></td></tr><tr id="Barisal"><td>Barisal</td><td><table border="1px"><tbody><tr><td align="center" width="50">20.7%</td><td align="center" width="50">27.6%</td><td align="center" width="50">9.5%</td></tr></tbody></table></td></tr><tr id="Sylhet"><td>Sylhet</td><td><table border="1px"><tbody><tr><td align="center" width="50">5.9%</td><td align="center" width="50">9.2%</td><td align="center" width="50">2.3%</td></tr></tbody></table></td></tr>              </tbody></table>          



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
