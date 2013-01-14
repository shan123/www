<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ECI Cloud Product Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/jquery-1.8.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
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
    <script type="text/javascript">   
      function getID(f)   
      {   
      var gpid;  
      gpid = f.gpid.options[f.gpid.selectedIndex].value; 
      location.replace( 'ecicloud1.php?gpid='+ gpid );
      }   
    </script>
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
                    <li class="active"><a href="/ecicloud/ecicloud1.php">Form</a></li>
                    <li class="divider"></li>
                    <li><a href="/ecicloud/ecicloud-report.php">Report</a></li>
                </ul>
              </li>
            </ul>
           </div>
        </div>
      </div>

      <!--[if IE]>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          This web page works <strong>best</strong> in Chrome!!
      </div>
      <![endif]-->
    <div class="container-fluid">      
      <form class="form-horizontal" action="ecicloud.php" method="POST">
      <legend>ECI Cloud Product Checkout</legend>
      <div class="row-fluid">
        <div class="span8">

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="gpid"><b>GPID</b></label>
                <div class="controls">
                  <select name="gpid" style="width:150px;" onChange="getID(this.form);">
                    <option value=""></option>
                    <?php
                      if(isset($_GET['gpid'])){
                        $server = 'CONNECTDB';

                        // Connect to MSSQL
                        $link = mssql_connect($server, "splareporting", "splareporting");

                        //Select the database
                        if (!$link || !mssql_select_db('ECI_SB', $link)) {
                            die('Unable to connect or select database!');
                        }
                        $query1 = "SELECT distinct(gpid) from CLOUD_ResourcePools ORDER BY gpid ASC";
                        $result = mssql_query($query1) or die ('Unable to run query');
                        $gpid = $_GET['gpid'];
                        while($row = mssql_fetch_assoc($result)) {
                          ?>
                          <option <?php if($row['gpid']==$gpid){echo "selected=\"selected\"";}?>value="<?php echo $row['gpid'];?>"><?php echo $row['gpid'];?></option>
                          <?php
                        }
                        echo "</select>";
                        mssql_free_result($result);
                        mssql_close($link);
                      }
                      else{
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
                      }
                      ?>
                  </select>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid"> 
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="submitter"><b>Submitter Name:</b></label>
                <div class="controls">
                  <input type="text" name="submitter" placeholder="Submitter Name" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="date"><b>Date:</b></label>
                <div class="controls">
                  <input type="date" name="date" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="ezeproducts"><b>ECI Product Offerings:</b></label>
                <div class="controls">
                    <?php
                    if(isset($_GET['gpid'])){
                      $server = 'CONNECTDB';

                      // Connect to MSSQL
                      $link = mssql_connect($server, "splareporting", "splareporting");

                      //Select the database
                      if (!$link || !mssql_select_db('ECI_SB', $link)) {
                          die('Unable to connect or select database!');
                      }
                      $gpid = $_GET['gpid'];
                      $query1 = "SELECT Product from CLOUD_ContractedTiles WHERE gpid = '$gpid'";
                      $result = mssql_query($query1) or die ('Unable to run query');
                      while($row = mssql_fetch_array($result)) {
                        echo "<p>";
                        echo  $row[0];
                        echo "</p>";
                        echo "<input type=\"hidden\" value=\"$row[0]\" name=\"ezeproducts\">";
                      }
                      mssql_free_result($result);
                      mssql_close($link);
                    }
                    ?>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->
          

          <fieldset>
            <table id="dataTable" class="table">
              <thead>
                <tr>
                  <td> </td>
                  <td> <b>Product Name</b> </td>
                  <td> <b>Quantity</b> </td>
                </tr>
              </thead>
              <tbody>
                <tr>
                <td><input name="chk[]" type="checkbox"></td>
                <td>
                  <select name="products[]">
                    <option value="Exchange Standard">Exchange Standard</option>
                    <option value="Exchange Enterprise">Exchange Enterprise</option>
                    <option value="Exchange Enterprise PLUS">Exchange Enterprise PLUS</option>
                    <option value="SQL Standard">SQL Standard</option>
                    <option value="SQL Enterprise">SQL Enterprise</option>
                    <option value="Windows Standard">Windows Standard</option>
                    <option value="Windows Enterprise">Windows Enterprise</option>
                    <option value="Forefront Threat Management Gateway Standard">Forefront Threat Management Gateway Standard</option>
                    <option value="Windows Remote Desktop Services (RDS)">Windows Remote Desktop Services (RDS) FKA Terminal Server</option>
                    <option value="Office Standard">Office Standard</option>
                    <option value="Office Professional Plus">Office Professional Plus</option>
                    <option value="SharePoint Enterprise">SharePoint Enterprise (Requires Standard SharePonint License as well & SQL)</option>
                    <option value="SharePoint Standard">SharePoint Standard (requires SQL)</option>
                  </select>
                </td>
                <td><input name="qty[]" type="text" autocomplete="on" required></td>
              </tr>
              </tbody>
            </table>
            <p class="text-error">**Only use the checkbox when deleting a row</p>
            <input value="Add Row" onclick="addRow('dataTable')" type="button" class="btn"> 
            <input value="Delete Row" onclick="deleteRow('dataTable')" type="button" class="btn btn-danger"> <br><br>
          </fieldset>                        
        </div><!--/span--> 

      </div><!--/row-->
      <button class="btn btn-primary" type="submit"><img src="img/png/glyphicons_209_cart_in.png" height="24" width="26">Checkout</button>
      </form>

    <hr>

      <footer>
        <a></a>
      </footer>

    </div><!--/.fluid-container-->
    

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <script src="js/dynamic_table.js"></script>
  </body>
</html>
