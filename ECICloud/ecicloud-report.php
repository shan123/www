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
            </ul>
           </div>
        </div>
      </div>

        <div class="container-fluid">
        	<form class="form-horizontal" action="ecicloud-report.php" method="POST">
        		<legend>Cloud Products Reporting</legend>
        		<div class="row-fluid">
              <div class="span8">
                <div class="row-fluid">
                  <div class="span6 bgcolor">
                    <div class="control-group">
                      <label class="control-label" for="gpid"><b>GPID:</b></label>
                      <div class="controls">
                        <select name="gpid" style="width:150px;">
                          <option value=""></option>
                          <?php
                            $server = 'CONNECTDB';

                            // Connect to MSSQL
                            $link = mssql_connect($server, "splareporting", "splareporting");

                            //Select the database
                            if (!$link || !mssql_select_db('ECI_SB', $link)) {
                                die('Unable to connect or select database!');
                            }
                            $query1 = "SELECT distinct(gpid) from CLOUD_ResourcePools ORDER BY gpid ASC";
                            $result = mssql_query($query1) or die ('Unable to run query');
                            while($row = mssql_fetch_assoc($result)) {
                              echo  "<option value=".$row['gpid'].">".$row['gpid']."</option>";
                            }
                            echo "</select>";
                            mssql_free_result($result);
                            mssql_close($link);
                          ?>
                        </select>
                      </div>
                    </div>
                  </div><!--/span-->
                  <div class="span6 bgcolor">
                    <div class="control-group">
                      <label class="control-label" for="ezeproducts"><b>ECI Product Offering:</b></label>
                      <div class="controls">
                        <select name="ezeproducts" style="width:150px;">
                          <option value=""></option>
                          <option value="EMI">EMI</option>
                          <option value="EMI w/DR">EMI w/DR</option>
                          <option value="EMS">EMS</option>
                          <option value="EMS/EMI DR">EMS/EMI DR</option>
                          <option value="EVO">EVO</option>
                          <option value="EVO w/DR">EVO w/DR</option>
                          <option value="EVO 1">EVO 1</option>
                          <option value="Eze DR">Eze DR</option>
                          <option value="HFH">HFH</option>
                          <option value="Hosted OMS">Hosted OMS</option>
                          <option value="Hosted OMS w/DR">Hosted OMS w/DR</option>
                          <option value="Ledgex">Ledgex</option>
                          <option value="SAN to Cloud">SAN to Cloud</option>
                          <option value="Tiger">Tiger</option>
                          <option value="Unallocated">Unallocated</option>
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

        if( isset($_POST['gpid'])) {

          $gpid = $_POST['gpid'];
          $eciproducts = $_POST['ezeproducts'];


          $server = 'CONNECTDB';

          // Connect to MSSQL
          $link = mssql_connect($server, "splareporting", "splareporting");

          //Select the database
          if (!$link || !mssql_select_db('ECI_SB', $link)) {
              die('Unable to connect or select database!');
          }

          if ($gpid == "" AND $eciproducts =="") {
            $query1 = "SELECT DISTINCT gpid, productId, product, qty, submitter, chkDate FROM CLOUD_splaclient, CLOUD_splaproducts, CLOUD_splacheckout WHERE CLOUD_splaclient.clientId = CLOUD_splaproducts.clientId AND CLOUD_splaclient.clientId = CLOUD_splacheckout.clientId;
";
            $result = mssql_query($query1, $link) or die ('Unable to run query');
          }
          if ($gpid != ""){
            $query1 = "SELECT DISTINCT gpid, productId, product, qty, submitter, chkDate FROM CLOUD_splaclient, CLOUD_splaproducts, CLOUD_splacheckout WHERE gpid = '$gpid' AND CLOUD_splaclient.clientId = CLOUD_splaproducts.clientId AND CLOUD_splaclient.clientId = CLOUD_splacheckout.clientId;
";
            $result = mssql_query($query1, $link);
          }

          if($eciproducts == ""){
            echo "<fieldset>";
            echo "<div class=\"span12\">";
            echo "<table class=\"table table-striped table-bordered\">";
            echo "<thead>";
            echo "<tr>";
            echo "<td> <b>GPID</b> </td>";
            echo "<td> <b>Eze Products</b> </td>";
            echo "<td> <b>Other Products</b> </td>";
            echo "<td> <b>Quantity</td>";
            echo "<td> <b>Submitter Name</td>";
            echo "<td> <b>Date</td>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mssql_fetch_array($result)) {
              echo "<tr>";
              echo "<td>"   .   $row[0]   .   "</td>";
              $query3 = "SELECT Product from CLOUD_ContractedTiles WHERE gpid = '$row[0]'";
              $result3 = mssql_query($query3) or die ('Unable to run query');
              while($row3 = mssql_fetch_array($result3)) {
                echo  "<td>"  . $row3[0]  .   "</td>";
              }
              echo "<td>"   .   $row[2]   .   "</td>";
              echo "<td>"   .   $row[3]   .   "</td>";
              echo "<td>"   .   $row[4]   .   "</td>";
              echo "<td>"   .   $row[5]   .   "</td>";
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
          else{
            $query = "SELECT gpid FROM CLOUD_ContractedTiles WHERE Product = '$eciproducts'";
            $result = mssql_query($query, $link);
            echo "<fieldset>";
            echo "<div class=\"span12\">";
            echo "<table class=\"table table-striped table-bordered\">";
            echo "<thead>";
            echo "<tr>";
            echo "<td> <b>GPID</b> </td>";
            echo "<td> <b>Eze Products</b> </td>";
            echo "<td> <b>Other Products</b> </td>";
            echo "<td> <b>Quantity</td>";
            echo "<td> <b>Submitter Name</td>";
            echo "<td> <b>Date</td>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mssql_fetch_array($result)) {
              $query1 = "SELECT DISTINCT gpid, productId, product, qty, submitter, chkDate FROM CLOUD_splaclient, CLOUD_splaproducts, CLOUD_splacheckout WHERE gpid = '$row[0]' AND CLOUD_splaclient.clientId = CLOUD_splaproducts.clientId AND CLOUD_splaclient.clientId = CLOUD_splacheckout.clientId";
              $result1 = mssql_query($query1, $link);
              while($row1 = mssql_fetch_array($result1)){
                echo "<tr>";
                echo "<td>"   .   $row1[0]   .   "</td>";
                echo "<td>"   .   $eciproducts  . "</td>";
                echo "<td>"   .   $row1[2]   .   "</td>";
                echo "<td>"   .   $row1[3]   .   "</td>";
                echo "<td>"   .   $row1[4]   .   "</td>";
                echo "<td>"   .   $row1[5]   .   "</td>";
                echo "</tr>";
              }
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</fieldset>";
            echo "<hr>";
          }
        }
        ?>

    </body>
</html>