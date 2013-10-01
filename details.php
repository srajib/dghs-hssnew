<?php
session_start();
include('lib/connect.php');
if(empty($_SESSION['loginid']))
{
	print "<script>";
	print " self.location='index.php'"; // Comment this line if you don't want to redirect
	print "</script>";
}

if($_SESSION['loginid'] >= 3)
{
	print "<script>";
	print " self.location='org.php'"; // Comment this line if you don't want to redirect
	print "</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Organization Details | Admin Login</title>

<!-- Styles -->
<link href="./css/bootstrap.css" rel="stylesheet">
<link href="./css/bootstrap-responsive.css" rel="stylesheet">
<link href="./css/bootstrap-overrides.css" rel="stylesheet">

<link href="./css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet">

<link href="./css/slate.css" rel="stylesheet">
<link href="./css/slate-responsive.css" rel="stylesheet">  

<!-- Javascript -->
<script src="./js/jquery-1.7.2.min.js"></script>
<script src="./js/jquery-ui-1.8.21.custom.min.js"></script>
<script src="./js/jquery.ui.touch-punch.min.js"></script>
<script src="./js/bootstrap.js"></script>

<script src="./js/Slate.js"></script>






<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>
 	
  	
<div id="header">
	
	<div class="container">			
		
		<div style="height:100px; width:auto;"><img src="img/logo.png" style="height:80px; width:95px; border:none"><font style="font-family:'Arial Black', Gadget, sans-serif; font-size:25px;position:relative; bottom:15px; color:#CCC">Organization Registry Admin Panel</font><br>
<font style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:13px; left:95px; position:relative; bottom:40px; float:left; color:#CCC">Government of People's Republic of Bangladesh</font><br>
<font style="font-family:Arial, Helvetica, sans-serif; font-size:15px; left:95px; position:relative; bottom:42px;  color:#CCC"><b>Directorate General of Health Services</b></font></div>			
		
		<div id="info">				
			
			<a href="javascript:;" id="info-trigger">
				<i class="icon-cog"></i>
			</a>
			
			<div id="info-menu">
				
				<div class="info-details">
				
					<h4>Welcome, logged in as <font color="orange"><?php echo $_SESSION['email']; ?></font>.</h4>
					
					<p>
						
						<br>
						Click to <a href="logout.php">Logout</a>
					</p>
					
				</div> <!-- /.info-details -->
				
				
				
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
			
			<ul class="nav" style="float:left; position:relative">
		
				<!--<li class="nav-icon">
					<a href="./">
						<i class="icon-home"></i>
						<span>Home</span>
					</a>	    				
				</li>
				
				<li class="dropdown active">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-th"></i>
						Components
						<b class="caret"></b>
					</a>	
				
					<ul class="dropdown-menu">
						<li><a href="./forms.html">Forms</a></li>
						<li><a href="./ui-elements.html">UI Elements</a></li>
						<li><a href="./grid.html">Grid Layout</a></li>
						<li><a href="./tables.html">Tables</a></li>
						<li><a href="./widgets.html">Widget Boxes</a></li>
						<li><a href="./charts.html">Charts</a></li>
						<li><a href="./tabs.html">Tabs & Accordion</a></li>
						<li><a href="./buttons.html">Buttons</a></li>
					</ul>    				
				</li>
				
				<li class="dropdown">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-copy"></i>
						Sample Pages
						<b class="caret"></b>
					</a>	
				
					<ul class="dropdown-menu">
						<li><a href="./invoice.html">Invoice</a></li>
						<li><a href="./faq.html">FAQ</a></li>
						<li><a href="./pricing.html">Pricing Plans</a></li>
						<li><a href="./gallery.html">Image Gallery</a></li>
						<li><a href="./wizard.html">Wizard</a></li>
						<li><a href="./reports.html">Reports</a></li>
						<li><a href="./calendar.html">Calendar</a></li>
					</ul>    				
				</li>
				
				<li class="dropdown">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-external-link"></i>
						Other Pages
						<b class="caret"></b>
					</a>	
				
					<ul class="dropdown-menu">							
						<li><a href="./login.html">Login</a></li>
						<li><a href="./signup.html">Signup</a></li>
						<li><a href="./error.html">Error</a></li>
						<li class="dropdown">
							<a href="javascript:;">
								Dropdown Menu									
								<i class="icon-chevron-right sub-menu-caret"></i>
							</a>
							
							<ul class="dropdown-menu sub-menu">
		                        <li><a href="javascript:;">Dropdown #1</a></li>
		                        <li><a href="javascript:;">Dropdown #2</a></li>
		                        <li><a href="javascript:;">Dropdown #3</a></li>
		                        <li><a href="javascript:;">Dropdown #4</a></li>
		                    </ul>
						</li>
					</ul>    				
				</li>-->
				
				
			
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
			    <a href="admin.php">Home</a> <span class="divider">/</span>
			  </li>
			  <li class="active">
			    <a href="#">Organization Details</a>
			  </li>
			  
			</ul>
			<?php
			extract($_POST);
			
			echo $orgcode;
			if(isset($_POST['save']))
			{
				$orgid = $_GET['id'];
				$sql = mysql_query("UPDATE organizations SET organization_code='$code',title='$orgname',agencie_code='$agency',division_code='$division',district_code='$district',upazila_code='$upazila',union_code='$union',email='$em1',contact_no='$mob1',org_type_id='$type',org_func_id='$function',org_level_id='$level',ownership_id='$owner',lat='$lat',log='$long',fax='$fax1' WHERE organization_id='$orgid'");
				if($sql)
				{
					$conf = '<div class="alert alert-success">
						  <a class="close" data-dismiss="alert" href="#">&times;</a>
						  <h4 class="alert-heading">Success!</h4>
						  Organization information saved successfully.
						</div>';
						
						//echo "<meta http-equiv='refresh' content='5; url=admin.php'>";
				}
				else
				{
					$conf = '<div class="alert alert-error">
						  <a class="close" data-dismiss="alert" href="#">&times;</a>
						  <h4 class="alert-heading">Error!</h4>
						  Organization information could not be saved.
						</div>';
				}
			}
			else
			{
				$conf = '';
			}
			
			?>
			
		</div> <!-- /.page-title -->
	
<form name="save" id="save" method="post" action="details.php?id=<?php echo $_GET['id']; ?>">		
		
		<div class="row">
			
			<div class="span12">
	      		
	      		<div class="widget nopad">
	      			
	      			<div class="widget-header">
	      				<h3 align="center">Details Information of <em><b><?php
						$org = $_GET['id'];
						$org1 = mysql_query("SELECT * FROM organizations WHERE organization_id='$org'");
						//$count = mysql_num_rows($org1);
						
						$rorg1 = mysql_fetch_assoc($org1);
						echo $rorg1['title']; ?></b></em></h3>	      				
      				</div> <!-- /.widget-header -->
                   
					
                    
					<div class="widget-content">
						
                    <table border="0" width="100%">
                    <tr>
                    <td width="45%" align="left" valign="top">
                    <?php
					$url ="http://app.dghs.gov.bd/dghshrm/uploads/";			
						   $path =$url.$rorg1['email'].'.jpg';
						   $imgurl_check = $path;
							if (!is_array(@getimagesize($imgurl_check)))
							{ ?>
							<img src="img/no_image.gif" style="padding-left:10px; padding-top:30px">
							<?php
                            }
                            else
                            {
							?>
							<img src ="<?php echo $url.$rorg1['email'].'.jpg';?>" width="500" height="300"  style="padding-left:10px; padding-top:30px"/>
							<?php
							}
							?>
                    <!--<img src="img/no_image.gif" style="padding-top:30px; padding-left:20px">-->
                    </td>
                    <td width="55%" valign="top">
                    <?php echo $conf; ?>
                    <div class="tabbable" style="padding-left:10px; padding-top:30px">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab1" data-toggle="tab"><b>Basic & Ownership Info</b></a></li>
								<li><a href="#tab2" data-toggle="tab"><b>Location Info</b></a></li>
								<li><a href="#tab3" data-toggle="tab"><b>Contact Info</b></a></li>
                                <li><a href="#tab4" data-toggle="tab"><b>Facility Info</b></a></li>
                                <li><a href="#tab5" data-toggle="tab"><b>Additional Info</b></a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab1">
									<p>
                                    <ul>
										<li style="font-size:14px; line-height:35px">Organization name:<input type="text" name="orgname" value="<?php echo $rorg1['title']; ?>"></li> 
                                        <li style="font-size:14px; line-height:35px">Organization Code:<input type="text" name="code" value="<?php echo $rorg1['organization_code']; ?>"></li> 
                                        <li style="font-size:14px; line-height:35px">Organization Type: 
                                        <select id="type" name="type">
                                        <option value="">--Select Type--</option>
                                         <?php
										 $type = mysql_query("SELECT * FROM org_types ORDER BY type_name");
										 while($rowtype = mysql_fetch_array($type))
										 {
											 $s1 = "";
											 $t = $rorg1['org_type_id'];
											 if($rorg1['org_type_id'] == $rowtype['type_id'])
											 {
												 $s1 = "selected";
											 }
										 ?>
                                            <option value="<?php echo $rowtype['type_id']; ?>" <?php echo $s1; ?>><?php echo $rowtype['type_name']; ?></option>
                                         <?php
										 }
										 ?>
                                         </select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Agency Name:
                                        <select id="agency" name="agency">
                                        <option value="">--Select Agency--</option>
                                         <?php
										 $age = mysql_query("SELECT * FROM agency_code ORDER BY agency");
										 while($rowage = mysql_fetch_array($age))
										 {
											 $s2 = "";
											 if($rorg1['agencie_code'] == $rowage['id'])
											 {
												 $s2 = "selected";
											 }
										 ?>
                                            <option value="<?php echo $rowage['id']; ?>" <?php echo $s2; ?>><?php echo $rowage['agency']; ?></option>
                                         <?php
										 }
										 ?></select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Functional Name:
                                        <select id="function" name="function">
                                         <option value="">--Select Function--</option>
                                         <?php
										 $fun = mysql_query("SELECT * FROM organizational_function ORDER BY org_function");
										 while($rowfun = mysql_fetch_array($fun))
										 {
											 $s3 = "";
											 if($rorg1['org_func_id'] == $rowfun['id'])
											 {
												 $s3 = "selected";
											 }
										 ?>
                                            <option value="<?php echo $rowfun['id']; ?>" <?php echo $s3; ?>><?php echo $rowfun['org_function']; ?></option>
                                         <?php
										 }
										 ?>
                                          </select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Ownership:
                                        <select id="owner" name="owner">
                                         <option value="">--Select Ownership--</option>
                                         <?php
										 $own = mysql_query("SELECT * FROM ownership_type ORDER BY ownership");
										 while($rowown = mysql_fetch_array($own))
										 {
											 $s4 = "";
											 if($rorg1['ownership_id'] == $rowown['id'])
											 {
												 $s4 = "selected";
											 }
										 ?>
                                            <option value="<?php echo $rowown['id']; ?>" <?php echo $s4; ?>><?php echo $rowown['ownership']; ?></option>
                                         <?php
										 }
										 ?>
                                          </select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Organization Level:
                                        <select id="level" name="level">
                                         <option value="">--Select Level--</option>
                                         <?php
										 $lev = mysql_query("SELECT * FROM org_level ORDER BY level");
										 while($rowlev = mysql_fetch_array($lev))
										 {
											 $s5 = "";
											 if($rorg1['org_level_id'] == $rowlev['id'])
											 {
												 $s5 = "selected";
											 }
										 ?>
                                            <option value="<?php echo $rowlev['id']; ?>" <?php echo $s5; ?>><?php echo $rowlev['level']; ?></option>
                                         <?php
										 }
										 ?>
                                          </select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Health Care Level:
                                        <select id="hlevel" name="hlevel">
                                         <option value="">--Select Level--</option>
                                         <?php
										 $h = mysql_query("SELECT * FROM h_care ORDER BY level");
										 while($rowh = mysql_fetch_array($h))
										 {
										 ?>
                                            <option value="<?php echo $rowh['id']; ?>"><?php echo $rowh['level']; ?></option>
                                         <?php
										 }
										 ?>
                                          </select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Year Established:<input type="text" name="year"></li>
                                        <li style="font-size:14px; line-height:35px"i>Urban/rural location:&nbsp;&nbsp;<input type="radio" name="urban">Urban Location&nbsp;&nbsp;<input type="radio" name="urban">Rural Location</li>
                                        <li style="font-size:14px; line-height:35px">Financial (revenue) code for Govt. Org.:<input type="text" name="orgcode"> (If applicable)</li> 
                                                                             </ul>
									</p>
								</div>
								<div class="tab-pane" id="tab2">
									<p>
									<ul>
                                    <li style="font-size:14px; line-height:35px">Division:
                                         <select id="division" name="division">
                                         <option value="">--Select Division--</option>
                                         <?php
										 $div = mysql_query("SELECT * FROM divisions ORDER BY name");
										 while($rowdiv = mysql_fetch_array($div))
										 {
											 $s6 = "";
											 if($rorg1['division_code'] == $rowdiv['division_id'])
											 {
												 $s6 = "selected";
											 }
										 ?>
                                            <option value="<?php echo $rowdiv['division_id']; ?>" <?php echo $s6; ?>><?php echo $rowdiv['name']; ?></option>
                                         <?php
										 }
										 ?>
                                          </select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">District:
                                         <select id="district" name="district">
                                         <option value="">--Select District--</option>
                                         <?php
										 $dis = mysql_query("SELECT * FROM districts ORDER BY name");
										 while($rowdis = mysql_fetch_array($dis))
										 {
											 $s7 = "";
											 if($rorg1['district_code'] == $rowdis['district_id'])
											 {
												 $s7 = "selected";
											 }
										 ?>
                                            <option value="<?php echo $rowdis['district_id']; ?>" <?php echo $s7; ?>><?php echo $rowdis['name']; ?></option>
                                         <?php
										 }
										 ?>
                                          </select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Upazila:
                                         <select id="upazila" name="upazila">
                                         <option value="">--Select Upazila--</option>
                                         <?php
										 $upa = mysql_query("SELECT * FROM upazillas ORDER BY name");
										 while($rowupa = mysql_fetch_array($upa))
										 {
											 $s8 = "";
											 if($rorg1['upazila_code'] == $rowupa['upazilla_id'])
											 {
												 $s8 = "selected";
											 }
										 ?>
                                            <option value="<?php echo $rowupa['upazilla_id']; ?>" <?php echo $s8; ?>><?php echo $rowupa['name']; ?></option>
                                         <?php
										 }
										 ?>
                                          </select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Union Code/Pourashava Code:
                                        <select id="union" name="union">
                                        <option value="">--Select Union/Pourashava--</option>
                                         <?php
										 $un = mysql_query("SELECT * FROM unions ORDER BY name");
										 while($rowun = mysql_fetch_array($un))
										 {
											 $s9 = "";
											 if($rorg1['union_code'] == $rowun['union_id'])
											 {
												 $s9 = "selected";
											 }
										 ?>
                                            <option value="<?php echo $rowun['union_id']; ?>" <?php echo $s9; ?>><?php echo $rowun['name']; ?></option>
                                         <?php
										 }
										 ?>
                                          </select>
                                        </li>
                                        
                                        <li style="font-size:14px; line-height:35px">Village/ Street:<input type="text" name="vill">(If Applicable)</li>
                                        <li style="font-size:14px; line-height:35px">House No.:<input type="text" name="house">(If Applicable)</li>
                                        <li style="font-size:14px; line-height:35px">Longitude:<input type="text" name="long" value="<?php echo $rorg1['log']; ?>"></li>
                                        <li style="font-size:14px; line-height:35px">Latitude:<input type="text" name="lat" value="<?php echo $rorg1['lat']; ?>"></li>
                                        <li style="font-size:14px; line-height:35px">Land Size(in acre):<input type="text" name="lsize"></li>
                                        <li style="font-size:14px; line-height:35px">Mouza Name:<input type="text" name="mounam"></li>
                                        <li style="font-size:14px; line-height:35px">Geocode of Mouza:<input type="text" name="geomou"></li>
                                        <li style="font-size:14px; line-height:35px">JL No.:<input type="text" name="jl"></li>
                                        <li style="font-size:14px; line-height:35px">SS Dag No.:<input type="text" name="ss"></li>
                                        <li style="font-size:14px; line-height:35px">RS Dag No.:<input type="text" name="rs"></li>
                                        <li style="font-size:14px; line-height:35px">Khatian No.:<input type="text" name="kha"></li>
                                        <li style="font-size:14px; line-height:35px">Mutation No.:<input type="text" name="muta"></li>

                                    </ul>
									</p>
								</div>
								<div class="tab-pane" id="tab3">
									<p>
									<ul>
                                    	<li style="font-size:14px; line-height:35px">Mailing Address/Postal Address: <input type="text" name="postal"></li>
                                        <li style="font-size:14px; line-height:35px">Land Phone1: <input type="text" name="land1"></li>
                                        <li style="font-size:14px; line-height:35px">Land Phone2: <input type="text" name="land2"></li>
                                        <li style="font-size:14px; line-height:35px">Land Phone3: <input type="text" name="land3"></li>
                                        <li style="font-size:14px; line-height:35px">Mobile Phone1: <input type="text" name="mob1" value="<?php echo $rorg1['contact_no']; ?>"></li>
                                        <li style="font-size:14px; line-height:35px">Mobile Phone2: <input type="text" name="mob2"></li>
                                        <li style="font-size:14px; line-height:35px">Mobile Phone3: <input type="text" name="mob3"></li>
                                        <li style="font-size:14px; line-height:35px">Fax Number1: <input type="text" name="fax1" value="<?php echo $rorg1['fax']; ?>"></li>
                                        <li style="font-size:14px; line-height:35px">Fax Number2: <input type="text" name="fax2"></li>
                                        <li style="font-size:14px; line-height:35px">Fax Number3: <input type="text" name="fax3"></li>
                                        <li style="font-size:14px; line-height:35px">Email1: <input type="text" name="em1" value="<?php echo $rorg1['email']; ?>"></li>
                                        <li style="font-size:14px; line-height:35px">Email2: <input type="text" name="em2"></li>
                                        <li style="font-size:14px; line-height:35px">Email3: <input type="text" name="em3"></li>
                                        <li style="font-size:14px; line-height:35px">Website1: <input type="text" name="web1"></li>
                                        <li style="font-size:14px; line-height:35px">Website2: <input type="text" name="web2"></li>
                                        <li style="font-size:14px; line-height:35px">Website3: <input type="text" name="web3"></li>
                                        <li style="font-size:14px; line-height:35px">Facebook: <input type="text" name="fb"></li>
                                        <li style="font-size:14px; line-height:35px">Google+: <input type="text" name="goo"></li>
                                        <li style="font-size:14px; line-height:35px">Twitter: <input type="text" name="twt"></li>
                                        <li style="font-size:14px; line-height:35px">Youtube: <input type="text" name="yt"></li>
                                    </ul>	
									</p>
								</div>
                                <div class="tab-pane" id="tab4">
									<p>
									<ul>
                                    	<li style="font-size:14px; line-height:35px">Main Source of Electricity: 
                                        <select id="select01">
                                        <option value="">--Select Source--</option>
                                         <?php
										 $ele = mysql_query("SELECT * FROM main_elect ORDER BY source");
										 while($rowele = mysql_fetch_array($ele))
										 {
										 ?>
                                            <option value="<?php echo $rowele['id']; ?>"><?php echo $rowele['source']; ?></option>
                                         <?php
										 }
										 ?></select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Alternet Source of Electricity: 
                                        <select id="select01">
                                        <option value="">--Select Source--</option>
                                         <?php
										 $elea = mysql_query("SELECT * FROM alter_elect ORDER BY source");
										 while($rowelea = mysql_fetch_array($elea))
										 {
										 ?>
                                            <option value="<?php echo $rowelea['id']; ?>"><?php echo $rowelea['source']; ?></option>
                                         <?php
										 }
										 ?></select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Main Source of Water: 
                                        <select id="select01">
                                        <option value="">--Select Source--</option>
                                         <?php
										 $wat = mysql_query("SELECT * FROM main_water ORDER BY source");
										 while($rowwat = mysql_fetch_array($wat))
										 {
										 ?>
                                            <option value="<?php echo $rowwat['id']; ?>"><?php echo $rowwat['source']; ?></option>
                                         <?php
										 }
										 ?></select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Alternet Source of Water: 
                                        <select id="select01">
                                        <option value="">--Select Source--</option>
                                         <?php
										 $wata = mysql_query("SELECT * FROM alter_water ORDER BY source");
										 while($rowwata = mysql_fetch_array($wata))
										 {
										 ?>
                                            <option value="<?php echo $rowwata['id']; ?>"><?php echo $rowwata['source']; ?></option>
                                         <?php
										 }
										 ?></select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Toilet Type: 
                                        <select id="select01">
                                        <option value="">--Select Type--</option>
                                         <?php
										 $toi = mysql_query("SELECT * FROM toil_type ORDER BY type");
										 while($rowtoi = mysql_fetch_array($toi))
										 {
										 ?>
                                            <option value="<?php echo $rowtoi['id']; ?>"><?php echo $rowtoi['type']; ?></option>
                                         <?php
										 }
										 ?></select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Toilet Adequacy: 
                                        <select id="select01">
                                        <option value="">--Select Adequacy--</option>
                                         <?php
										 $ade = mysql_query("SELECT * FROM toil_ade ORDER BY adequacy");
										 while($rowade = mysql_fetch_array($ade))
										 {
										 ?>
                                            <option value="<?php echo $rowade['id']; ?>"><?php echo $rowade['adequacy']; ?></option>
                                         <?php
										 }
										 ?></select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Fuel Source: 
                                        <select id="select01" multiple>
                                        <option value="">--Select Source--</option>
                                         <?php
										 $fuel = mysql_query("SELECT * FROM fuel_source ORDER BY source");
										 while($rowfuel = mysql_fetch_array($fuel))
										 {
										 ?>
                                            <option value="<?php echo $rowfuel['id']; ?>"><?php echo $rowfuel['source']; ?></option>
                                         <?php
										 }
										 ?></select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Laundry: 
                                        <select id="select01" multiple>
                                        <option value="">--Select Laundry--</option>
                                         <?php
										 $lau = mysql_query("SELECT * FROM laundry ORDER BY id");
										 while($rowlau = mysql_fetch_array($lau))
										 {
										 ?>
                                            <option value="<?php echo $rowlau['id']; ?>"><?php echo $rowlau['system']; ?></option>
                                         <?php
										 }
										 ?></select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Autoclave: 
                                        <select id="select01" multiple>
                                        <option value="">--Select Autoclave--</option>
                                         <?php
										 $aut = mysql_query("SELECT * FROM autoclave ORDER BY id");
										 while($rowaut = mysql_fetch_array($aut))
										 {
										 ?>
                                            <option value="<?php echo $rowaut['id']; ?>"><?php echo $rowaut['name']; ?></option>
                                         <?php
										 }
										 ?></select>
                                        </li>
                                        <li style="font-size:14px; line-height:35px">Waste Disposal: 
                                        <select id="select01" multiple>
                                        <option value="">--Select Disposal--</option>
                                         <?php
										 $was = mysql_query("SELECT * FROM waste_disp ORDER BY name");
										 while($rowwas = mysql_fetch_array($was))
										 {
										 ?>
                                            <option value="<?php echo $rowwas['id']; ?>"><?php echo $rowwas['name']; ?></option>
                                         <?php
										 }
										 ?></select>
                                        </li>
                                    </ul>
									</p>
								</div>
                                <div class="tab-pane" id="tab5">
									<p>
									<ul>
                                    	<li style="font-size:14px; line-height:35px">Sanctioned Vehicles: <input type="text" name="lat"></li>
                                        <li style="font-size:14px; line-height:35px">Sanctioned Office Equipment: <input type="text" name="lat"></li>
                                        <li style="font-size:14px; line-height:35px">Other Misc. Issues: <textarea name="misc" wrap="virtual" ></textarea></li>
                                        <li style="font-size:14px; line-height:35px">Additional Info.: <textarea name="misc" wrap="virtual" ></textarea></li>
                                        
                                    </ul>
									</p>
								</div>
							</div>
						</div>
                    </td>
                    </tr>
                    </table>    
                     <div class="form-actions" style="float:right;">
					            <button type="submit" class="btn btn-primary btn-large" name="save">Save changes</button>
					            <button class="btn btn-large">Cancel</button>
					          </div>
   
</div>
</div>
						
</form>						
						
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->	
								
		    </div> <!-- /span6 -->
		    
</div> <!-- /row -->
		
		
		
		
	</div> <!-- /.container -->
	
</div> <!-- /#content -->


<div id="footer">	
		
	<div class="container">
		
		&copy; 2012 Propel UI, all rights reserved.
		
	</div> <!-- /.container -->		
	
</div> <!-- /#footer -->





  </body>
</html>


