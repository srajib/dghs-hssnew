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
 $q_id=$_REQUEST['question_id'];
 $org_code=$_SESSION['org_code'];
 $month=$_REQUEST['month'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		Form - Start uploading manually
	</title>
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
//                       echo "<pre>";
//                       print_r($mvcfile);
//                       echo "</pre>";
			//Moves the uploaded file to a new location.
			$mvcfile->MoveTo("uplodsImage/".$filepath);
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
   $file1='1_'.$path1;
   $file2='2_'.$path2;
   $file3='3_'.$path3;
   $sql=  mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence1='$file1',answer_storage_q".$q_id."_evidence2='$file2',answer_storage_q".$q_id."_evidence3='$file3' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'");
}
?>
				
	</div>
</body>
</html>