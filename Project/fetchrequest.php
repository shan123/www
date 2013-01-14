<?php

require_once 'Spreadsheet/Excel/Writer.php';
require_once 'Net/IPv4.php';

$tabV = $_POST['tab'];
$ipV = $_POST['ip'];
$subnetV = $_POST['subnet'];
$clientV = $_POST['client'];
$regionV = $_POST['region'];

$server = 'AASHFAQ3500\SQLEXPRESS';

// Connect to MSSQL
$link = mssql_connect($server, "sa", "cH3r0k33");

//Select the database
if (!$link || !mssql_select_db('ipsheet', $link)) {
    die('Unable to connect or select database!');
}

$query = "INSERT INTO client(clientName, region) VALUES ('$clientV', '$regionV')";
mssql_query($query) or die ('Unable to insert');

//$query = "SELECT clientId from client where clientName='$clientV'";
$query = "SELECT MAX(clientid) from client";
$result = mssql_query($query) or die ('Unable to insert');
$row = mssql_fetch_row($result);

$clientId = $row[0];


// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

$heading_format =& $workbook->addFormat(array('Size' => 12,
										'Align' => 'left',
										'Bold' => 1,
										'Pattern' => 1,
										'color' => 'black',
										'FgColor' => 22,
										'Border' => 2));

$regular_format =& $workbook->addFormat(array('Size' => 10,
										'Align' => 'left',
										'Border' => 2));

$nonusableip_format =& $workbook->addFormat(array('Size' => 10,
										'Align' => 'left',
										'Pattern' => 1,
										'color' => 'black',
										'FgColor' => 22,
										'Border' => 2));


foreach($tabV as $a => $b) {
	
	$tab = $tabV[$a];
	$region = $regionV;
	$ip = $ipV[$a];
	$subnet = $subnetV[$a];

	// Creating a worksheet
	$worksheet =& $workbook->addWorksheet($tab);
	$worksheet->setColumn(0,0,15);
	$worksheet->setColumn(1,2,4);
	$worksheet->setColumn(3,5,15);
	$worksheet->setColumn(4,4,30);

	// The actual data
	$worksheet->write(0, 3, 'Client', $heading_format);
	$worksheet->write(0, 4, $clientV, $regular_format);
	$worksheet->write(1, 3, 'Region', $heading_format);
	$worksheet->write(1, 4, $region, $regular_format);
	$worksheet->write(2, 3, 'Network #', $heading_format);
	$worksheet->write(2, 4, $ip, $regular_format);
	$worksheet->write(3, 3, 'Subnet Mask', $heading_format);
	$worksheet->write(3, 4, $subnet, $regular_format);
	$worksheet->write(4, 3, 'Segment', $heading_format);
	$worksheet->write(4, 4, $tab, $regular_format);
	$worksheet->write(6, 0, 'Network #', $regular_format);
	$worksheet->write(6, 1, 'IP', $regular_format);
	$worksheet->write(6, 2, 'Own', $regular_format);
	$worksheet->write(6, 3, 'Category', $regular_format);
	$worksheet->write(6, 4, 'Assignment', $regular_format);
	$worksheet->write(6, 5, 'Typical', $regular_format);

	$numberOfIPs = 0;
	$sub = 0;
	switch ($subnet) {
		case 22:
			$numberOfIPs = 1024;
			$sub = '255.255.252.0';
			break;
		case 24:
			$numberOfIPs = 255;
			$sub = '255.255.255.0';
			break;
		case 25:
			$numberOfIPs = 127;
			$sub = '255.255.255.128';
			break;
		case 26:
			$numberOfIPs = 63;
			$sub = '255.255.255.192';
			break;
		case 27:
			$numberOfIPs = 31;
			$sub = '255.255.255.224';
			break;
		case 28:
			$numberOfIPs = 15;
			$sub = '255.255.255.240';
			break;
		case 29:
			$numberOfIPs = 7;
			$sub = '255.255.255.248';
			break;
		case 30:
			$numberOfIPs = 3;
			$sub = '255.255.255.252';
			break;
		default:
			$numberOfIPs = 255;
			$sub = '255.255.255.0';
	}

	// create IPv4 object
	$ip_calc = new Net_IPv4();

	// set variables
	$ip_calc->ip = $ip;
	$ip_calc->netmask = $sub;

	// calculate
	$ip_calc->calculate();

	// get network and broadcast addresses
	$network_address = $ip_calc->network;
	$broadcast_address = $ip_calc->broadcast;

	//String manipulation to convert the ip address in octets
	$result = explode('.', $network_address);
	$network = $result[0] . "." . $result[1] . "." . $result[2];
	$node = $result[3];

	$result1 = explode('.', $broadcast_address);
	$network = $result1[0] . "." . $result1[1] . "." . $result1[2];
	$bnode = $result1[3];

	// add info to ipsheet database
	$query = "INSERT INTO ipsheet(clientId, tabName, ip, subnet) VALUES ('$clientId', '$tab', '$network_address', '$subnet')";
	mssql_query($query) or die ('Unable to insert');


	$worksheet->write(7, 0, $network, $nonusableip_format);
	$worksheet->write(7, 1, $node, $nonusableip_format);
	$worksheet->write(7, 2, '', $nonusableip_format);
	$worksheet->write(7, 3, 'Unusable', $nonusableip_format);
	$worksheet->write(7, 4, 'Network #', $nonusableip_format);
	$worksheet->write(7, 5, '', $nonusableip_format);
	$i=1;
	for($j=$node; $j < $bnode-1; $j++) {
		$node = $node + 1;
		$worksheet->write(7+$i, 0, $network, $nonusableip_format);
		$worksheet->write(7+$i, 1, $node, $regular_format);
		$worksheet->write(7+$i, 2, '', $regular_format);
		$worksheet->write(7+$i, 3, '', $regular_format);
		$worksheet->write(7+$i, 4, '', $regular_format);
		$worksheet->write(7+$i, 5, '', $regular_format);
		$i++;
	 }
	$worksheet->write(7+$i, 0, $network, $nonusableip_format);
	$worksheet->write(7+$i, 1, $bnode, $nonusableip_format);
	$worksheet->write(7+$i, 2, '', $nonusableip_format);
	$worksheet->write(7+$i, 3, 'Unusable', $nonusableip_format);
	$worksheet->write(7+$i, 4, 'Broadcast Number', $nonusableip_format);
	$worksheet->write(7+$i, 5, '', $nonusableip_format);	
 }


 // saving data 
$workbook -> send('ipsheet.xls');
// Send the file after data has been saved
$workbook->close();

mssql_close($link);
?>