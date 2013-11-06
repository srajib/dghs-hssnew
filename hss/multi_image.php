<?php
include('lib/connect.php');

 $q_id=$_REQUEST['question_id'];
 $org_code=$_REQUEST['org_code'];
 $month=$_REQUEST['month'];


if($_FILES['ufile']['type'][0]=='image/jpeg') {
   
    $_FILES['ufile']['name'][0]='q_'.$q_id.'_'.$org_code.'_'.$month.'_1'.'.'.(substr($_FILES['ufile']['type'][0], -4));
    $path1= "upload/".$_FILES['ufile']['name'][0];
    move_uploaded_file($_FILES['ufile']['tmp_name'][0], $path1);
    $file1=$_FILES['ufile']['name'][0];
    $sql=mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence1='$file1' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'"); 
}else
  {
  echo "File1 Format is incorrect, pls upload JPG file ";
  
  }
if($_FILES['ufile']['type'][1]=='image/jpeg'){
$_FILES['ufile']['name'][1]='q_'.$q_id.'_'.$org_code.'_'.$month.'_2'.'.'.(substr($_FILES['ufile']['type'][1], -4));
$path2= "upload/".$_FILES['ufile']['name'][1];
move_uploaded_file($_FILES['ufile']['tmp_name'][1], $path2);
$file2=$_FILES['ufile']['name'][1];
$sql=mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence2='$file2' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'"); 
}  else
  {
  echo "File2 Format is incorrect, pls upload JPG file . ";
  
  }
if($_FILES['ufile']['type'][2]=='image/jpeg'){
    
 $_FILES['ufile']['name'][2]='q_'.$q_id.'_'.$org_code.'_'.$month.'_3'.'.'.(substr($_FILES['ufile']['type'][2], -4));
  $path3= "upload/".$_FILES['ufile']['name'][2];
  move_uploaded_file($_FILES['ufile']['tmp_name'][2], $path3);
  
  $file3=$_FILES['ufile']['name'][2];
  $sql=mysql_query("UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence3='$file3' where answer_storage_org_id='$org_code' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'"); 
}
else
  {
  echo "File3 Format is incorrect, pls upload JPG file. ";
  
  }


?>

 