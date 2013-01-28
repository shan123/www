<?php
session_start();
if(!isset($_SESSION['username'])){
header("location:login.html");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>EMS Projects</title>
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
      <form class="form-horizontal" action="ems-projects.php" method="POST">
      <legend>EMS Project Request Form</legend>
      <div class="row-fluid">
        <div class="span8">
          
          <div class="row-fluid">
            <div class="spa12 bgcolor">
              <div class="alert alert-info">
                Client Information
              </div>
            </div>
          </div> 

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="client"><b>Client Name:</b></label>
                <div class="controls">
                  <input type="text" name="client" placeholder="Client Name" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->
          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="region"><b>Region:</b></label>
                <div class="controls">
                  <select name="region" style="width:150px;">
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
                <label class="control-label" for="ptm"><b>PTM:</b></label>
                <div class="controls">
                  <input type="text" name="ptm" placeholder="PTM Name" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->
          
          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="serviceteam"><b>Service Team:</b></label>
                <div class="controls">
                  <input type="text" name="serviceteam" placeholder="Service Team" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="crm"><b>CRM:</b></label>
                <div class="controls">
                  <input type="text" name="crm" placeholder="CRM" required>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->


          <div class="row-fluid">
            <div class="spa12 bgcolor">
              <div class="alert alert-info">
                Project Information
              </div>
            </div>
          </div> 


          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="type"><b>Project Type:</b></label>
                <div class="controls">
                  <select name="type" style="width:150px;">
                    <option value="EVO to EMS">EVO to EMS</option>
                    <option value="HFH to EMS">HFH to EMS</option>
                    <option value="New Buildout">New Buildout</option>
                    <option value="Takeover to EMS">Takeover to EMS</option>
                    <option value="Service to EMS">Service to EMS</option>

                  </select>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="projectdate"><b>Project Date:</b></label>
                <div class="controls">
                  <input type="date" name="projectdate" required style="width:135px;">
                </div>
              </div>
            </div><!--/span-->
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="starttime"><b>Start Time:</b></label>
                <div class="controls">
                  <input type="time" name="starttime" required style="width:90px;">
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->


          <div class="row-fluid">
            <div class="span12 bgcolor">
              <div class="control-group">
                <label class="control-label" for="EMS Work"><b>EMS Work Required:</b></label>
                <div class="controls">
                  <input type="checkbox" name="tunnel" value="Tunnel to EMS"> Tunnel to EMS 
                  <input type="checkbox" name="ptp" value="PTP Turnup"> PTP Turnup
                  <input type="checkbox" name="officenetwork" value="Need /24 for Office Network"> Need /24 for Office Network
                  <input type="checkbox" name="dmzvmnetwork" value="Need /24 for DMZ/MV"> Need /24 for DMZ/MV
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <div class="span6 bgcolor">
              <div class="control-group">
                <label class="control-label" for="notes"><b>Notes:</b></label>
                <div class="controls">
                  <textarea rows="5" cols="50" name="notes"></textarea>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->

        

        </div><!--/span--> 
      </div><!--/row-->
      <input class="btn btn-primary" value="Submit" type="submit">
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
