<?php
require_once("../jpgraph/src/jpgraph.php");
require_once("../jpgraph/src/jpgraph_bar.php");

$datax=json_decode($_REQUEST['x']);
$datay=json_decode($_REQUEST['y']);
$title=$_REQUEST['title'];

//var_dump($datax); exit();
 
/* // We need some data
$datay=array(0.13,0.25,0.21,0.35,0.31,0.06);
$datax=array("January","February","March","April","May","June");
 */


// Setup the graph.
$graph = new Graph(600,400,'auto');
$graph->clearTheme();
$graph->img->SetMargin(60,20,35,75);
$graph->SetScale("textlin");
$graph->SetMarginColor("white:1.1");
$graph->SetShadow(false,0,"white");

// Set up the title for the graph
$graph->title->Set($title);
$graph->title->SetMargin(8);
$graph->title->SetFont(FF_VERDANA,FS_BOLD,12);
$graph->title->SetColor("darkred");
//$graph->values->Show();

// Setup font for axis
$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,10);

// Show 0 label on Y-axis (default is not to show)
$graph->yscale->ticks->SupressZeroLabel(false);

// Setup X-axis labels
$graph->xaxis->SetTickLabels($datax);
$graph->xaxis->SetLabelAngle(50);

// Create the bar pot
$bplot = new BarPlot($datay);
$bplot->SetWidth(0.6);

// Setup color for gradient fill style
$bplot->SetFillGradient("navy:0.9","navy:1.85",GRAD_LEFT_REFLECTION);

// Set color for the frame of each bar
$bplot->SetColor("white");
$graph->Add($bplot);

// Finally send the graph to the browser
$graph->Stroke();


?>