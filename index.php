<?php

phpinfo();
$server = 'BOS-MGMT02\SQLEXPRESS';

// Connect to MSSQL
$link = mssql_connect($server, "sa", "cH3r0k33");

//Select the database
if (!$link || !mssql_select_db('ECI_SB', $link)) {
    die('Unable to connect or select database!');
}

?>