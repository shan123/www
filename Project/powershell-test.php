<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Powershell</title>
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
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
    });
    </script>
    <script src="js/dynamic_table_ip.js"></script>
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
                    <li class="active"><a href="/project/ems-projects-main.php">EMS Project Request Form</a></li>
                    <li><a href="/project/ems-projects-edit.php">Update Exisiting Request</a></li>
                    <li><a href="/project/ems-projects-reporting.php">Reporting</a></li>
                </ul>
              </li>
              <li><a href="logout.php">Logout</a></li>
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
      <form class="form-horizontal" action="powershell-test.php" method="POST">
      <legend>Powershell</legend>
      <div class="row-fluid">
        <div class="span8">
          
          <div class="row-fluid">
            <div class="spa12 bgcolor">
              <div class="alert alert-info">
                Create a Single User 
              </div>
            </div>
          </div> 

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="script"><b>Choose a script to run:</b></label>
                <div class="controls">
                  <select name="script" style="width:220px;">
                  	<option value="createsingleuserfunction">createsingleuserfunction.ps1</option>
                  </select>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="firstname"><b>FirstName:</b></label>
                <div class="controls">
                  <input type="text" name="firstname" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="lastname"><b>LastName:</b></label>
                <div class="controls">
                  <input type="text" name="lastname" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="password"><b>Password:</b></label>
                <div class="controls">
                  <input type="text" name="password" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="fqdn"><b>ClientDCfqdn:</b></label>
                <div class="controls">
                  <input type="text" name="fqdn" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="smtp"><b>PrimarySMTP:</b></label>
                <div class="controls">
                  <input type="text" name="smtp" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="activesync"><b>ActiveSync:</b></label>
                <div class="controls">
                  <select name="activesync" style="width:75px;">
                  	<option value="Yes">Yes</option>
                  	<option value="No">No</option>
                  </select>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="vpn"><b>VPN:</b></label>
                <div class="controls">
                  <select name="vpn" style="width:75px;">
                  	<option value="Yes">Yes</option>
                  	<option value="No">No</option>
                  </select>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="connectwise"><b>ConnectwiseID:</b></label>
                <div class="controls">
                  <input type="text" name="connectwise" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="clipassword"><b>Eciadmin Password for client domain:</b></label>
                <div class="controls">
                  <input type="text" name="clipassword" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->



        </div><!--/span--> 
      </div><!--/row-->
      <input class="btn btn-primary" name="submit" value="Submit" type="submit">
      </form>

    <hr>

      <footer>
        <a></a>
      </footer>

    </div><!--/.fluid-container-->
    

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>


<?php

if((isset($_POST["submit"])))
{
    // Get the variables submitted by POST in order to pass them to the Powershell script:
    $script = $_POST["script"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $password = $_POST["password"];
    $fqdn = $_POST["fqdn"];
    $smtp = $_POST["smtp"];
    $activesync = $_POST["activesync"];
    $vpn = $_POST["vpn"];
    $connectwise = $_POST["connectwise"];
    $clipassword = $_POST["clipassword"];

    $args = "$firstname" . " " . "$lastname" . " " . "$password" . " " . "$fqdn" . " " . "$smtp" . " " . "$activesync" . " " . "$vpn" . " " . "$connectwise" . " " . 
    		"$clipassword";
    // Best practice tip: We run out POST data through a custom regex function to clean any unwanted characters, e.g.:
    // $username = cleanData($_POST["username"]);
         
    

    // if(!empty($_POST["command"])){
    // 	// Execute the Powershell script, passing the parameters:
	   //  $query = shell_exec("powershell -command \"$command\" < NUL");
	   //  echo "<pre>$query</pre>"; 
    // }
	if(!empty($_POST["script"])){
		if($script=="createsingleuserfunction"){

			// Path to the Powershell script. Remember double backslashes:
    		$psScriptPath = "C:\\wamp\\www\\project\\scripts\\createsingleuserfunction.ps1";

    		echo "Script Path: " . $psScriptPath;
    		echo "<br>";
    		echo "Args: " . $args;

			// // Execute the Powershell script, passing the parameters:
		 //    $query = shell_exec("powershell -command $psScriptPath $command < NUL");
		 //    echo "<pre>$query</pre>"; 
		}
    } 
    
}


?>
