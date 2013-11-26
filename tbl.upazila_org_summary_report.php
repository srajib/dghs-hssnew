<?php

session_start();
//error_reporting(-1);
require_once 'lib/connect.php';
require_once 'inc.functions.generic.php';
require_once 'inc.function.temp.php';
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

$district_bbs_code = $_REQUEST['district_bbs_code'];
$upazila_thana_code = $_REQUEST['upazila_thana_code'];

$startmonth = 9;
$endmonth = 11;
$startyear = 2013;
$endyear = 2013;

$dataArray = array();
$answersToBeCountedArray = array('Yes');

//myprint_r($divisions);


$orgs = getAllOrgUnderUpazila($district_bbs_code,$upazila_thana_code);
//myprint_r($orgs);
$organization_code=$orgs[0]['org_code'];

for ($yy = $startyear; $yy <= $endyear; $yy++) {
    for ($mm = $startmonth; $mm <= $endmonth; $mm++) {
        if($mm<10)
           $month_year='0'.$mm.'-'.$yy;
         else 
          $month_year=$mm.'-'.$yy;
        $countAnswered = 0;
        $countTotal = 0;
        foreach ($orgs as $org) {
            $countAnswered+=countAllAnswerFrmOrg($org['org_code'], $mm, $yy, $answersToBeCountedArray, $additoinalQueryString = '');
            $countTotal+= countOfQuestoinsAssignedToOrg($org['org_code']);
            $dataArray[$org['org_name']]["$mm-$yy"]['countAnswered'] = $countAnswered;
            $dataArray[$org['org_name']]["$mm-$yy"]['countTotal'] = $countTotal;
            $dataArray[$org['org_name']]["$mm-$yy"]['month_year'] = $month_year;
           // $dataArray[$org['month']]=$mm.$yy;
        }
        
        
    }
}

//myprint_r($dataArray);
?>


