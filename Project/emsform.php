<?php
require_once 'Spreadsheet/Excel/Writer.php';

//DNS1 Variables
$domainV = $_POST['domain1'];
$rusernameV = $_POST['rusername1'];
$dregistrarV = $_POST['dregistrar1'];
$dnsusernameV = $_POST['dnsusername1'];
$dnsproviderV = $_POST['dnsprovider1'];
$dnsserverV = $_POST['dnsserver1'];

//DNS2
$domain2V = $_POST['domain2'];
$rusername2V = $_POST['rusername2'];
$dregistrar2V = $_POST['dregistrar2'];
$dnsusername2V = $_POST['dnsusername2'];
$dnsprovider2V = $_POST['dnsprovider2'];
$dnsserver2V = $_POST['dnsserver2'];

//DNS3
$domain3V = $_POST['domain3'];
$rusername3V = $_POST['rusername3'];
$dregistrar3V = $_POST['dregistrar3'];
$dnsusername3V = $_POST['dnsusername3'];
$dnsprovider3V = $_POST['dnsprovider3'];
$dnsserver3V = $_POST['dnsserver3'];

//user variables
$nameV = $_POST['name'];
$mobileV = $_POST['mobile'];
$otherV = $_POST['other'];
$loginV = $_POST['login'];
$paddressV = $_POST['paddress'];
$aaddressV = $_POST['aaddress'];

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
// Creating a worksheet
$worksheet = $workbook->addWorksheet('EMS Setup Form');

$heading_format1 =& $workbook->addFormat(array('Size' => 12,
										'Align' => 'center',
										'Bold' => 1,
										'Pattern' => 1,
										'color' => 'black',
										'FgColor' => 22,
										'Border' => 2));

$heading_format2 =& $workbook->addFormat(array('Size' => 24,
										'Align' => 'center',
										'Bold' => 1,
										'Border' => 5));
$heading_format2->setVAlign('vcenter');

$heading_format3 =& $workbook->addFormat(array('Size' => 16,
										'Align' => 'center',
										'Bold' => 1,
										'Pattern' => 1,
										'color' => 'black',
										'FgColor' => 15,
										'Border' => 5));
$heading_format3->setVAlign('center');

$heading_format4 =& $workbook->addFormat(array('Size' => 10,
										'Align' => 'left',
										'Bold' => 1,
										'Pattern' => 1,
										'color' => 'black',
										'FgColor' => 22,
										'Border' => 1));
$heading_format4->setItalic();

$heading_format_top =& $workbook->addFormat(array('Size' => 10,
										'Align' => 'left',
										'Bold' => 1,
										'Pattern' => 1,
										'color' => 'black',
										'FgColor' => 22,
										'Top' => 5));
$heading_format_top->setItalic();

$heading_format_down =& $workbook->addFormat(array('Size' => 10,
										'Align' => 'left',
										'Bold' => 1,
										'Pattern' => 1,
										'color' => 'black',
										'FgColor' => 22,
										'Down' => 5));
$heading_format_down->setItalic();

$regular_format1 =& $workbook->addFormat(array('Size' => 10,
										'Align' => 'left',
										'Border' => 1));

$regular_format_top =& $workbook->addFormat(array('Size' => 10,
										'Align' => 'left',
										'Border' => 1,
										'top' => 5));

$regular_format_down =& $workbook->addFormat(array('Size' => 10,
										'Align' => 'left',
										'Border' => 1,
										'Down' => 5));

$regular_format_right =& $workbook->addFormat(array('Size' => 10,
										'Align' => 'left',
										'Border' => 1,
										'Right' => 5));

$regular_format_top_right =& $workbook->addFormat(array('Size' => 10,
										'Align' => 'left',
										'Top' => 5,
										'Right' => 5));

$regular_format_down_right =& $workbook->addFormat(array('Size' => 10,
										'Align' => 'left',
										'Down' => 5,
										'Right' => 5));

$regular_format2 =& $workbook->addFormat(array('Size' => 10,
										'Align' => 'left',
										'Border' => 1));
$regular_format2->setTextWrap();




$worksheet->setMerge(0,0,4,3);
$worksheet->insertBitmap(0,0,'img/ECI-logo.bmp');

