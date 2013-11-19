<?php

session_start();
//error_reporting(-1);
require_once 'lib/connect.php';
require_once 'inc.functions.generic.php';
require_once 'inc.function.temp.php';
error_reporting(E_ALL);
ini_set('display_errors','On');

$startmonth = 9;
$endmonth = 11;
$startyear = 2013;
$endyear = 2013;

$dataArray = array();
$answersToBeCountedArray = array('Yes');
$divisions = getDivisions();
//myprint_r($divisions);

foreach ($divisions as $division) {
    $orgs = getAllOrgUnderDivisionTar($division['division_bbs_code']);
    //myprint_r($orgs);
    
    for ($yy = $startyear; $yy <= $endyear; $yy++) {
        for ($mm = $startmonth; $mm <= $endmonth; $mm++) {
            $countAnswered = 0;
            $countTotal = 0;
            foreach ($orgs as $org) {                
                $countAnswered=countAllAnswerFrmOrgTar($org['org_code'], $mm, $yy, $answersToBeCountedArray, $additoinalQueryString = '');             
                $countTotal= countOfQuestoinsAssignedToOrgTar($org['org_code']);               
                $dataArray[$division['division_name']][$org['org_name']]["$mm-$yy"]['countAnswered']=$countAnswered;
                $dataArray[$division['division_name']][$org['org_name']]["$mm-$yy"]['countTotal']=$countTotal;
            }
            
        }
    }
    
     
}

//myprint_r($dataArray);
?>
 
