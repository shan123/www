<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>PAF Reporting</title>
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
              <li><a href="/project/emsform.html">EMS Setup Form</a></li>
              <li><a href="/project/ipsheet.html">IP Sheet Generator</a></li>
              <li><a href="/project/uds.html">Universal Design Sheet</a></li>
              <li class="dropdown" id="accountmenu">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">ECI Cloud Product Checkout<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/ecicloud/ecicloud1.php">Form</a></li>
                    <li class="divider"></li>
                    <li class="active"><a href="/ecicloud/ecicloud-report.php">Report</a></li>
                </ul>
              </li>
              <li class="dropdown" id="accountmenu">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">ECI Personnel Action Form<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/project/paf.html">Form</a></li>
                    <li class="divider"></li>
                    <li class="active"><a href="/project/paf-report.php">Report</a></li>
                </ul>
              </li>
            </ul>
           </div>
        </div>
      </div>

        <div class="container-fluid">
        	<form class="form-horizontal" action="paf-report.php" method="POST">
        		<legend>PAF Reporting</legend>
        		<div class="row-fluid">
              <div class="span10">
                <div class="row-fluid">
                  <div class="span4 bgcolor">
                    <div class="control-group">
                      <label class="control-label" for="employee"><b>Employee Name:</b></label>
                      <div class="controls">
                        <select name="employee" style="width:150px;">
                          <option value=""></option>
                          <?php
                            $server = 'AASHFAQ3500\SQLEXPRESS';

                            // Connect to MSSQL
                            $link = mssql_connect($server, "sa", "cH3r0k33");

                            //Select the database
                            if (!$link || !mssql_select_db('ECI_PAF', $link)) {
                                die('Unable to connect or select database!');
                            }
                            
                            $query2 = "SELECT distinct(employee) from paf ORDER BY employee ASC";
                            $result1 = mssql_query($query2) or die ('Unable to run query');
                            while($row = mssql_fetch_assoc($result1)) {
                              echo  "<option value=".$row['employee'].">".$row['employee']."</option>";
                            }
                            mssql_free_result($result1);
                            mssql_close($link);
                          ?>
                        </select>
                      </div>
                    </div>
                  </div><!--/span-->
                  <div class="span4 bgcolor">
                    <div class="control-group">
                      <label class="control-label" for="reqtype"><b>Type of Request:</b></label>
                      <div class="controls">
                        <select name="reqtype" style="width:150px;">
                          <option value=""></option>
                          <option value="Promotion">Promotion  (upward move)</option>
                          <option value="Transfer">Transfer (cost center change)</option>
                          <option value="Termination">Termination (voluntary/involuntary)</option>
                          <option value="Role Change">Role Change (lateral move)</option>
                          <option value="Relocation">Relocation</option>
                          <option value="Other">Other</option>
                        </select>
                      </div>
                    </div>
                  </div><!--/span-->
                </div><!--/row-->
                </div><!--/row--> 
              </div>
              <input class="btn btn-primary" value="Submit" type="submit">
        		</div>
        	</form>
          <hr>
        </div>

        <?php

        if( isset($_POST['employee'])) {

          $employee = $_POST['employee'];
          $reqtype = $_POST['reqtype'];


          $server = 'AASHFAQ3500\SQLEXPRESS';

          // Connect to MSSQL
          $link = mssql_connect($server, "sa", "cH3r0k33");

          //Select the database
          if (!$link || !mssql_select_db('ECI_PAF', $link)) {
              die('Unable to connect or select database!');
          }

          if ($employee == "" AND $reqtype =="") {
            $query1 = "SELECT * FROM paf;";
            $result = mssql_query($query1, $link) or die ('Unable to run query');
          }
          if ($reqtype != ""){
            $query1 = "SELECT * FROM paf WHERE req_type = '$reqtype';";
            $result = mssql_query($query1, $link) or die ('Unable to run query');
          }
          if ($employee != ""){
            $query1 = "SELECT * FROM paf WHERE employee = '$employee';";
            $result = mssql_query($query1, $link) or die ('Unable to run query');
          }
          echo "<fieldset>";
          echo "<div class=\"span12\">";
          echo "<table class=\"table table-striped table-bordered\">";
          echo "<thead>";
          echo "<tr>";
          echo "<td> <b>Employee</b> </td>";
          echo "<td> <b>Date</b> </td>";
          echo "<td> <b>Reqyest Type</b> </td>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          while($row = mssql_fetch_array($result)) {
            echo "<tr>";
            echo "<td>"   .   $row[1]   .   "</td>";
            echo "<td>"   .   $row[2]   .   "</td>";
            echo "<td>"   .   $row[4]   .   "</td>";
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