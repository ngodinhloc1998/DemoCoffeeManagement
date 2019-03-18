<?php
 /*
$dataPoints = array(
	array("y" => 25, "label" => "Sunday"),
	array("y" => 15, "label" => "Monday"),
	array("y" => 25, "label" => "Tuesday"),
	array("y" => 5, "label" => "Wednesday"),
	array("y" => 10, "label" => "Thursday"),
	array("y" => 0, "label" => "Friday"),
	array("y" => 20, "label" => "Saturday")
);
*/
 
?>
<script>
window.onload = function () {
<?php if($chart_by == 'date'): ?>
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Economic Chart"
	},
	axisY: {
		title: "Income"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
<?php else: ?>
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Ecomimic Chart"
	},
	axisY: {
		title: "Income"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## VND",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
<?php endif; ?>
chart.render();
 
}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>      