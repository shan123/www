<?php
session_start();
if(!isset($_SESSION['username'])){
header("location:login.html");
}
?>


<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>EMS Project Requests</title>
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
      <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>
      <script type="text/javascript">
          $(document).ready(function () {
              $('.dropdown-toggle').dropdown();
          });
      </script>
    </head>
    <body>

      <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container-fluid">
            <a class="brand" herf="/">Home</a>
            <ul class="nav">
              <li class="dropdown" id="accountmenu">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">EMS Projects<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/project/ems-projects-main.php">EMS Project Request Form</a></li>
                    <li class="active"><a href="/project/ems-projects-edit.php">Update Exisiting Request</a></li>
                    <li><a href="/project/ems-projects-reporting.php">Reporting</a></li>
                </ul>
              </li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
           </div>
        </div>
      </div>

        <div class="container-fluid">
        	<form class="form-horizontal" action="ems-projects-edit.php" method="POST">
        		<legend>Update Exisiting Request</legend>
        		<div class="row-fluid">
              <div class="span10">
                <div class="row-fluid">
                  <div class="span4 bgcolor">
                    <div class="control-group">
                      <label class="control-label" for="client"><b>Please select a client:</b></label>
                      <div class="controls">
                        <select name="client" style="width:150px;">
                          <?php
                            $server = 'AASHFAQ3500\SQLEXPRESS';

                            // Connect to MSSQL
                            $link = mssql_connect($server, "sa", "cH3r0k33");

                            //Select the database
                            if (!$link || !mssql_select_db('ECI_SB', $link)) {
                                die('Unable to connect or select database!');
                            }
                            
                            $query2 = "SELECT distinct(client) from CLOUD_splaemsprojects ORDER BY client ASC";
                            $result1 = mssql_query($query2) or die ('Unable to run query');
                            while($row = mssql_fetch_assoc($result1)) {
                              ?>
                              <option value="<?php echo $row['client']; ?>"><?php echo $row['client']; ?></option>
                              <?php
                            }
                            mssql_free_result($result1);
                            mssql_close($link);
                          ?>
                        </select>
                      </div>
                    </div>
                  </div><!--/span-->
                </div><!--/row-->
                </div><!--/row--> 
              </div>
              <input class="btn btn-primary" value="Search" type="submit">
        		</div>
        	</form>
          <hr>
        </div>

        <?php
        

        if( isset($_POST['client'])) {

          $client = $_POST['client'];


          $server = 'AASHFAQ3500\SQLEXPRESS';

          // Connect to MSSQL
          $link = mssql_connect($server, "sa", "cH3r0k33");

          //Select the database
          if (!$link || !mssql_select_db('ECI_SB', $link)) {
              die('Unable to connect or select database!');
          }

          if ($client != ""){
            $query1 = "SELECT * FROM CLOUD_splaemsprojects WHERE client = '$client';";
            $result = mssql_query($query1, $link) or die ('Unable to run query');
          }
          $row = mssql_fetch_assoc($result);
          echo "<fieldset>";
          ?>
          <form class="form-horizontal" action="ems-projects-update.php" method="POST">
          <?php
          echo "<div class=\"span12\">";
          echo "<table class=\"table table-striped table-bordered\">";
          echo "<thead>";
          echo "<tr>";
          echo "<td> <b>Client</b> </td>";
          echo "<td> <b>Region</b> </td>";
          echo "<td> <b>PTM</b> </td>";
          echo "<td> <b>Service Team</b> </td>";
          echo "<td> <b>CRM</b> </td>";
          echo "<td> <b>Project Type</b> </td>";
          echo "<td> <b>Project Date</b> </td>";
          echo "<td> <b>Start Time</b> </td>";
          echo "<td> <b>Tunnel to EMS</b> </td>";
          echo "<td> <b>PTP Turnup</b> </td>";
          echo "<td> <b>/24 to Office Network</b> </td>";
          echo "<td> <b>/24 to DMZ/MV</b> </td>";
          echo "<td> <b>Notes</b> </td>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          echo "<tr>";
          ?>
          <td><input name="client" type="text" value="<?php echo $row['client']; ?>"></td>
          <td><input name="region" type="text" value="<?php echo $row['region']; ?>"></td>
          <td><input name="ptm" type="text" value="<?php echo $row['ptm']; ?>"></td>
          <td><input name="serviceteam" type="text" value="<?php echo $row['serviceteam']; ?>"></td>
          <td><input name="crm" type="text" value="<?php echo $row['crm']; ?>"></td>
          <td><input name="projecttype" type="text" value="<?php echo $row['projecttype']; ?>"></td>
          <td><input name="projectdate" type="text" value="<?php echo $row['projectdate']; ?>"></td>
          <td><input name="starttime" type="text" value="<?php echo $row['starttime']; ?>"></td>
          <td>
            <select name="emstunnel" style="width:150px;">
              <?php
              If($row['emstunnel'] == "Needed"){
                ?>
                <option value="Needed" selected>Needed</option>
                <option value="Not Needed">Not Needed</option>
                <option value="Completed">Completed</option>
                <?php
              }
              ElseIf($row['emstunnel'] == "Not Needed"){
                ?>
                <option value="Needed">Needed</option>
                <option value="Not Needed" selected>Not Needed</option>
                <option value="Completed">Completed</option>
                <?php
              }
              else{
                ?>
                <option value="Needed">Needed</option>
                <option value="Not Needed">Not Needed</option>
                <option value="Completed" selected>Completed</option>
                <?php
              }
              ?>
            </select> 
          </td>
          <td>
            <select name="ptpturnup" style="width:150px;">
              <?php
              If($row['ptpturnup'] == "Needed"){
                ?>
                <option value="Needed" selected>Needed</option>
                <option value="Not Needed">Not Needed</option>
                <option value="Completed">Completed</option>
                <?php
              }
              ElseIf($row['ptpturnup'] == "Not Needed"){
                ?>
                <option value="Needed">Needed</option>
                <option value="Not Needed" selected>Not Needed</option>
                <option value="Completed">Completed</option>
                <?php
              }
              else{
                ?>
                <option value="Needed">Needed</option>
                <option value="Not Needed">Not Needed</option>
                <option value="Completed" selected>Completed</option>
                <?php
              }
              ?>
            </select> 
          </td>
          <td>
            <select name="officenetwork" style="width:150px;">
              <?php
              If($row['officenetwork'] == "Needed"){
                ?>
                <option value="Needed" selected>Needed</option>
                <option value="Not Needed">Not Needed</option>
                <option value="Completed">Completed</option>
                <?php
              }
              ElseIf($row['officenetwork'] == "Not Needed"){
                ?>
                <option value="Needed">Needed</option>
                <option value="Not Needed" selected>Not Needed</option>
                <option value="Completed">Completed</option>
                <?php
              }
              else{
                ?>
                <option value="Needed">Needed</option>
                <option value="Not Needed">Not Needed</option>
                <option value="Completed" selected>Completed</option>
                <?php
              }
              ?>
            </select> 
          </td>
          <td>
            <select name="dmzmvnetwork" style="width:150px;">
              <?php
              If($row['dmzmvnetwork'] == "Needed"){
                ?>
                <option value="Needed" selected>Needed</option>
                <option value="Not Needed">Not Needed</option>
                <option value="Completed">Completed</option>
                <?php
              }
              ElseIf($row['dmzmvnetwork'] == "Not Needed"){
                ?>
                <option value="Needed">Needed</option>
                <option value="Not Needed" selected>Not Needed</option>
                <option value="Completed">Completed</option>
                <?php
              }
              else{
                ?>
                <option value="Needed">Needed</option>
                <option value="Not Needed">Not Needed</option>
                <option value="Completed" selected>Completed</option>
                <?php
              }
              ?>
            </select> 
          </td>
          <td><input name="notes" type="text" value="<?php echo $row['notes']; ?>"></td>
          <?php
          echo "</tr>";

          echo "</tbody>";
          echo "</table>";
          ?>
          <input type="hidden" value="<?php echo $row['projectId']; ?>" name="projectId" />
          <input class="btn btn-primary" value="Update" name="Update" type="submit">
          <?php
          echo "</div>";
          echo "</fieldset>";
          echo "<hr>";

          mssql_free_result($result);
          mssql_close($link);
        }
        ?>

    </body>
</html>