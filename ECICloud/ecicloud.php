<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ECI Cloud Product Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet">
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
      <legend>ECI Cloud Product Checkout</legend>
      <div class="span10">
        <div class="hero-unit">
          <div class="well">
          <?php
            include 'products.php';
            if(isset($_POST['gpid'])){
              if($_POST['gpid'] == ""){
                echo "Please select a gpid...going back to the main page in 3 seconds.";
                echo ('<meta http-equiv="refresh" content="3;url=ecicloud1.php">');
              }
              else{
                $gpid = $_POST['gpid'];
                $submitter = $_POST['submitter'];
                $date = $_POST['date'];
                $eciproducts = $_POST['ezeproducts'];
                $products = $_POST['products'];
                $qty = $_POST['qty'];
                $clientname = $_POST['clientname'];

                $server = 'CONNECTDB';

                // Connect to MSSQL
                $link = mssql_connect($server, "splareporting", "splareporting");

                //Select the database
                if (!$link || !mssql_select_db('ECI_SB', $link)) {
                    die('Unable to connect or select database!');
                }

                $result = mssql_query("SELECT gpid FROM CLOUD_splaclient WHERE gpid = '$gpid'") or die ('Unable to select');
                if(mssql_num_rows($result) == 0){
                  $query = "INSERT INTO CLOUD_splaclient(gpid) VALUES ('$gpid')";
                  mssql_query($query) or die ('Unable to insert');
                }

                $query = "SELECT clientId from CLOUD_splaclient WHERE gpid='$gpid'";
                $result = mssql_query($query) or die ('Unable to select from client table');
                $row = mssql_fetch_array($result);

                $query = "INSERT INTO CLOUD_splacheckout(clientId, submitter, chkDate) VALUES ('$row[0]', '$submitter', '$date')";
                mssql_query($query) or die ('Unable to insert');

                $getlastid_query = "SELECT MAX(checkoutId) FROM CLOUD_splacheckout";
                $id_result = mssql_query($getlastid_query) or die ('Unable to insert');
                $id_row = mssql_fetch_row($id_result);
                
            ?>
              <h4g> Congratulations!</h4>
              <p> Your order has been placed successfully.  Please find a summary of your order below: </p>
                <p><span stype="color:blue"><strong>Client Name:</strong></span><?php echo $clientname ?></p>
                <p><span style="color:blue"><strong>GPID:</strong></span> <?php echo $gpid ?> </p>
                <p><span style="color:blue"><strong>ECI Products:</strong></span></p>
                  <ul>
                    <?php
                      echo "<li>" .   $eciproducts  .   "</li>";
                    ?>
                  </ul>
                <p><span style="color:blue"><strong>Other Products:</strong></span></p>
                  <ul>
                    <?php
                    for($i = 0; $i < count($products); $i++){
                      $product = $products[$i];
                      $qtys = $qty[$i];

                      switch($product){
                        case 'Access 2010':
                        echo "<li>Access 2010:" .   $access2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$access2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Access 2013':
                        echo "<li>Access 2013:" .   $access2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$access2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Excel 2010':
                        echo "<li>Excel 2010:" .   $excel2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$excel2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Excel 2013':
                        echo "<li>Excel 2013:" .   $excel2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$excel2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'InfoPath 2010':
                        echo "<li>InfoPath 2010:" .   $infopath2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$infopath2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'InfoPath 2013':
                        echo "<li>InfoPath 2013:" .   $infopath2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$infopath2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Lync 2013':
                        echo "<li>Lync 2013:" .   $lync2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$lync2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Office Professional Plus 2010':
                        echo "<li>Office Professional Plus 2010:" .   $officeProPlus2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$officeProPlus2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Office Professional Plus 2013':
                        echo "<li>Office Professional Plus 2013:" .   $officeProPlus2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$officeProPlus2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Office Standard 2010':
                        echo "<li>Office Standard 2010:" .   $officeStd2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$officeStd2010 ')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Office Standard 2013':
                        echo "<li>Office Standard 2013:" .   $officeStd2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$officeStd2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'OneNote 2010':
                        echo "<li>OneNote 2010:" .   $onenote2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$onenote2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'OneNote 2013':
                        echo "<li>OneNote 2013:" .   $onenote2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$onenote2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Outlook 2010':
                        echo "<li>Outlook 2010:" .   $outlook2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$outlook2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Outlook 2013':
                        echo "<li>Outlook 2013:" .   $outlook2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$outlook2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'PowerPoint 2010':
                        echo "<li>PowerPoint 2010:" .   $powerpoint2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$powerpoint2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'PowerPoint 2013':
                        echo "<li>PowerPoint 2013:" .   $powerpoint2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$powerpoint2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Project Professional 2010':
                        echo "<li>Project Professional 2010:" .   $projectPro2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$projectPro2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Project Professional 2013':
                        echo "<li>Project Professional 2013:" .   $projectPro2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$projectPro2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Project Standard 2010':
                        echo "<li>Project Standard 2010:" .   $projectStd2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$projectStd2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Project Standard 2013':
                        echo "<li>Project Standard 2013:" .   $projectStd2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$projectStd2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Publisher 2010':
                        echo "<li>Publisher 2010:" .   $publisher2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$publisher2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Publisher 2013':
                        echo "<li>Publisher 2013:" .   $publisher2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$publisher2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'SharePoint Workspace 2010':
                        echo "<li>SharePoint Workspace 2010:" .   $sharepoint2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$sharepoint2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'VDA 7 - Windows 7 Enterprise':
                        echo "<li>VDA 7 - Windows 7 Enterprise:" .   $vda7  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$vda7')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'VDA 8 - Windows 8 Enterprise':
                        echo "<li>VDA 8 - Windows 8 Enterprise:" .   $vda8  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$vda8')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Visio Premium 2010':
                        echo "<li>Visio Premium 2010:" .   $visioPre2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$visioPre2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Visio Professional 2010':
                        echo "<li>Visio Professional 2010:" .   $visioPro2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$visioPro2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Visio Professional 2013':
                        echo "<li>Visio Professional 2013:" .   $visioPro2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$visioPro2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Visio Standard 2010':
                        echo "<li>Visio Standard 2010:" .   $visioStd2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$visioStd2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Visio Standard 2013':
                        echo "<li>Visio Standard 2013:" .   $visioStd2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$visioStd2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows 7 Enterprise':
                        echo "<li>Windows 7 Enterprise:" .   $win7Ent  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$win7Ent')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows 7 Professional':
                        echo "<li>Windows 7 Professional:" .   $win7Pro  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$win7Pro')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows 8 Professional':
                        echo "<li>Windows 8 Professional:" .   $win8Pro  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$win8Pro')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows 8 Enterprise':
                        echo "<li>Windows 8 Enterprise:" .   $win8Ent  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$win8Ent')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows MultiPoint Server Standard 2011':
                        echo "<li>Windows MultiPoint Server Standard 2011:" .   $winMultipoint2011  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$winMultipoint2011')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows Server 2012 Essentials':
                        echo "<li>Windows Server 2012 Essentials:" .   $winEssentials2012  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$winEssentials2012')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows Server Enterprise 2008':
                        echo "<li>Windows Server Enterprise 2008:" .   $srvEnt2008  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$srvEnt2008')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows Server Enterprise 2008 R2':
                        echo "<li>Windows Server Enterprise 2008 R2:" .   $srvEnt2008R2  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$srvEnt2008R2')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows Server Standard 2008':
                        echo "<li>Windows Server Standard 2008:" .   $srvStd2008  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$srvStd2008')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows Server Standard 2008 R2':
                        echo "<li>Windows Server Standard 2008 R2:" .   $srvStd2008R2  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$srvStd2008R2')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows Server Standard 2012':
                        echo "<li>Windows Server Standard 2012:" .   $srvStd2012  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$srvStd2012')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows Web Server 2008':
                        echo "<li>Windows Web Server 2008:" .   $srvWeb2008  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$srvWeb2008')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows Web Server 2008 R2':
                        echo "<li>Windows Web Server 2008 R2:" .   $srvWeb2008R2  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$srvWeb2008R2')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Windows Web Server 2008 with Service Pack 2':
                        echo "<li>Windows Web Server 2008 with Service Pack 2:" .   $srvWeb2008SP2  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$srvWeb2008SP2')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Word 2010':
                        echo "<li>Word 2010:" .   $word2010  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$word2010')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                        case 'Word 2013':
                        echo "<li>Word 2013:" .   $word2013  .   "</li>";
                        $query = "INSERT INTO CLOUD_splaproducts(checkoutId, product, qty, SerialNumber) VALUES ('$id_row[0]', '$product', '$qtys', '$word2013')";
                        mssql_query($query) or die ('Unable to insert');
                        break;
                      }
                    }
                    ?>
                  </ul>
              <?php
            }
          }
          ?>
          <br><br><br>
          <p>Click <a herf="http://10.3.1.76/ecicloud/ecicloud1.php/">here</a> to go back to the form</p>
        </div>
        </div>
      </div>
    </div>
    

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.8.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/dynamic_table.js"></script>
  </body>
</html>
