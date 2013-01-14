<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0


//we get 2 vars: fieldname and content. so you get: $fieldname=$content;
//and we get the vars set in the function setVarsForm(vars). These could be used 
//to identify a user with sending userID=1 
//you also can use $_COOKIE['someID'] in the file.


//THIS UPDATES A DATABASE
//create DB connection
$server = 'AASHFAQ3500\SQLEXPRESS';

// Connect to MSSQL
$link = mssql_connect($server, "sa", "cH3r0k33");

//Select the database
if (!$link || !mssql_select_db('ipsheet', $link)) {
    die('Unable to connect or select database!');
}


//update from table set $fieldname = $content where userID = $_COOKIE['userID']


//OR

//THIS STARTS A FUNCTION
//if($_GET['fieldname'] == "userName")
//  setUserName($_GET['content']);
//if($_GET['fieldname'] == "userCity")
//  setUserCity($_GET['content']);
//
//

//OR


//THIS WRITES CONTENT TO A TEXT FILE
//$handle = fopen($_GET['fieldname'].".txt", "w+");
//fwrite($handle, stripslashes($_GET['content']));
//fclose($handle);


$content = $_GET['content'];

list($fieldname, $id, $ipId) = explode("-|||-",$_GET['fieldname']);

if( $fieldname == 'clientName' OR $fieldname == 'region'){
	mssql_query("UPDATE client SET $fieldname = '$content' WHERE clientId = $id ");
}
if ($fieldname =='tabName' OR $fieldname =='ip' OR $fieldname == 'subnet'){
	mssql_query("UPDATE ipsheet SET $fieldname = '$content' WHERE ipsheetId = $ipId ");
}

$query1 = "SELECT * from client, ipsheet WHERE client.clientId = $id AND client.clientId = ipsheet.clientId AND ipsheet.ipsheetId = $ipId";
$result = mssql_query($query1) or die ('Unable to run query');

$row = mssql_fetch_assoc($result);
echo $row["{$fieldname}"]; 

?>
