<html>
  <head>
    <meta content="text/html;charset=ISO-8859-1" http-equiv="Content-Type">
    <script src="dynamic_table.js" type="text/javascript"></script>
  </head>
  <body>
    <form action="fetchrequest.php" method="POST">
      <h2>IP Sheet Generator</h2>
      <p>This is your form description. Click here to edit.</p>
      <table id="titlebar" cellspacing="4px" width="auto">
        <tbody>
          <tr>
            <td style="width:100px;">Client Name</td>
            <td><input name="client" style="width:100px;" autocomplete="on" placeholder="Client Name" required="" type="text"></td>
          </tr>
          <tr>
            <td style="width:100px;">Region</td>
            <td>
              <select name="region" style="width:100px;">
                <option value="New York">New York</option>
                <option value="Boston">Boston</option>
                <option value="chicago">Chicago</option>
              </select>
            </td>
          </tr>
          <tr>
            <td style="width:5px;"><br>
            </td>
            <td style="width:115px;">Tab Name</td>
            <td style="width:105px;">Network ID</td>
            <td style="width:100px;">Subnet Mask</td>
          </tr>
        </tbody>
      </table>
      <table id="dataTable" style="margin:-4px 2 5 10;" cellspacing="4px" width="auto">
        <tbody>
          <tr>
            <td style="width:50px;"><input name="chk" type="checkbox"></td>
            <td><input name="tab[]" style="width:150px;" autocomplete="on" placeholder="Tab Name" required="" type="text"></td>
            <td><input name="network[]" style="width:100px;" autocomplete="on" placeholder="10.10.50" required="" type="text"></td>
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
      <input value="Delete Row" onclick="deleteRow('dataTable')" type="button"> 
      <input value="Send" type="submit"> 
    </form>
  </body>
</html>