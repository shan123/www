<?php

require_once 'Spreadsheet/Excel/Writer.php';

$tabV = $_POST['tab'];
$ipV = $_POST['ip'];
$subnetV = $_POST['subnet'];
$clientV = $_POST['client'];
$regionV = $_POST['region'];

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

$heading_format =& $workbook->addFormat(array('Size' => 12,
										'Align' => 'left',
										'Bold' => 1,
										'Pattern' => 1,
										'color' => 'black',
										'FgColor' => 15,
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
	$worksheet->setColumn(1,1,15);
	$worksheet->setColumn(2,3,4);
	$worksheet->setColumn(4,6,15);

	// The actual data
	$worksheet->write(1, 4, 'Client', $heading_format);
	$worksheet->write(1, 5, $clientV, $regular_format);
	$worksheet->write(2, 4, 'Region', $heading_format);
	$worksheet->write(2, 5, $region, $regular_format);
	$worksheet->write(3, 4, 'Network #', $heading_format);
	$worksheet->write(3, 5, $ip, $regular_format);
	$worksheet->write(4, 4, 'Subnet Mask', $heading_format);
	$worksheet->write(4, 5, $subnet, $regular_format);
	$worksheet->write(5, 4, 'Segment', $heading_format);
	$worksheet->write(5, 5, $tab, $regular_format);
	$worksheet->write(7, 1, 'Network #', $heading_format);
	$worksheet->write(7, 2, 'IP', $heading_format);
	$worksheet->write(7, 3, 'Own', $heading_format);
	$worksheet->write(7, 4, 'Category', $heading_format);
	$worksheet->write(7, 5, 'Assignment', $heading_format);
	$worksheet->write(7, 6, 'Typical', $heading_format);

	$numberOfIPs = 0;
	switch ($subnet) {
		case 24:
			$numberOfIPs = 255;
			break;
		case 25:
			$numberOfIPs = 127;
			break;
		case 26:
			$numberOfIPs = 63;
			break;
		case 27:
			$numberOfIPs = 31;
			break;
		case 28:
			$numberOfIPs = 15;
			break;
		case 29:
			$numberOfIPs = 7;
			break;
		case 30:
			$numberOfIPs = 3;
			break;
		default:
			$numberOfIPs = 255;
	}


	$result = explode('.', $ip);
	$network = $result[0] . "." . $result[1] . "." . $result[2];
	$node = $result[3];


	$worksheet->write(8, 1, $network, $nonusableip_format);
	$worksheet->write(8, 2, $node, $nonusableip_format);
	$worksheet->write(8, 3, '', $nonusableip_format);
	$worksheet->write(8, 4, 'Unusable', $nonusableip_format);
	$worksheet->write(8, 5, 'Network #', $nonusableip_format);
	$worksheet->write(8, 6, '', $nonusableip_format);

	for($i=1; $i < $numberOfIPs; $i++) {
		$node = $node + 1;
		$worksheet->write(8+$i, 1, $network, $nonusableip_format);
		$worksheet->write(8+$i, 2, $node, $regular_format);
		$worksheet->write(8+$i, 3, '', $regular_format);
		$worksheet->write(8+$i, 4, '', $regular_format);
		$worksheet->write(8+$i, 5, '', $regular_format);
		$worksheet->write(8+$i, 6, '', $regular_format);
	 }

	 $worksheet->write(8+$numberOfIPs, 1, $network, $nonusableip_format);
	 $worksheet->write(8+$numberOfIPs, 2, $node+1, $nonusableip_format);
	 $worksheet->write(8+$numberOfIPs, 3, '', $nonusableip_format);
	 $worksheet->write(8+$numberOfIPs, 4, 'Unusable', $nonusableip_format);
	 $worksheet->write(8+$numberOfIPs, 5, 'Broadcast Number', $nonusableip_format);
	 $worksheet->write(8+$numberOfIPs, 6, '', $nonusableip_format);
	 

 }


 // saving data 
$workbook -> send('ipsheet.xls');
// Send the file after data has been saved
$workbook->close();
?>