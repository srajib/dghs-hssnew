<?php
include('lib/connect.php');
//set where you want to store files
//in this example we keep file in folder upload
//$HTTP_POST_FILES['ufile']['name']; = upload file name
//for example upload file name cartoon.gif . $path will be upload/cartoon.gif
$q_id=$_REQUEST['question_id'];
$org_email=$_REQUEST['org_email'];
$month=$_REQUEST['month'];

if($_FILES['ufile']['type'][0]=='image/jpeg'){
$_FILES['ufile']['name'][0]='q_'.$q_id.'_'.$org_email.'_'.$month.'_1'.'.'.(substr($_FILES['ufile']['type'][0], -4));
}else
{
$_FILES['ufile']['name'][0]='q_'.$q_id.'_'.$org_email.'_'.$month.'_1'.'.'.(substr($_FILES['ufile']['type'][0], -3));
}
if($_FILES['ufile']['type'][1]=='image/jpeg'){
$_FILES['ufile']['name'][1]='q_'.$q_id.'_'.$org_email.'_'.$month.'_2'.'.'.(substr($_FILES['ufile']['type'][1], -4));
}else
{
$_FILES['ufile']['name'][1]='q_'.$q_id.'_'.$org_email.'_'.$month.'_2'.'.'.(substr($_FILES['ufile']['type'][1], -3));
}
if($_FILES['ufile']['type'][2]=='image/jpeg'){
$_FILES['ufile']['name'][2]='q_'.$q_id.'_'.$org_email.'_'.$month.'_3'.'.'.(substr($_FILES['ufile']['type'][2], -4));
}else
{
$_FILES['ufile']['name'][2]='q_'.$q_id.'_'.$org_email.'_'.$month.'_3'.'.'.(substr($_FILES['ufile']['type'][2], -3));
}
$path1= "upload/".$_FILES['ufile']['name'][0];
$path2= "upload/".$_FILES['ufile']['name'][1];
$path3= "upload/".$_FILES['ufile']['name'][2];

//copy file to where you want to store file
move_uploaded_file($_FILES['ufile']['tmp_name'][0], $path1);
move_uploaded_file($_FILES['ufile']['tmp_name'][1], $path2);
move_uploaded_file($_FILES['ufile']['tmp_name'][2], $path3);

//$_FILES['ufile']['name'] = file name
//$_FILES['ufile']['size'] = file size
//$_FILES['ufile']['type'] = type of file
echo "<img src=\"$path1\" width=\"150\" height=\"150\">";
echo "<P>";

echo "<img src=\"$path2\" width=\"150\" height=\"150\">";
echo "<P>";

echo "<img src=\"$path3\" width=\"150\" height=\"150\">";

///////////////////////////////////////////////////////

// Use this code to display the error or success.

$filesize1=$_FILES['ufile']['size'][0];
$filesize2=$_FILES['ufile']['size'][1];
$filesize3=$_FILES['ufile']['size'][2];

if($filesize1 && $filesize2 && $filesize3 != 0)
{

$file1=$_FILES['ufile']['name'][0];
$file2=$_FILES['ufile']['name'][1];
$file3=$_FILES['ufile']['name'][2];

$sql="UPDATE hss_answer_storage SET answer_storage_q".$q_id."_evidence1='$file1',answer_storage_q".$q_id."_evidence2='$file2',answer_storage_q".$q_id."_evidence3='$file3' where answer_storage_org_id='$org_email' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'"; 
//$sql="UPDATE hss_answer_storage SET $str where answer_storage_org_id='$org_email' AND answer_storage_month_year='$month' AND answer_storage_q".$q_id."='$q_id'"; 
mysql_query($sql);
echo "files uploaded successfully";
print "<script>";
print " self.location='org.php'"; // Comment this line if you don't want to redirect
print "</script>";
}
else {
echo "ERROR.....";
}

//echo "<pre>";
//print_r($sql);

//////////////////////////////////////////////

// What files that have a problem? (if found)

if($filesize1==0) {
echo "There're something error in your first file";
echo "<BR />";
}

if($filesize2==0) {
echo "There're something error in your second file";
echo "<BR />";
}

if($filesize3==0) {
echo "There're something error in your third file";
echo "<BR />";
}
?>

 