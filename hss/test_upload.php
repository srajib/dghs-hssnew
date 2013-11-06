<?php
session_start();
//error_reporting(0);
include('lib/connect.php');
include('inc.functions.generic.php');
require_once "phpuploader/phpuploader/include_phpuploader.php" ;
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
 @$q_id=$_REQUEST['question_id'];
 @$org_code=$_REQUEST['org_code'];
 @$month=$_REQUEST['month'];

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
<link href="./css/bootstrap-overrides.css" rel="stylesheet">

<link href="./css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet">

<link href="./css/slate.css" rel="stylesheet">
<link href="./css/slate-responsive.css" rel="stylesheet">


<!-- Javascript -->
<link href="phpuploader/demo.css" rel="stylesheet" type="text/css" />
        			
	<script type="text/javascript">
	function doStart()
	{
		var uploadobj = document.getElementById('myuploader');
		if (uploadobj.getqueuecount() > 0)
		{
			uploadobj.startupload();
		}
		else
		{
			alert("Please browse files for upload");
		}
	}
	</script>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

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
                
			                         
    <div class="span6">   
        <div class="demo">
			<h2>Start uploading manually </h2>
			<P>Allowed file types: <span style="color:red">jpg, gif, png</span></p>

			<!-- do not need enctype="multipart/form-data" -->
			<form id="form1" method="POST">
				<?php				
					$uploader=new PhpUploader();
					$uploader->MaxSizeKB=10240;
					$uploader->Name="myuploader";
					$uploader->InsertText="Select multiple files (Max 10M)";
					$uploader->AllowedFileExtensions="*.jpg,*.png,*.gif";	
                                        $uploader->MaxFilesLimit=3;
					$uploader->MultipleFilesUpload=true;
					$uploader->ManualStartUpload=true;
					$uploader->Render();
				?>
				<br /><br /><br />
				<button id="submitbutton" onclick="doStart();return false;">Start Uploading Files</button>

			</form>
			
			<br/><br/><br/>
<?php
$fileguidlist=@$_POST["myuploader"];
if($fileguidlist)
{
	$guidlist=explode("/",$fileguidlist);
	echo("<div style='font-family:Fixedsys;'>");
	echo("Uploaded ");
	echo(count($guidlist));
	echo(" files:");
	echo("</div>");
	echo("<hr/>");
	$myArray = array();
       
	foreach($guidlist as $fileguid)
	{
		 $mvcfile=$uploader->GetUploadedFile($fileguid);
               
		if($mvcfile)
		{
                    
			echo("<div style='font-family:Fixedsys;border-bottom:dashed 1px gray;padding:6px;'>");
			echo("FileName: ");
			echo($mvcfile->FileName);
			echo("<br/>FileSize: ");
			echo($mvcfile->FileSize." b");
	//		echo("<br/>FilePath: ");
	//		echo($mvcfile->FilePath);
			echo("</div>");
                        $mvcfile->FileName='q_'.$q_id.'_'.$org_code.'_'.$month.''.substr($mvcfile->FileName, strpos($mvcfile->FileName, '.'), strlen($mvcfile->FileName) - 1);
                        $filepath=$mvcfile->FileName;
                        array_push($myArray,$mvcfile->FileName);
//                      
			//Moves the uploaded file to a new location.
			$mvcfile->MoveTo("upload/".$filepath);
                      //Copys the uploaded file to a new location.
			//$mvcfile->CopyTo("/uploads");
			//Deletes this instance.
			//$mvcfile->Delete();
		}
                
	}
        
    
   $arvalue=implode(",",$myArray);
   
   $ex=explode(",",$arvalue);
   $path1=$ex[0]; 
   $path2=$ex[1];
   $path3=$ex[2];
   $file1=$path1;
   $file2=$path2;
   $file3=$path3;
   if(!empty($file1)){
   $sql=  mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence1='$file1' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'");
   echo "Uploded Successfully file1";
   }
   if(!empty($file2)){
    $sql=  mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence2='$file2' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'");   
    echo "Uploded Successfully file2";  
   }
   if(!empty($file3)){
       
      $sql=  mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence3='$file3' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'");    
      echo "Uploded Successfully file3"; 
   }
}
?>
				
	</div>
    </div>
    
</div> <!-- /.span6 -->
					
                </div><!--row -->
	</div> <!-- /.container -->


<div id="footer">	
		
	<div class="container">
		
		&copy; 2013 MIS, DGHS, All rights reserved.
		
	</div> <!-- /.container -->		
	
</div> <!-- /#footer -->





  </body>
</html>
