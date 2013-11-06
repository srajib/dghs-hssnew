 <?php  include('lib/connect.php');
  $id =$_REQUEST['id'];
  mysql_query("DELETE FROM hss_forms WHERE form_id = '$id'")or die(mysql_error());  	
  print "<script>";
  print " self.location='add_forms.php'"; // Comment this line if you don't want to redirect
  print "</script>";
?>