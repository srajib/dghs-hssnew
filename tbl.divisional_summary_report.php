<?php

session_start();
//error_reporting(-1);
require_once 'lib/connect.php';
require_once 'inc.functions.generic.php';
require_once 'inc.function.temp.php';
//error_reporting(E_ALL);
//ini_set('display_errors','On');

$startmonth = 9;
$endmonth = 12;
$startyear = 2013;
$endyear = 2013;

$dataArray = array();
$answersToBeCountedArray = array('Yes');
$divisions = getDivisions();
//myprint_r($divisions);

foreach ($divisions as $division) {
    $orgs = getAllOrgUnderDivision($division['division_bbs_code']);
    //myprint_r($orgs);
    
    for ($yy = $startyear; $yy <= $endyear; $yy++) {
        for ($mm = $startmonth; $mm <= $endmonth; $mm++) {
            $countAnswered = 0;
            $countTotal = 0;
            foreach ($orgs as $org) {                
                $countAnswered+=countAllAnswerFrmOrg($org['org_code'], $mm, $yy, $answersToBeCountedArray, $additoinalQueryString = '');             
                $countTotal+= countOfQuestoinsAssignedToOrg($org['org_code']);               
            }
            $dataArray[$division['division_name']]["$mm-$yy"]['countAnswered']=$countAnswered;
            $dataArray[$division['division_name']]["$mm-$yy"]['countTotal']=$countTotal;
        }
    }
    
     
}

$startmonth = 1;
$endmonth = 2;
$startyear = 2014;
$endyear = 2014;

//$dataArray = array();
//$answersToBeCountedArray = array('Yes');
//$divisions = getDivisions();
//myprint_r($divisions);

foreach ($divisions as $division) {
    $orgs = getAllOrgUnderDivision($division['division_bbs_code']);
    //myprint_r($orgs);
    
    for ($yy = $startyear; $yy <= $endyear; $yy++) {
        for ($mm = $startmonth; $mm <= $endmonth; $mm++) {
            $countAnswered = 0;
            $countTotal = 0;
            foreach ($orgs as $org) {                
                $countAnswered+=countAllAnswerFrmOrg($org['org_code'], $mm, $yy, $answersToBeCountedArray, $additoinalQueryString = '');             
                $countTotal+= countOfQuestoinsAssignedToOrg($org['org_code']);               
            }
            $dataArray[$division['division_name']]["$mm-$yy"]['countAnswered']=$countAnswered;
            $dataArray[$division['division_name']]["$mm-$yy"]['countTotal']=$countTotal;
        }
    }
    
     
}




//myprint_r($dataArray);



?>
<!--
<table border="1px">
    <?php
    foreach ($dataArray as $district => $districtData) {
        echo "<tr id='$district'>";
            echo "<td>$district</td>";
            echo "<td>";
                echo "<table border='1px'>";
                    echo "<tr>";
                    foreach ($districtData as $year => $yearData) {
                        if ($yearData['countTotal'] > 0) {
                            $percentage = round(($yearData['countAnswered'] * 100) / $yearData['countTotal'], 1);
                            echo "<td>$percentage%</td>";
                        } else {
                            $percentage = 0;
                        }
                    }
                     echo "</tr>";
                echo "</table>";
            echo "</td>";        
        echo "</tr>";
    }
    ?>
</table>

-->