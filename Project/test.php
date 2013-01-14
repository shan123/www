<?php

$server = 'AASHFAQ3500\SQLEXPRESS';

// Connect to MSSQL
$link = mssql_connect($server, "sa", "cH3r0k33");

//Select the database
if (!$link || !mssql_select_db('ipsheet', $link)) {
    die('Unable to connect or select database!');
}
$clientV = "Pzena Capital Management";
$regionV = "New York";
$tab = "LAN";
$ip = "10.10.50.0";
$subnet = "24";


$query = "INSERT INTO client(clientName, region) VALUES ('$clientV', '$regionV')";
mssql_query($query) or die ('Unable to insert');

//$query = "SELECT clientId from client where clientName='$clientV'";
$query = "SELECT MAX(clientid) from client";
$result = mssql_query($query) or die ('Unable to insert');
$row = mssql_fetch_row($result);

$clientId = $row[0];

$query = "INSERT INTO ipsheet(clientId, tabName, ip, subnet) VALUES ('$clientId', '$tab', '$ip', '$subnet')";
mssql_query($query) or die ('Unable to insert');
?>