<?php    
$org_code=$_SESSION['org_code'];
$org = mysql_query("SELECT org_name,org_code,id,org_type_code,email_address1
FROM organization where org_code='".$org_code."'");
$org_detail=mysql_fetch_array($org);
 $org_type=$org_detail['org_type_code']; 
 $org_code=$org_detail['org_code']; 
$org_id=$org_detail['id']; 
$user_email=$org_detail['email_address1'];

//echo "$org_type||$org_code||$org_id";
?>
 

<div id="header" >
	
	<div class="container" style="margin-top:10px" >			
		
		<div style="height:100px; width:500px;" class="span1"><img src="img/logo.png" style="height:80px; width:95px; border:none"><font style="font-family:'Arial Black', Gadget, sans-serif; font-size:25px;position:relative; bottom:15px; color:#CCC">Health System Strengthening </font><br>
<font style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:13px; left:98px; position:relative; bottom:40px; float:left; color:#CCC">Government of People's Republic of Bangladesh</font><br>
<font style="font-family:Arial, Helvetica, sans-serif; font-size:14px; left:95px; position:relative; bottom:42px;  color:#CCC"><b>Directorate General of Health Services</b></font></div>			
			
		
		<div  id="info">				
			
			<a href="javascript:;" id="info-trigger">
				<i class="icon-cog"></i>
			</a>
			
			<div class="span1" style="height:100px; width:710px;" id="info-menu" style="margin-left:100px;">
				
				<div class="span5" style="margin-left:100px;position:relative;" >
				
					<h5>Welcome to <?php echo $org_detail['org_name']; ?>.</h5>
			 		<p>
					<span>Logged in using <?php echo $user_email ;
					
						?>.</span>
						<br>
						 <a href="logout.php">Logout</a>
					</p>				
				</div> <!-- /.info-details -->
				
				 <!-- /.info-avatar -->
				
			</div> <!-- /#info-menu -->
			
		</div> <!-- /#info -->
		
	</div> <!-- /.container -->

</div> <!-- /#header -->

