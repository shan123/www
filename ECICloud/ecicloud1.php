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
                        $query1 = "SELECT distinct(gpid) FROM CLOUD_ResourcePools ORDER BY gpid ASC";
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
                        $query1 = "SELECT distinct(gpid) FROM CLOUD_ResourcePools ORDER BY gpid ASC";
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
                <label class="control-label" for="clientname"><b>Client Name:</b></label>
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
                      // get the name of the client 
                      $query1 = "SELECT max(cwwebapp_eci.dbo.company.Company_Name) AS clientname
                                  FROM ECI_SB.dbo.CLOUD_ResourcePools 
                                  LEFT JOIN cwwebapp_eci.dbo.company ON cwwebapp_eci.dbo.company.Account_Nbr=CLOUD_ResourcePools.gpid
                                  WHERE gpid = '$gpid'";
                      $result = mssql_query($query1) or die ('Unable to run query');
                      while($row = mssql_fetch_array($result)) {
                        echo "<p>";
                        echo  $row[0];
                        echo "</p>";
                        echo "<input type=\"hidden\" value=\"$row[0]\" name=\"clientname\">";
                      }
                      mssql_free_result($result);
                      mssql_close($link);
                    }
                    ?>
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
                      $query1 = "SELECT Product FROM CLOUD_ContractedTiles WHERE gpid = '$gpid'";
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
                    <option value="Access 2010">Access 2010</option>
                    <option value="Access 2013">Access 2013</option>
                    <option value="Excel 2010">Excel 2010</option>
                    <option value="Excel 2013">Excel 2013</option>
                    <option value="InfoPath 2010">InfoPath 2010</option>
                    <option value="InfoPath 2013">InfoPath 2013</option>
                    <option value="Lync 2013">Lync 2013</option>
                    <option value="Office Professional Plus 2010">Office Professional Plus 2010</option>
                    <option value="Office Professional Plus 2013">Office Professional Plus 2013</option>
                    <option value="Office Standard 2010">Office Standard 2010</option>
                    <option value="Office Standard 2013">Office Standard 2013</option>
                    <option value="OneNote 2010">OneNote 2010</option>
                    <option value="OneNote 2013">OneNote 2013</option>
                    <option value="Outlook 2010">Outlook 2010</option>
                    <option value="Outlook 2013">Outlook 2013</option>
                    <option value="PowerPoint 2010">PowerPoint 2010</option>
                    <option value="PowerPoint 2013">PowerPoint 2013</option>
                    <option value="Project Professional 2010">Project Professional 2010</option>
                    <option value="Project Professional 2013">Project Professional 2013</option>
                    <option value="Project Standard 2010">Project Standard 2010 - Project 2010</option>
                    <option value="Project Standard 2013">Project Standard 2013</option>
                    <option value="Publisher 2010">Publisher 2010</option>
                    <option value="Publisher 2013">Publisher 2013</option>
                    <option value="Word 2010">Word 2010</option>
                    <option value="Word 2013">Word 2013</option>
                    <option value="SharePoint Workspace 2010">SharePoint Workspace 2010</option>
                    <option value="VDA 7 - Windows 7 Enterprise">VDA 7 - Windows 7 Enterprise</option>
                    <option value="VDA 8 - Windows 8 Enterprise">VDA 8 - Windows 8 Enterprise</option>
                    <option value="Visio Premium 2010">Visio Premium 2010</option>
                    <option value="Visio Professional 2010">Visio Professional 2010</option>
                    <option value="Visio Professional 2013">Visio Professional 2013</option>
                    <option value="Visio Standard 2010">Visio Standard 2010</option>
                    <option value="Visio Standard 2013">Visio Standard 2013</option>
                    <option value="Windows 7 Enterprise">Windows 7 Enterprise</option>
                    <option value="Windows 7 Professional">Windows 7 Professional</option>
                    <option value="Windows 8 Enterprise">Windows 8 Enterprise</option>
                    <option value="Windows 8 Professional">Windows 8 Pro - Windows 8 Professional</option>
                    <option value="Windows MultiPoint Server Standard 2011">Windows MultiPoint Server Standard 2011</option>
                    <option value="Windows Server 2012 Essentials">Windows Server 2012 Essentials</option>
                    <option value="Windows Server Enterprise 2008">Windows Server Enterprise 2008</option>
                    <option value="Windows Server Enterprise 2008 R2">Windows Server Enterprise 2008 R2</option>
                    <option value="Windows Server Standard 2008">Windows Server Standard 2008</option>
                    <option value="Windows Server Standard 2008 R2">Windows Server Standard 2008 R2</option>
                    <option value="Windows Server Standard 2012">Windows Server Standard 2012</option>
                    <option value="Windows Web Server 2008">Windows Web Server 2008</option>
                    <option value="Windows Web Server 2008 R2">Windows Web Server 2008 R2</option>
                    <option value="Windows Web Server 2008 with Service Pack 2">Windows Web Server 2008 with Service Pack 2</option>
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
