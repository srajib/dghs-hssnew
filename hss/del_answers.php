 <?php  include('lib/connect.php');
  $id =$_REQUEST['id'];
  mysql_query("DELETE FROM hss_answers WHERE answer_id = '$id'")or die(mysql_error());  	
  print "<script>";
  print " self.location='add_answers.php'"; // Comment this line if you don't want to redirect
  print "</script>";
?>