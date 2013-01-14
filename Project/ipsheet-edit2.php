<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>IP Sheet Reporting</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="js/instantedit.js"></script>
		<link href="css/bootstrap.css" rel="stylesheet">
    	<link href="css/jquery-ui-1.8.css" rel="stylesheet" type="text/css"/>
   		 <style type="text/css">
     		 body {
       	 		padding-top: 60px;
       	 		padding-bottom: 40px;
     	 	}
      
      
      		.bgcolor {
        		background-color: none;
      		}      
      
      		.lightblue {
      			 background-color: none;
      		}
        
    	</style>
    </head>
    <body>
      <?php
      if(isset($_GET['id'])){

        $server = 'AASHFAQ3500\SQLEXPRESS';

        // Connect to MSSQL
        $link = mssql_connect($server, "sa", "cH3r0k33");

        //Select the database
        if (!$link || !mssql_select_db('ipsheet', $link)) {
            die('Unable to connect or select database!');
        }
        $id = $_GET['id'];
        $ipId = $_GET['ipId'];
        $query1 = "SELECT * from client, ipsheet WHERE client.clientId = $id AND client.clientId = ipsheet.clientId AND ipsheet.ipsheetId = $ipId";
        $result = mssql_query($query1) or die ('Unable to run query');
        $row = mssql_fetch_array($result);

      ?>
        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container-fluid">
              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>
              <a class="brand" href="/">Home</a>
              <div class="nav-collapse collapse">
                <ul class="nav">
                  <li><a href="emsform.html">EMS Setup Form</a></li>
                  <li><a href="ipsheet.html">IP Sheet Generator</a></li>
                  <li><a href="uds.html">Universal Design Sheet</a></li>
                </ul>
              </div><!--/.nav-collapse -->
            </div>
          </div>
        </div>

        <div class="container-fluid">
        	<form class="form-horizontal" action="ipsheet-edit2.php" method="POST">
        		<legend>IP Sheet Update</legend>
        		<div class="row-fluid">
              <div class="span8">
                <div class="row-fluid">
                  <table class="table">
                    <thead>
                      <tr>
                        <td style="width:30px;">Client ID</td>
                        <td style="width:200px;">Client Name</td>
                        <td style="width:150px;">Region</td>
                        <td style="width:150px;">Tab Name</td>
                        <td style="width:200px;">IP Address</td>
                        <td style="width:200px;">Subnet</td>
                        <td style="width:30px;">IP Table ID</td>
                      </tr>
                    </thead>
                  <tbody>
                  <tr>
                    <td><input type="text" style="width:50px;" name="id" readonly="readonly" value="<?php echo $row[0];?>"></td>
                    <td><input type="text" style="width:200px;" name="client" value="<?php echo $row[1];?>"></td>
                    <td><input type="text" style="width:150px;" name="region" value="<?php echo $row[2];?>"></td>
                    <td><input type="text" style="width:150px;" name="tabName" value="<?php echo $row[4];?>"></td>
                    <td><input type="text" style="width:150px;" name="ip" value="<?php echo $row[5];?>"></td>
                    <td><input type="text" style="width:30px;" name="subnet" value="<?php echo $row[6];?>"></td>
                    <td><input type="text" style="width:60px;" name="ipId" readonly="readonly" value="<?php echo $row[7];?>"></td>
                  </tr>
                  </tbody>
                </table>
                </div>
              </div>
        		</div>
            <input class="btn btn-primary" value="Submit" type="submit">
        	</form>
          <hr>
        </div>
      <?php 
      }
      ?>


        <?php
        if(isset($_POST['client'])){
          $client = $_POST['client'];
          $region = $_POST['region'];
          $tab = $_POST['tabName'];
          $ip = $_POST['ip'];
          $subnet = $_POST['subnet'];
          $id = $_POST['id'];
          $ipId = $_POST['ipId'];

          $server = 'AASHFAQ3500\SQLEXPRESS';

          // Connect to MSSQL
          $link = mssql_connect($server, "sa", "cH3r0k33");

          //Select the database
          if (!$link || !mssql_select_db('ipsheet', $link)) {
              die('Unable to connect or select database!');
          }

          if( isset($_POST['client']) AND $_POST['region']){
            mssql_query("UPDATE client SET clientName = '$client' WHERE clientId = $id ");
            mssql_query("UPDATE client SET region ='$region'WHERE clientId =$id");
          }
          if (isset($_POST['tabName']) AND isset($_POST['ip']) AND isset($_POST['subnet'])){
            mssql_query("UPDATE ipsheet SET tabName = '$tab' WHERE ipsheetId = $ipId ");
            mssql_query("UPDATE ipsheet SET ip = '$ip' WHERE ipsheetId = $ipId ");
            mssql_query("UPDATE ipsheet SET subnet = '$subnet' WHERE ipsheetId = $ipId ");
          }
          header('Location: http://10.3.1.176/project/ipsheet-edit1.php');

      }

      ?>


    </body>
</html>

