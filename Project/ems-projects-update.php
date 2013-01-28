<?php
session_start();
if(!isset($_SESSION['username'])){
header("location:login.html");
}

require_once 'mail.php';
ini_set("SMTP","alertmx.eci.com");

$server = 'AASHFAQ3500\SQLEXPRESS';

// Connect to MSSQL
$link = mssql_connect($server, "sa", "cH3r0k33");

//Select the database
if (!$link || !mssql_select_db('ECI_SB', $link)) {
    die('Unable to connect or select database!');
}

$projectId = $_POST['projectId'];
$client = $_POST['client'];
$region = $_POST['region'];
$ptm = $_POST['ptm'];
$serviceteam = $_POST['serviceteam'];
$crm = $_POST['crm'];
$projecttype = $_POST['projecttype'];
$projectdate = $_POST['projectdate'];
$starttime = $_POST['starttime'];
$notes = $_POST['notes'];
$ptpturnup = $_POST['ptpturnup'];
$emstunnel = $_POST['emstunnel'];
$officenetwork = $_POST['officenetwork'];
$dmzmvnetwork = $_POST['dmzmvnetwork'];



$query = "UPDATE CLOUD_splaemsprojects 
          SET client='$client', region='$region', ptm='$ptm', serviceteam='$serviceteam', crm='$crm', projecttype='$projecttype',
              projectdate='$projectdate', starttime='$starttime', emstunnel='$emstunnel', ptpturnup='$ptpturnup', officenetwork='$officenetwork',
              dmzmvnetwork='$dmzmvnetwork', notes='$notes'
          WHERE projectId='$projectId'";
mssql_query($query) or die("Can't update the row");



$head = array(
       'to'      =>array('aashfaq@eci.com'=>'Adeel Ashfaq'),
 	   'cc'		 =>array('hkhan@eci.com'=>'Haani Khan'),
       'from'    =>array('aashfaq@eci.com' =>'Adeel Ashfaq'),
       );
$subject = " EMS Project Request Update- ". $client;
$body ='';
$body.="<div style='font-family:Arial;font-size:10pt;'>";
$body.=    "<br>"."Yo,";
$body.=    "<br>"."";
$body.=    "<br>"."The project information has been updated by ". $_SESSION['username']. ".Please check below:";
$body.=    "<br>"."";
$body.=    "<br><b>"."Client Name:</b> " . $client;
$body.=    "<br><b>"."Region:</b> " . $region;
$body.=    "<br><b>"."PTM:</b> " . $ptm;
$body.=    "<br><b>"."Service Team:</b> " . $serviceteam;
$body.=    "<br><b>"."CRM:</b> " . $crm;
$body.=    "<br><b>"."Project Type:</b> " . $projecttype;
$body.=    "<br><b>"."Project Date:</b> " . $projectdate;
$body.=    "<br><b>"."Start Time:</b> " . $starttime;
$body.=    "<br><b>"."EMS Work Required:</b>";
$body.=    "<br>"."- EMS Tunnel: " . $emstunnel;
$body.=    "<br>"."- PTP Turnup: " . $ptpturnup;
$body.=    "<br>"."- /24 to Office Netowrk: " . $officenetwork;
$body.=    "<br>"."- /24 to DMZ/MV: " . $dmzmvnetwork;
$body.=    "<br><b>"."Notes:</b> " . $notes;
$body.=    "<br>"."";
$body.=    "<br>"."-Adeel";
$body.="</div>";

mail::send($head,$subject,$body);

header('Location:ems-projects-edit.php');

?>