<?php
	include "../libchart/classes/libchart.php";

	header("Content-type: image/png");

	$chart = new VerticalBarChart(500, 300);

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("Bleu d'Auvergne", 50));
	$dataSet->addPoint(new Point("Tomme de Savoie", 75));
	$dataSet->addPoint(new Point("Crottin de Chavignol", 30));
	$chart->setDataSet($dataSet);

	$chart->setTitle("Preferred Cheese");
	$chart->render();
?>