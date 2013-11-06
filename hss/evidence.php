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
<link href="./css/bootstrap-overrides.css" rel="stylesheet">
<link href="./css/bootstrap-responsive.css" rel="stylesheet">

<link href="./css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet">

<link href="./css/slate.css" rel="stylesheet">

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
			<div>Allowed file types: <span style="color:red">jpg, gif, png.</span></div>
                        <div>Allowed file Upload Limit: <span style="color:red">3 Files.</span></div>
                        <div>Allowed file Size: <span style="color:red">1 mb.</span></div>
			<!-- do not need enctype="multipart/form-data" -->
			<form id="form1" method="POST">
				<?php				
					$uploader=new PhpUploader();
					$uploader->MaxSizeKB=1024;
					$uploader->Name="myuploader";
					$uploader->InsertText="Select multiple files (Max 1M)";
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
        $i=1;
       
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
			//echo($mvcfile->FilePath);
			echo("</div>");
                        
//                        for($i=1;$i<4;$i++){
                        $mvcfile->FileName='q_'.$q_id.'_'.$org_code.'_'.$month.'_'.$i++.'.'.substr($mvcfile->FileName,- 3);
                        $filepath=$mvcfile->FileName;
                        array_push($myArray,$mvcfile->FileName);
                 
                        $mvcfile->MoveTo("upload/". $filepath);
                       
                      
                      //Copys the uploaded file to a new location.
			//$mvcfile->CopyTo("upload/".$filepath);
			//Deletes this instance.
			//$mvcfile->Delete();
		}
	}

     $datetime=date('Y-m-d - h:i:s ');
    
   $arvalue=implode(",",$myArray);
   
   $ex=explode(",",$arvalue);
   $file1=$ex[0]; 
   $file2=$ex[1];
   $file3=$ex[2];
  
  if(!empty($file1)){
   $sql=  mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence1='$file1',answer_storage_modified='$datetime' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id' ");
   }
   if(!empty($file2)){
    $sql=  mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence2='$file2',answer_storage_modified='$datetime' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'");   
   }
   if(!empty($file3)){
       
      $sql=  mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence3='$file3',answer_storage_modified='$datetime' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'");    
    
   }
   //$sql=  mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence1='$file1',answer_storage_q".$q_id."_evidence2='$file2',answer_storage_q".$q_id."_evidence3='$file3' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'");
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
