 <?php  include('lib/connect.php');
  $id =$_REQUEST['id'];
  mysql_query("DELETE FROM hss_question_type WHERE type_id = '$id'")or die(mysql_error());  	
  print "<script>";
  print " self.location='add_question_type.php'"; // Comment this line if you don't want to redirect
  print "</script>";
?>