$worksheet->setMerge(0,4,4,5);
$worksheet->Write(0,4,'EMS Setup Form', $heading_format2);     
$worksheet->setColumn(4,5,30);
$worksheet->Write(0,5,'', $heading_format2);
$worksheet->Write(1,4,'', $heading_format2);
$worksheet->Write(1,5,'', $heading_format2); 
$worksheet->Write(2,4,'', $heading_format2);
$worksheet->Write(2,5,'', $heading_format2); 
$worksheet->Write(3,4,'', $heading_format2);
$worksheet->Write(3,5,'', $heading_format2); 
$worksheet->Write(4,4,'', $heading_format2);
$worksheet->Write(4,5,'', $heading_format2); 


$worksheet->setMerge(5,0,5,5);
$worksheet->Write(5,0, 'DNS Hosting Information', $heading_format3);
$worksheet->Write(5,1, '', $heading_format3);
$worksheet->Write(5,2, '', $heading_format3);
$worksheet->Write(5,3, '', $heading_format3);
$worksheet->Write(5,4, '', $heading_format3);
$worksheet->Write(5,5, '', $heading_format3);

//DNS1
$worksheet->Write(6,0, 'Domain Name(s):', $heading_format_top);
$worksheet->setMerge(6,1,6,3);
$worksheet->Write(7,0, 'Domain Registrar:', $heading_format4);
$worksheet->setMerge(7,1,7,3);
$worksheet->Write(7,4,'Registrar User Name:', $heading_format4);
$worksheet->Write(8,0, 'DNS Provider:', $heading_format4);
$worksheet->setMerge(8,1,8,3);
$worksheet->Write(8,4,'DNS Provider User Name:', $heading_format4);
$worksheet->Write(9,0, 'DNS Servers:', $heading_format_down);
$worksheet->setMerge(9,1,9,3);

$worksheet->Write(6,1, $domainV, $regular_format_top);
$worksheet->Write(6,2, '', $regular_format_top);
$worksheet->Write(6,3, '', $regular_format_top);
$worksheet->Write(6,4, '', $regular_format_top);
$worksheet->Write(6,5, '', $regular_format_top_right);
$worksheet->Write(7,1, $dregistrarV, $regular_format1);
$worksheet->Write(7,2, '', $regular_format1);
$worksheet->Write(7,3, '', $regular_format1);
$worksheet->Write(7,5, $rusernameV, $regular_format_right);
$worksheet->Write(8,1, $dnsproviderV, $regular_format1);
$worksheet->Write(8,2, '', $regular_format1);
$worksheet->Write(8,3, '', $regular_format1);
$worksheet->Write(8,5, $dnsusernameV, $regular_format_right);
$worksheet->Write(9,1, $dnsserverV, $regular_format_down);
$worksheet->Write(9,2, '', $regular_format_down);
$worksheet->Write(9,3, '', $regular_format_down);
$worksheet->Write(9,4, '', $regular_format_down);
$worksheet->Write(9,5, '', $regular_format_down_right);

//DNS2
$worksheet->Write(10,0, 'Domain Name(s):', $heading_format_top);
$worksheet->setMerge(10,1,10,3);
$worksheet->Write(11,0, 'Domain Registrar:', $heading_format4);
$worksheet->setMerge(11,1,11,3);
$worksheet->Write(11,4,'Registrar User Name:', $heading_format4);
$worksheet->Write(12,0, 'DNS Provider:', $heading_format4);
$worksheet->setMerge(12,1,12,3);
$worksheet->Write(12,4,'DNS Provider User Name:', $heading_format4);
$worksheet->Write(13,0, 'DNS Servers:', $heading_format_down);
$worksheet->setMerge(13,1,13,3);

