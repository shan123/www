<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>IP Sheet Reporting</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<script type="text/javascript" src="instantedit.js"></script>
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
        	<form class="form-horizontal" action="ipsheet-ajax.php" method="POST">
        		<legend>IP Sheet Reporting</legend>
        		<div class="row-fluid">
              <div class="span8">
                <div class="row-fluid">
                  <div class="span6 bgcolor">
                    <div class="control-group">
                      <label class="control-label" for="client"><b>Client Name:</b></label>
                      <div class="controls">
                        <input type="text" name="client" placeholder="Client Name">
                      </div>
                    </div>
                  </div><!--/span-->
                  <div class="span6 bgcolor">
                    <div class="control-group">
                      <label class="control-label" for="region"><b>Region:</b></label>
                      <div class="controls">
                        <select name="region" style="width:150px;">
                          <option value=""></option>
                          <option value="New York">New York</option>
                          <option value="Boston">Boston</option>
                          <option value="chicago">Chicago</option>
                          <option value="Connecticut">Connecticut</option>
                          <option value="Minnesota">Minnesota</option>
                          <option value="Los Angeles">Los Angeles</option>
                          <option value="San Francisco">San Francisco</option>
                          <option value="Texas">Texas</option>
                          <option value="London">London</option>
                          <option value="Singapore">Singapore</option>
                          <option value="Hong Kong">Hong Kong</option>
                        </select>
                      </div>
                    </div>
                  </div><!--/span-->
                </div><!--/row-->
                <div class="row-fluid">
                  <div class="span6 bgcolor">
                    <div class="control-group">
                      <label class="control-label" for="tab"><b>Tab Name:</b></label>
                      <div class="controls">
                        <input type="text" name="tab" placeholder="Tab Name">
                      </div>
                    </div>
                  </div><!--/span-->
                  <div class="span6 bgcolor">
                    <div class="control-group">
                      <label class="control-label" for="ip"><b>IP Address:</b></label>
                      <div class="controls">
                        <input type="text" name="ip" placeholder="Eg. 192, 192.168">
                      </div>
                    </div>
                  </div><!--/span-->
                </div><!--/row-->
              </div>
        		</div>
            <input class="btn btn-primary" value="Submit" type="submit">
        	</form>
          <hr>
        </div>

        <?php

        if( isset($_POST['client'])) {

          $client = $_POST['client'];
          $region = $_POST['region'];
          $tab = $_POST['tab'];
          $ip = $_POST['ip'];
          $server = 'AASHFAQ3500\SQLEXPRESS';

          // Connect to MSSQL
          $link = mssql_connect($server, "sa", "cH3r0k33");

          //Select the database
          if (!$link || !mssql_select_db('ipsheet', $link)) {
              die('Unable to connect or select database!');
          }


          if ($client == "" AND $region =="" AND $tab =="" AND $ip =="") {
            $query1 = "SELECT * from client, ipsheet WHERE client.clientId = ipsheet.clientId";
            $result = mssql_query($query1) or die ('Unable to run query');
          }
          if ($client != "" AND $region =="" AND $tab =="" AND $ip =="") {
            $query1 = "SELECT * from client, ipsheet WHERE  clientName LIKE '$client%' AND client.clientId = ipsheet.clientId";
            $result = mssql_query($query1) or die ('Unable to run query');
          }
          if ($client == "" AND $tab =="" AND $region !="" AND $ip =="") {
            $query1 = "SELECT * from client, ipsheet WHERE region = '$region' AND client.clientId = ipsheet.clientId";
            $result = mssql_query($query1) or die ('Unable to run query');
          }
          if ($client == "" AND $region =="" AND $tab !="" AND $ip =="") {
            $query1 = "SELECT * from client, ipsheet WHERE tabName LIKE '$tab%' AND client.clientId = ipsheet.clientId";
            $result = mssql_query($query1) or die ('Unable to run query');
          }
          if ($client == "" AND $region =="" AND $tab =="" AND $ip !="") {
            $query1 = "SELECT * from client, ipsheet WHERE ip LIKE '$ip%' AND client.clientId = ipsheet.clientId";
            $result = mssql_query($query1) or die ('Unable to run query');
          }


          if ($client != "" AND $region =="" AND $tab !="") {
            $query1 = "SELECT * from client, ipsheet WHERE tabName LIKE '$tab%' AND clientName LIKE '$client%' AND client.clientId = ipsheet.clientId";
            $result = mssql_query($query1) or die ('Unable to run query');
          }
          if ($client == "" AND $region !="" AND $tab !="") {
            $query1 = "SELECT * from client, ipsheet WHERE tabName LIKE '$tab%' AND region = '$region' AND client.clientId = ipsheet.clientId";
            $result = mssql_query($query1) or die ('Unable to run query');
          }



          if ($client != "" AND $region !="" AND $tab !="") {
            $query1 = "SELECT * from client, ipsheet WHERE region = '$region' AND clientName = '$client' AND tabName = '$tab' AND client.clientId = ipsheet.clientId";
            $result = mssql_query($query1) or die ('Unable to run query');
          }
          if ($client != "" AND $region !="" AND $ip !="") {
            $query1 = "SELECT * from client, ipsheet WHERE region = '$region' AND clientName = '$client' AND ip LIKE '$ip%' AND client.clientId = ipsheet.clientId";
            $result = mssql_query($query1) or die ('Unable to run query');
          }

          echo "<fieldset>";
          echo "<div class=\"span8\">";
          echo "<table class=\"table table-striped table-bordered\">";
          echo "<thead>";
          echo "<tr>";
          echo "<td> <b>Client Name</b> </td>";
          echo "<td> <b>Region</b> </td>";
          echo "<td> <b>Tab Name</b> </td>";
          echo "<td> <b>IP Address</td>";
          echo "<td> <b>Subnet</td>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          while($row = mssql_fetch_array($result)) {
            echo "<tr>";
            ?>
            <td><span id="clientName-|||-<?php echo $row[0]; ?>-|||-<?php echo $row[7];?>" class="editText"><?php  echo $row[1];	?></span></td>
            <td><span id="region-|||-<?php echo $row[0]; ?>-|||-<?php echo $row[7];?>" class="editText"><?php  echo $row[2];  ?></span></td>
            <td><span id="tabName-|||-<?php echo $row[0]; ?>-|||-<?php echo $row[7];?>" class="editText"><?php  echo $row[4];  ?></span></td>
            <td><span id="ip-|||-<?php echo $row[0]; ?>-|||-<?php echo $row[7];?>" class="editText"><?php  echo $row[5];  ?></span></td>
            <td><span id="subnet-|||-<?php echo $row[0]; ?>-|||-<?php echo $row[7];?>" class="editText"><?php  echo $row[6];  ?></span></td>
            <?php
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
          echo "</div>";
          echo "</fieldset>";
          echo "<hr>";

          mssql_free_result($result);
          mssql_close($link);
        }
        ?>

    </body>
</html>

