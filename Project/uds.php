<?php
require_once 'Spreadsheet/Excel/Writer.php';
//client variables
$client = $_POST['client'];
$date = $_POST['date'];
$product = $_POST['product'];
$engineer = $_POST['engineer'];

//circuit variables
$site = $_POST['site'];
$users = $_POST['users'];
$type = $_POST['type'];
$isp = $_POST['isp'];
$bandwidth = $_POST['bandwidth'];
$accesstype = $_POST['accesstype'];

//server variables
$servername = $_POST['servername'];
$purpose = $_POST['purpose'];
$currentos = $_POST['currentos'];
$currentapp = $_POST['currentapp'];
$plannedos = $_POST['plannedos'];
$plannedapp = $_POST['plannedapp'];
$migration = $_POST['migration'];
$cpu = $_POST['cpu'];
$ram = $_POST['ram'];
$data = $_POST['data'];
$notes = $_POST['notes'];

//storage variables
$device = $_POST['device'];
$manufacturer = $_POST['manufacturer'];
$typev = $_POST['typev'];
$currentvv = $_POST['currentvv'];
$plannedvv = $_POST['plannedvv'];
$location = $_POST['location'];
$proddr = $_POST['proddr'];


// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

// Create a worksheet
$worksheet = $workbook->addWorksheet('Design Sheet');

//formatting
$heading_format1 =& $workbook->addFormat(array('Size' => 28,
                                        'Align' => 'center',
                                        'Color' => 'white',
                                        'FgColor' => 48,
                                        'Border' => 1,
                                        'Bold' => 1));
$heading_format1->setVAlign('vcenter');
$heading_format_client =& $workbook->addFormat(array('Size' => 11,
                                        'Align' => 'right',
                                        'Color' => 'black',
                                        'Bold' => 1));
$regular_format_client =& $workbook->addFormat(array('Size' => 11,
                                        'Align' => 'center',
                                        'Color' => 'black',
                                        'FgColor' => 5,
                                        'Border' => 1,
                                        'Bold' => 1));
$heading_format =& $workbook->addFormat(array('Size' => 10,
                                        'Align' => 'center',
                                        'Color' => 'white',
                                        'FgColor' => 48,
                                        'Border' => 1,
                                        'Bold' => 1));
$heading_format->setVAlign('vcenter');
$heading_format->setTextWrap();
$regular_format =& $workbook->addFormat(array('Size' => 10,
                                        'Align' => 'center',
                                        'Color' => 'black',
                                        'FgColor' => 22,
                                        'Border' => 1));
$regular_format->setTextWrap();
$heading_format_storage =& $workbook->addFormat(array('Size' => 12,
                                        'Align' => 'left',
                                        'Color' => 'white',
                                        'FgColor' => 0,
                                        'Bold' => 1));
$regular_format->setTextWrap();

//top heading
$worksheet->setMerge(0,0,0,5);
$worksheet->setColumn(0,0,40);
$worksheet->setColumn(1,1,30);
$worksheet->setColumn(2,5,20);
$worksheet->setColumn(6,6,30);
$worksheet->setColumn(7,8,15);
$worksheet->setColumn(9,9,20);
$worksheet->setColumn(10,10,40);
$worksheet->setRow(0,50);
$worksheet->Write(0,0,'Universal Design Sheet', $heading_format1); 

//client info
$worksheet->Write(1,0,'Client Name:', $heading_format_client); 
$worksheet->setMerge(1,1,1,3);
$worksheet->Write(1,1,$client,$regular_format_client);
$worksheet->Write(1,2,'',$regular_format_client);
$worksheet->Write(1,3,'',$regular_format_client);

$worksheet->Write(2,0,'Date:', $heading_format_client); 
$worksheet->Write(2,1,$date,$regular_format_client);

$worksheet->Write(3,0,'ECI Product:', $heading_format_client); 
$worksheet->Write(3,1,$product,$regular_format_client);
$worksheet->setMerge(3,1,3,3);
$worksheet->Write(3,2,'',$regular_format_client);
$worksheet->Write(3,3,'',$regular_format_client);

$worksheet->Write(4,0,'Engineer Name:', $heading_format_client); 
$worksheet->Write(4,1,$engineer,$regular_format_client);




