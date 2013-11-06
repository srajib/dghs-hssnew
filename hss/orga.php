<?php
include('lib/connect.php');
$org = $_GET['p'];


echo '<table class="table table-striped table-bordered table-highlight" id="example" width="90%" style="padding-left:10px">
		<thead>
			<tr>
				<th width="50px"><b>Org. Code</b></th>
				<th width="220px"><b>Organization Name</b></th>
				<th width="150px"><b>Organization Type</b></th>
				<th width="90px"><b>Division</b></th>
				<th width="90px"><b>District</b></th>
				<th width="110px"><b>Upazila</b></th>
				<th width="50px"><b>Action</b></th>
				
			</tr>
		</thead>
		<tbody>';

if($org != "")
{							
	$orga = mysql_query("SELECT * FROM organizations WHERE title LIKE '%$org%' LIMIT 100");
	while($row = mysql_fetch_array($orga))
	{
		echo '<tr>
									<td align="center">'.$row['organization_code'].'</td>
                                    <td align="center">'.$row['title'].'</td>';
                                    
									$type = $row['org_type_id'];
									$tp = mysql_query("SELECT * FROM org_types WHERE type_id='$type'");
									$rowtp = mysql_fetch_assoc($tp);
									echo '<td align="center">'.$rowtp['name'].'</td>';
                                    $div = $row['division_code'];
									$dv = mysql_query("SELECT * FROM divisions WHERE division_id='$div'");
									$rowdv = mysql_fetch_assoc($dv);
									echo '<td align="center">'.$rowdv['name'].'</td>';
                                    $dis = $row['district_code'];
									$ds = mysql_query("SELECT * FROM districts WHERE district_id='$dis'");
									$rowds = mysql_fetch_assoc($ds);
									echo '<td align="center">'.$rowds['name'].'</td>';
                                    $up = $row['upazila_code'];
									if($up == 0)
									{
										$upaz = "Not Found";
									}else{
										$upa = mysql_query("SELECT * FROM upazillas WHERE upazilla_id='$up'");
										$rowupa = mysql_fetch_assoc($upa);
										$upaz = $rowupa['name'];
									}
									echo '<td align="center">'.$upaz.'</td>
                                    <td align="center"><a href="details.php?id='.$row['organization_id'].'"><img src="images/edit.png" height="15px" width="15px"></a>&nbsp;&nbsp;&nbsp;<img src="images/delete.png" height="15px" width="15px"></td>
								</tr>';
	}
}
else
{
	echo '<tr><td colspan="7">No Data Found</td></tr>';
}

echo '</tbody>
	</table>';
?>