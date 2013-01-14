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

                $server = 'CONNECTDB';

                // Connect to MSSQL
                $link = mssql_connect($server, "splareporting", "splareporting");

                //Select the database
                if (!$link || !mssql_select_db('ECI_SB', $link)) {
                    die('Unable to connect or select database!');
                }

                $result = mssql_query("SELECT gpid FROM CLOUD_splaclient WHERE gpid = '$gpid'") or die ('Unable to select');
                if(mssql_num_rows($result) == 0){
                  $query = "INSERT INTO CLOUD_splaclient(gpid) values ('$gpid')";
                  mssql_query($query) or die ('Unable to insert');
                }

                $query = "SELECT clientId from CLOUD_splaclient WHERE gpid='$gpid'";
                $result = mssql_query($query) or die ('Unable to select from client table');
                $row = mssql_fetch_array($result);

                $query = "INSERT INTO CLOUD_splacheckout(clientId, submitter, chkDate) values ('$row[0]', '$submitter', '$date')";
                mssql_query($query) or die ('Unable to insert');

                
            ?>
              <h4> Congratulations!</h4>
              <p> Your order has been placed successfully.  Please find a summary of your order below: </p>
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

                      $result1 = mssql_query("SELECT gpid, product FROM CLOUD_splaclient, CLOUD_splaproducts WHERE gpid = '$gpid' and product = '$product' and CLOUD_splaclient.clientId = CLOUD_splaproducts.clientId") or die ('Unable to select');
                      if(mssql_num_rows($result1) == 0){
                        $query = "INSERT INTO CLOUD_splaproducts(clientId, product, qty) values ('$row[0]', '$product', '$qtys')";
                        mssql_query($query) or die ('Unable to insert');

                        switch($product){
                          case 'Exchange Standard':
                          echo "<li>Exchange Standard:" .   $exchangeStd  .   "</li>";
                          break;
                          case 'Exchange Enterprise':
                          echo "<li>Exchange Enterprise:" .   $exchangeEnt  .   "</li>";
                          break;
                          case 'Exchange Enterprise PLUS':
                          echo "<li>Exchange Enterprise PLUS:" .   $xchangeEntPlus  .   "</li>";
                          break;
                          case 'SQL Standard':
                          echo "<li>SQL Standard:" .   $sqlStd  .   "</li>";
                          break;
                          case 'SQL Enterprise':
                          echo "<li>SQL Enterprise:" .   $sqlEnt  .   "</li>";
                          break;
                          case 'Windows Standard':
                          echo "<li>Windows Standard:" .   $windowsStd  .   "</li>";
                          break;
                          case 'Windows Enterprise':
                          echo "<li>Windows Enterprise:" .   $windowsEnt  .   "</li>";
                          break;
                          case 'Forefront Threat Management Gateway Standard':
                          echo "<li>Forefront Threat Management Gateway Standard:" .   $forefront  .   "</li>";
                          break;
                          case 'Windows Remote Desktop Services (RDS) FKA Terminal Server':
                          echo "<li>Windows Remote Desktop Services (RDS) FKA Terminal Server:" .   $rds  .   "</li>";
                          break;
                          case 'Office Standard':
                          echo "<li>Office Standard:" .   $officeStd  .   "</li>";
                          break;
                          case 'Office Professional Plus':
                          echo "<li>Office Professional Plus:" .   $officeProPlus  .   "</li>";
                          break;
                          case 'SharePoint Enterprise (Requires Standard SharePonint License as well & SQL)':
                          echo "<li>SharePoint Enterprise (Requires Standard SharePonint License as well & SQL):" .   $sharepointEnt  .   "</li>";
                          break;
                          case 'SharePoint Standard (requires SQL)':
                          echo "<li>SharePoint Standard (requires SQL):" .   $sharepointStd  .   "</li>";
                          break;
                        }
                      }
                      else{
                        echo $product   . ": Product already exist in the database";
                      }
                    }
                    ?>
                  </ul>
              <?php
            }
          }
          ?>
          <br><br><br>
          <p>Click <a herf="http://10.3.1.1.76/ecicloud/ecicloud1.php">here</a> to go back to the form</p>
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
