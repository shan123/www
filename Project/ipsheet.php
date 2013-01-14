<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>IP Sheet Generator</title>
    <link rel="stylesheet" type="text/css" href="view.css" media="all" />
    <script type="text/javascript" src="view.js"></script>
    <script type="text/javascript" src="dynamic_table.js"></script>
  </head>
  <body id="main_body"> <img id="top" src="top.png" alt="" />
    <div id="form_container">
      <h1><a>IP Sheet Generator</a></h1>
    <form class="appnitro" action="fetchrequest.php" method="POST">
    <div class="form_description">
      <h2>IP Sheet Generator</h2>
      <p></p>
    </div>  
      <table id="titlebar"  cellspacing="4px" width="auto">
        <tbody>
          <tr>
            <td style="width:100px;"><b>Client Name:</b></td>
            <td><input name="client" style="width:100px;" autocomplete="on" placeholder="Client Name" required="" type="text"></td>
          </tr>
          <tr>
            <td style="width:100px;"><b>Region:</b></td>
            <td>
              <select name="region" style="width:100px;">
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
            </td>
          </tr>
          <tr>
            <td></td>
            <td style="width:155px;"><b>Tab Name</b></td>
            <td style="width:105px;"><b>IP Address</b></td>
            <td style="width:100px;"><b>Subnet Mask</b></td>
          </tr>
        </tbody>
      </table>
      <table id="dataTable" style="margin:-4px 0 0 0;" cellspacing="4px" width="auto">
        <tbody>
          <tr>
            <td style="width:100px;"><input name="chk" type="checkbox"></td>
            <td><input name="tab[]" style="width:150px;" autocomplete="on" placeholder="Tab Name" required="" type="text"></td>
            <td><input name="ip[]" style="width:100px;" autocomplete="on" placeholder="10.10.50.0" required="" type="text"></td>
            <td>
              <select name="subnet[]" style="width:100px;">
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
      <input value="Add Row" onclick="addRow('dataTable')" type="button"> 
      <input value="Delete Row" onclick="deleteRow('dataTable')" type="button"> <br><br>
      <input value="Submit" type="submit"> 
    </form>
      <div id="footer">
        <a>Created by Adeel Ashfaq</a>
      </div>
    </div>
    <img id="bottom" src="bottom.png" alt="" />
  </body>
</html>
