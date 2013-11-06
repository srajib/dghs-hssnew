<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$imp=array('p','d','s');
$impl=implode(",",$imp);

print_r($impl);

echo"<br>";
$arr="p1 p2 p3";
$expl=explode(" ",$arr);
echo $file1= $expl[0];
echo"<br>";
echo $file2=$expl[1];
echo"<br>";
echo $file3=$expl[2];


?>
