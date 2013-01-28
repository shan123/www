<?php
require_once 'mail.php';
ini_set("SMTP","alertmx.eci.com");

$server = 'AASHFAQ3500\SQLEXPRESS';

// Connect to MSSQL
$link = mssql_connect($server, "sa", "cH3r0k33");

//Select the database
if (!$link || !mssql_select_db('ECI_SB', $link)) {
    die('Unable to connect or select database!');
}

$client = $_POST['client'];
$region = $_POST['region'];
$ptm = $_POST['ptm'];
$serviceteam = $_POST['serviceteam'];
$crm = $_POST['crm'];
$type = $_POST['type'];
$projectdate = $_POST['projectdate'];
$starttime = $_POST['starttime'];
$notes = $_POST['notes'];



$date_pieces = explode('-', $projectdate);

$date1 = array($date_pieces[1], $date_pieces[2], $date_pieces[0]);

$date = implode('/', $date1);

$time_in_12_hour_format  = DATE("g:i a", STRTOTIME($starttime));

$head = array(
       'to'      =>array('aashfaq@eci.com'=>'Adeel Ashfaq'),
 	   'cc'		 =>array('hkhan@eci.com'=>'Haani Khan'),
       'from'    =>array('aashfaq@eci.com' =>'Adeel Ashfaq'),
       );
$subject = " EMS Project Request - ". $client;
$body ='';
$body.="<div style='font-family:Arial;font-size:10pt;'>";
$body.=    "<br>"."Yo,";
$body.=    "<br>"."";
$body.=    "<br>"."Please check below:";
$body.=    "<br>"."";
$body.=    "<br><b>"."Client Name:</b> " . $client;
$body.=    "<br><b>"."Region:</b> " . $region;
$body.=    "<br><b>"."PTM:</b> " . $ptm;
$body.=    "<br><b>"."Service Team:</b> " . $serviceteam;
$body.=    "<br><b>"."CRM:</b> " . $crm;
$body.=    "<br><b>"."Project Type:</b> " . $type;
$body.=    "<br><b>"."Project Date:</b> " . $date_pieces[1] . "/". $date_pieces[2] . "/" . $date_pieces[0];
$body.=    "<br><b>"."Start Time:</b> " . $time_in_12_hour_format;
$body.=    "<br><b>"."EMS Work Required:</b>";
if(isset($_POST['tunnel'])) {
$body.=    "<br><b>"."-</b> ". $_POST['tunnel'];
$tunnel = "Needed";
}
else{
	$tunnel = "Not Needed";
}
if(isset($_POST['ptp'])) {
$body.=    "<br><b>"."-</b> ". $_POST['ptp'];
$ptp = "Needed";
}
else{
	$ptp = "Not Needed";
}
if(isset($_POST['officenetwork'])) {
$body.=    "<br><b>"."-</b> ". $_POST['officenetwork'];
$officenetwork = "Needed";
}
else{
	$officenetwork = "Not Needed";
}
if(isset($_POST['dmzvmnetwork'])) {
$body.=    "<br><b>"."-</b> ". $_POST['dmzvmnetwork'];
$dmzmvnetwork = "Needed";
}
else{
	$dmzmvnetwork = "Not Needed";
}
$body.=    "<br><b>"."Notes:</b> " . $notes;
$body.=    "<br>"."";
$body.=    "<br>"."-Adeel";
$body.="</div>";


$query = "INSERT INTO CLOUD_splaemsprojects VALUES('$client', '$region', '$ptm', '$serviceteam', '$crm', '$type', '$date', '$time_in_12_hour_format', '$tunnel', '$ptp', 
												'$officenetwork', '$dmzmvnetwork', '$notes')";
mssql_query($query) or die ('Unable to insert');

//mail::send($head,$subj,$body);//$files are optional param
mail::send($head,$subject,$body);

header('Location: http://10.3.1.176/project/ems-projects-main.php');
?>