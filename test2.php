<!DOCTYPE html>
<html>
<body>

<?php
echo $dm=date("k-Y") . "<br>";
echo $dm2=date("m") -1 .'-'.'2013.'. "<br>";

// Prints the day, date, month, year, time, AM or PM
$date=date_create("2013-08-10");
date_add($date,date_interval_create_from_date_string("40 days"));

echo date_format($date,"m-Y");

?>

</body>
</html>