//circuit info
$worksheet->setRow(6,25);
$worksheet->Write(6,0,'Client Site(s)', $heading_format); 
$worksheet->Write(6,1,'Users/Site', $heading_format); 
$worksheet->Write(6,2,'Site Type Main/Remote/Colo', $heading_format); 
$worksheet->Write(6,3,'ISPs       (Verizon/Cogent', $heading_format); 
$worksheet->Write(6,4,'Bandwidth (Ver=10/Cogent=100)', $heading_format); 
$worksheet->Write(6,5,'Current Remote Access Type', $heading_format); 

$i=7;
foreach($site as $a => $b) {
        if ($i <14) {
                $worksheet->Write($i,0, $site[$a], $regular_format);
                $worksheet->Write($i,1, $users[$a], $regular_format);
                $worksheet->Write($i,2, $type[$a], $regular_format);
                $worksheet->Write($i,3, $isp[$a], $regular_format);
                $worksheet->Write($i,4, $bandwidth[$a], $regular_format);
                $worksheet->Write($i,5, $accesstype[$a], $regular_format);
                $i++;   
        }
}



//server info
$worksheet->setRow(14,25);
$worksheet->Write(14,0,'Server Name', $heading_format); 
$worksheet->Write(14,1,'Purpose', $heading_format); 
$worksheet->Write(14,2,'Current OS Version', $heading_format); 
$worksheet->Write(14,3,'Current Application Version', $heading_format); 
$worksheet->Write(14,4,'Planned OS Version', $heading_format); 
$worksheet->Write(14,5,'Planned Application Version', $heading_format); 
$worksheet->Write(14,6,'Resulting Server/Migration Method', $heading_format); 
$worksheet->Write(14,7,'Required vCPUs', $heading_format); 
$worksheet->Write(14,8,'Required vRAM', $heading_format);
$worksheet->Write(14,9,'Current Data Size (in GB)', $heading_format);
$worksheet->Write(14,10,'Additional Notes', $heading_format);   

$i=15;
foreach($servername as $a => $b) {
        if ($i <30) {
                $worksheet->Write($i,0, $servername[$a], $regular_format);
                $worksheet->Write($i,1, $purpose[$a], $regular_format);
                $worksheet->Write($i,2, $currentos[$a], $regular_format);
                $worksheet->Write($i,3, $currentapp[$a], $regular_format);
                $worksheet->Write($i,4, $plannedos[$a], $regular_format);
                $worksheet->Write($i,5, $plannedapp[$a], $regular_format);
                $worksheet->Write($i,6, $migration[$a], $regular_format);
                $worksheet->Write($i,7, $cpu[$a], $regular_format);
                $worksheet->Write($i,8, $ram[$a], $regular_format);
                $worksheet->Write($i,9, $data[$a], $regular_format);
                $worksheet->Write($i,10, $notes[$a], $regular_format);
                $i++;   
        }
}



//storage info
$worksheet->setRow(30,35);
$worksheet->Write(30,0,'Existing Physical Storage', $heading_format); 
$worksheet->Write(30,1,'Manufacturer', $heading_format); 
$worksheet->Write(30,2,'Type of Virtualization', $heading_format); 
$worksheet->Write(30,3,'Current Virtualization Version', $heading_format); 
$worksheet->Write(30,4,'Planned Virtualization Version', $heading_format); 
$worksheet->Write(30,5,'Location of Device', $heading_format); 
$worksheet->Write(30,6,'Prod/DR', $heading_format);

$worksheet->setMerge(31,0,31,6);
$worksheet->Write(31,0,'Existing Storage Devices (DAS/NAS/SAN)', $heading_format_storage);

$i=32;
foreach($device as $a => $b) {
        $worksheet->Write($i,0, $device[$a], $regular_format);
        $worksheet->Write($i,1, $manufacturer[$a], $regular_format);
        $worksheet->Write($i,2, $typev[$a], $regular_format);
        $worksheet->Write($i,3, $currentvv[$a], $regular_format);
        $worksheet->Write($i,4, $plannedvv[$a], $regular_format);
        $worksheet->Write($i,5, $location[$a], $regular_format);
        $worksheet->Write($i,6, $proddr[$a], $regular_format);
        $i++;   
}


 // saving data 
$workbook -> send('universal_design_sheet.xls');
// Send the file after data has been saved
$workbook->close();


?>