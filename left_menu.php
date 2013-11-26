
    <ul id="navigation" style="border:double; border-color:#AFDBFE;background-color:#EEF5FD" hieght="auto"> 
              <li><a href="cont_login.php?bd=<?php echo $bd; ?>">Bangladesh</a>
                <ul>
<?php
// tree part start
$tree = mysql_query("SELECT * from admin_division");
while ($row = mysql_fetch_array($tree)) {
  ?>
                    <li style="background-color:#EEF5FD"><a href="division_login.php?division_bbs_code=<?php echo $row['division_bbs_code']; ?>"><?php echo $row['division_name']; ?></a>
                      <ul>
                    <?php
                    $divid = $row['division_bbs_code'];
                    $dist = mysql_query("SELECT * FROM admin_district WHERE division_bbs_code='$divid'");
                    while ($rowdist = mysql_fetch_array($dist)) {
                      ?>
                          <li style="background-color:#EEF5FD"><a href="district_login.php?district_bbs_code=<?php echo $rowdist['district_bbs_code']; ?>"><?php echo $rowdist['district_name']; ?></a>
                            <ul>
                          <?php
                          $disid = $rowdist['old_district_id'];
                          $upo = mysql_query("SELECT * FROM admin_upazila WHERE old_district_id='$disid'");
                          while ($rowupo = mysql_fetch_array($upo)) {
                            
                            ?>
                               <li style="background-color:#EEF5FD"><a href="organization_summery.php?district_bbs_code=<?php echo $rowupo['upazila_district_code'];?>&&upazila_thana_code=<?php echo $rowupo['upazila_bbs_code'];?>"><?php echo $rowupo['upazila_name']; ?></a>
                               </li>
                             <!--  <li style="background-color:#EEF5FD"><?php echo $rowupo['upazila_name']; ?>-->

                                </li>
                              <?php } ?> </ul>
                          </li>
    <?php }
  ?>
                      </ul>
                    </li>
                        <?php }
                      ?>
                </ul>
              </li>
            </ul>