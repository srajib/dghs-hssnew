<?php	  include('lib/connect.php'); 
		  $answer_storage_org_id=$_REQUEST['org_id'];
		  $month=$_REQUEST['month'];
		  $org=mysql_query("SELECT * FROM hss_answer_storage WHERE answer_storage_org_id='$answer_storage_org_id' AND answer_storage_month_year='$month'");
		 
		   $cnt=mysql_num_rows($org);
		   $t=$month;
		   echo json_encode($cnt);
		   
		   

?>