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

 $upozilla_id=$_GET['upozilla_id'];
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
 <?php include('header.php'); ?>
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
					<a href="reporting_tartiary.php">
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
                                                 <li class="dropdown">
							<a href="tartiry_organization_summry.php">
								Organization Answer Report									
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
			
			
			<div class="span3">
			<ul id="navigation" style="border:double; border-color:#AFDBFE;background-color:#EEF5FD" hieght="auto"> 
		<li><a href="cont.php?bd=<?php echo $bd;?>">Bangladesh</a>
			<ul>
<?php
// tree part start
 $tree = mysql_query("SELECT * from admin_division");
 	
    while($row = mysql_fetch_array($tree))
    {
        ?>
                <li style="background-color:#EEF5FD"><a href="division_tartiary.php?division_id=<?php echo $row['division_bbs_code'];?>"><?php echo $row['division_name']; ?></a>
                        <ul>
                <?php
                 $divid = $row['division_bbs_code'];
                 $dist = mysql_query("SELECT * FROM admin_district WHERE division_bbs_code='$divid'");
                 while($rowdist = mysql_fetch_array($dist))
                { ?>
                     <li style="background-color:#EEF5FD"><a href="district_tartiary.php?district_id=<?php echo $rowdist['district_bbs_code']; ?>"><?php echo $rowdist['district_name']; ?></a>
                            <ul>
							<?php
							 $disid=$rowdist['old_district_id'];
				            $upo = mysql_query("SELECT * FROM admin_upazila WHERE old_district_id='$disid'");
							while($rowupo = mysql_fetch_array($upo)){
							?>
                                <li style="background-color:#EEF5FD"><a href="upozilla_tartiary.php?upozilla_id=<?php echo $rowupo['old_upazila_id']?> "><?php echo $rowupo['upazila_name']; ?></a>
								
								</li>
                               <?php }?> </ul>
               		  </li>
                    <?php
                }?>
                                </ul>
                        </li>
        <?php
    }?>
                </ul>
        </li>
    </ul>	
				
			</div> <!-- /.span3 -->
			<div class="spane6" > 
                            <div class="control-group" style="alignment-adjust: central"></div>
                            
			
			
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
