<?php
include('lib/connect.php');

 $q_id=$_REQUEST['question_id'];
 $org_code=$_REQUEST['org_code'];
 $month=$_REQUEST['month'];
 
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["ufile"]["name"]);
$extension = end($temp);
if ((($_FILES["ufile"]["type"] == "image/gif")
|| ($_FILES["ufile"]["type"] == "image/jpeg")
|| ($_FILES["ufile"]["type"] == "image/jpg"))
&& ($_FILES["ufile"]["size"] < 200000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["ufile"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["ufile"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["ufile"]["name"] . "<br>";
    echo "Type: " . $_FILES["ufile"]["type"] . "<br>";
    echo "Size: " . ($_FILES["ufile"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["ufile"]["tmp_name"] . "<br>";
    $_FILES['ufile']['name']='q_'.$q_id.'_'.$org_code.'_'.$month.'_1'.'.'.(substr($_FILES['ufile']['type'], -4));
   // $_FILES['ufile']['name'][1]='q_'.$q_id.'_'.$org_code.'_'.$month.'_2'.'.'.(substr($_FILES['ufile']['type'][1], -4));
    if (file_exists("upload/" . $_FILES["ufile"]["name"]))
      {
      echo $_FILES["ufile"]["name"] . " already exists. ";
      }
    else
      {
 
      move_uploaded_file($_FILES["ufile"]["tmp_name"][0],"upload/" . $_FILES["ufile"]["name"][0]);
      move_uploaded_file($_FILES["ufile"]["tmp_name"][1],"upload/" . $_FILES["ufile"]["name"][1]);
      echo "Stored in: " . "upload/" . $_FILES["ufile"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  
  }
  
  $file1=$_FILES['ufile']['name'];
  //$file2=$_FILES['ufile']['name'][1];
//     $file3=$_FILES['ufile']['name'][2];
  
 // $sql=mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence1='$file1',answer_storage_q".$q_id."_evidence2='$file2',answer_storage_q".$q_id."_evidence3='$file3' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'"); 
        //print_r($sql);
        $sql=mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence1='$file1' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'"); 
        //echo "files uploaded successfully";
//        print "<script>";
//        print " self.location='org.php'"; // Comment this line if you don't want to redirect
//        print "</script>";
?> 