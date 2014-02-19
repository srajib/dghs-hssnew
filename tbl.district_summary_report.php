<?php
session_start();
//error_reporting(-1);
require_once 'lib/connect.php';
require_once 'inc.functions.generic.php';
require_once 'inc.function.temp.php';
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

$division_bbs_code = $_REQUEST['division_bbs_code'];

$startmonth = 9;
$endmonth = 12;
$startyear = 2013;
$endyear = 2013;

$dataArray = array();
$answersToBeCountedArray = array('Yes');
$districts = getDistrictsUnderDivision($division_bbs_code);
//myprint_r($divisions);

foreach ($districts as $district) {
    $orgs = getAllOrgUnderDistrict($district['district_bbs_code']);
    //myprint_r($orgs);

    for ($yy = $startyear; $yy <= $endyear; $yy++) {
        for ($mm = $startmonth; $mm <= $endmonth; $mm++) {
            $countAnswered = 0;
            $countTotal = 0;
            foreach ($orgs as $org) {
                $countAnswered+=countAllAnswerFrmOrg($org['org_code'], $mm, $yy, $answersToBeCountedArray, $additoinalQueryString = '');
                $countTotal+= countOfQuestoinsAssignedToOrg($org['org_code']);
                //$dataArray[$district['district_name']][$org['org_name']]["$mm-$yy"]['countAnswered'] = $countAnswered;
                //$dataArray[$district['district_name']][$org['org_name']]["$mm-$yy"]['countTotal'] = $countTotal;
            }
            $dataArray[$district['district_name']][$district['district_bbs_code']]["$mm-$yy"]['countAnswered'] = $countAnswered;
            $dataArray[$district['district_name']][$district['district_bbs_code']]["$mm-$yy"]['countTotal'] = $countTotal;
            //$dataArray[$district['district_bbs_code']]["$mm-$yy"]['district_bbs_code'] = $district_bbs_code;
        }
    }
}

$startmonth = 1;
$endmonth = 2;
$startyear = 2014;
$endyear = 2014;

//$dataArray = array();
//$answersToBeCountedArray = array('Yes');
//$districts = getDistrictsUnderDivision($division_bbs_code);
//myprint_r($divisions);

foreach ($districts as $district) {
    $orgs = getAllOrgUnderDistrict($district['district_bbs_code']);
    //myprint_r($orgs);

    for ($yy = $startyear; $yy <= $endyear; $yy++) {
        for ($mm = $startmonth; $mm <= $endmonth; $mm++) {
            $countAnswered = 0;
            $countTotal = 0;
            foreach ($orgs as $org) {
                $countAnswered+=countAllAnswerFrmOrg($org['org_code'], $mm, $yy, $answersToBeCountedArray, $additoinalQueryString = '');
                $countTotal+= countOfQuestoinsAssignedToOrg($org['org_code']);
                //$dataArray[$district['district_name']][$org['org_name']]["$mm-$yy"]['countAnswered'] = $countAnswered;
                //$dataArray[$district['district_name']][$org['org_name']]["$mm-$yy"]['countTotal'] = $countTotal;
            }
            $dataArray[$district['district_name']][$district['district_bbs_code']]["$mm-$yy"]['countAnswered'] = $countAnswered;
            $dataArray[$district['district_name']][$district['district_bbs_code']]["$mm-$yy"]['countTotal'] = $countTotal;
            //$dataArray[$district['district_bbs_code']]["$mm-$yy"]['district_bbs_code'] = $district_bbs_code;
        }
    }
}
//myprint_r($dataArray);
?>




