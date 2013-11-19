<?php
session_start();
//error_reporting(0);
require_once 'lib/connect.php';
require_once 'inc.functions.generic.php';
require_once 'inc.function.temp.php';
error_reporting(E_ALL);
ini_set('display_errors','On');


//getAllAnswer(' LIMIT 0,10');

$answersToBeCountedArray=array('Yes');
echo "10001942 <br/>";
echo countAllAnswerFrmOrg('10001942', '9', '2013',$answersToBeCountedArray, $additoinalQueryString=''); 
echo "/";
echo countOfQuestoinsAssignedToOrg(10001942);
echo "<br/>";
?>