$worksheet->Write(10,1, $domain2V, $regular_format_top);
$worksheet->Write(10,2, '', $regular_format_top);
$worksheet->Write(10,3, '', $regular_format_top);
$worksheet->Write(10,4, '', $regular_format_top);
$worksheet->Write(10,5, '', $regular_format_top_right);
$worksheet->Write(11,1, $dregistrar2V, $regular_format1);
$worksheet->Write(11,2, '', $regular_format1);
$worksheet->Write(11,3, '', $regular_format1);
$worksheet->Write(11,5, $rusername2V, $regular_format_right);
$worksheet->Write(12,1, $dnsprovider2V, $regular_format1);
$worksheet->Write(12,2, '', $regular_format1);
$worksheet->Write(12,3, '', $regular_format1);
$worksheet->Write(12,5, $dnsusername2V, $regular_format_right);
$worksheet->Write(13,1, $dnsserver2V, $regular_format_down);
$worksheet->Write(13,2, '', $regular_format_down);
$worksheet->Write(13,3, '', $regular_format_down);
$worksheet->Write(13,4, '', $regular_format_down);
$worksheet->Write(13,5, '', $regular_format_down_right);

//DNS3
$worksheet->Write(14,0, 'Domain Name(s):', $heading_format_top);
$worksheet->setMerge(14,1,14,3);
$worksheet->Write(15,0, 'Domain Registrar:', $heading_format4);
$worksheet->setMerge(15,1,15,3);
$worksheet->Write(15,4,'Registrar User Name:', $heading_format4);
$worksheet->Write(16,0, 'DNS Provider:', $heading_format4);
$worksheet->setMerge(16,1,16,3);
$worksheet->Write(16,4,'DNS Provider User Name:', $heading_format4);
$worksheet->Write(17,0, 'DNS Servers:', $heading_format_down);
$worksheet->setMerge(17,1,17,3);

$worksheet->Write(14,1, $domain3V, $regular_format_top);
$worksheet->Write(14,2, '', $regular_format_top);
$worksheet->Write(14,3, '', $regular_format_top);
$worksheet->Write(14,4, '', $regular_format_top);
$worksheet->Write(14,5, '', $regular_format_top_right);
$worksheet->Write(15,1, $dregistrar3V, $regular_format1);
$worksheet->Write(15,2, '', $regular_format1);
$worksheet->Write(15,3, '', $regular_format1);
$worksheet->Write(15,5, $rusername3V, $regular_format_right);
$worksheet->Write(16,1, $dnsprovider3V, $regular_format1);
$worksheet->Write(16,2, '', $regular_format1);
$worksheet->Write(16,3, '', $regular_format1);
$worksheet->Write(16,5, $dnsusername3V, $regular_format_right);
$worksheet->Write(17,1, $dnsserver3V, $regular_format_down);
$worksheet->Write(17,2, '', $regular_format_down);
$worksheet->Write(17,3, '', $regular_format_down);
$worksheet->Write(17,4, '', $regular_format_down);
$worksheet->Write(17,5, '', $regular_format_down_right);


$worksheet->setColumn(0,0,20);
$worksheet->setColumn(1,1,10);
$worksheet->setColumn(2,2,8);
$worksheet->setColumn(3,3,10);

$worksheet->setMerge(18,0,18,5);
$worksheet->Write(18,0, 'User Account Setup Information', $heading_format3);
$worksheet->Write(18,1, '', $heading_format3);
$worksheet->Write(18,2, '', $heading_format3);
$worksheet->Write(18,3, '', $heading_format3);
$worksheet->Write(18,4, '', $heading_format3);
$worksheet->Write(18,5, '', $heading_format3);

$worksheet->Write(19,0, 'Full Name', $heading_format1);
$worksheet->Write(19,1, 'Mobile', $heading_format1);
$worksheet->Write(19,2, 'Other', $heading_format1);
$worksheet->Write(19,3, 'Login', $heading_format1);
$worksheet->Write(19,4, 'Primary Address', $heading_format1);
$worksheet->Write(19,5, 'Aliased Addresses', $heading_format1);

$i=20;
foreach($nameV as $a => $b) {
	$worksheet->Write($i,0, $nameV[$a], $regular_format2);
	$worksheet->Write($i,1, $mobileV[$a], $regular_format2);
	$worksheet->Write($i,2, $otherV[$a], $regular_format2);
	$worksheet->Write($i,3, $loginV[$a], $regular_format2);
	$worksheet->Write($i,4, $paddressV[$a], $regular_format2);
	$worksheet->Write($i,5, $aaddressV[$a], $regular_format2);
	$i++;
	}

 // saving data 
$workbook -> send('ems-form.xls');
// Send the file after data has been saved
$workbook->close();

?>