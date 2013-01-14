<!DOCTYPE html>   
<html lang="en">   
<head>   
<meta charset="utf-8">   
<title>Twitter Bootstrap Version2.0 horizontal form layout example</title>   
<meta name="description" content="Twitter Bootstrap Version2.0 horizontal form layout example from w3resource.com.">   
<link href="twitter-bootstrap-v2/docs/assets/css/bootstrap.css" rel="stylesheet">  
</head>  
<body>  
<div class="row-fluid">
<form id="myForm" modelAttribute="mymodel">
    <div class="span12">
        <div class="well clearfix">
            <div class="span5">
                <legend>Text1</legend>          
                    <table width="100%" align="center">
                        <tr>
                            <td>
                                <label for="lable1">Label1 *</label>
                            </td>
                            <td>        
                                <input id="input1" class="input-xlarge"/>
                            </td>                       
                        </tr>           
                        <tr>
                            <td>
                                <label for="lable2">Label2 *</label>
                            </td>
                            <td>        
                                <input id="input2" class="input-xlarge"/>
                            </td>                       
                        </tr>
                        <tr>
                                <td colspan=2 align="center">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <button class="btn" type="reset" id="resetButton">Reset</button>
                                </td>
                        </tr>
                    </table>
            </div>
            <div class="span5 offset1">
                <legend>Text2</legend>                 
            </div>
        </div>
    </div>
</form>
</body>  
</html>  