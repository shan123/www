<?php
require_once '/phpword/PHPWord.php';
require_once 'mail.php';
ini_set("SMTP","alertmx.eci.com");

//get variables from the html form
$employee = $_POST['employee'];
$date = $_POST['date'];
$req = $_POST['req'];
$reqtype = $_POST['reqtype'];
$other1 = $_POST['other1'];
$other2 = $_POST['other2'];
$note = $_POST['note'];
$comment = $_POST['comments'];
$meal = $_POST['meal'];

$from1 = $_POST['from1'];
$from2 = $_POST['from2'];
$from3 = $_POST['from3'];
$from4 = $_POST['from4'];
$from5 = $_POST['from5'];
$from6 = $_POST['from6'];
$from7 = $_POST['from7'];
$from8 = $_POST['from8'];
$from9 = $_POST['from9'];
$from10 = $_POST['from10'];
$from11 = $_POST['from11'];
$from12 = $_POST['from12'];
$from13 = $_POST['from13'];
$to1 = $_POST['to1'];
$to2 = $_POST['to2'];
$to3 = $_POST['to3'];
$to4 = $_POST['to4'];
$to5 = $_POST['to5'];
$to6 = $_POST['to6'];
$to7 = $_POST['to7'];
$to8 = $_POST['to8'];
$to9 = $_POST['to9'];
$to10 = $_POST['to10'];
$to11 = $_POST['to11'];
$to12 = $_POST['to12'];
$to13 = $_POST['to13'];


$server = 'AASHFAQ3500\SQLEXPRESS';

// Connect to MSSQL
$link = mssql_connect($server, "sa", "cH3r0k33");

//Select the database
if (!$link || !mssql_select_db('ECI_PAF', $link)) {
    die('Unable to connect or select database!');
}

$query = "INSERT INTO paf VALUES ('$employee', '$date', '$req', '$reqtype', '$note', '$comment', '$other1', '$other2', '$meal', '$from1', '$to1', '$from2', 
	'$to2', '$from3', '$to3', '$from4', '$to4', '$from5', '$to5', '$from6', '$to6', '$from7', '$to7', '$from8', '$to8', '$from9', '$to9', '$from10', '$to10',
	'$from11', '$to11', '$from12', '$to12', '$from13', '$to13')";
mssql_query($query) or die ('Unable to insert');


$PHPWord = new PHPWord();

// //Load the word template
$document = $PHPWord->loadTemplate('phpword/PAF_Template.docx');


if($req == "Yes") {
	$document->setValue('box2','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box','<w:sym w:font="Wingdings" w:char="FD"/>');
}
elseif($req == "No"){
	$document->setValue('box','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box2','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box2','<w:sym w:font="Wingdings" w:char="6F"/>');
}


if($reqtype == "Promotion"){
	$document->setValue('box3','<w:sym w:font="Wingdings" w:char="FD"/>');
	$document->setValue('box4','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box5','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box6','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box7','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box8','<w:sym w:font="Wingdings" w:char="6F"/>');
}
elseif($reqtype == "Transfer"){
	$document->setValue('box4','<w:sym w:font="Wingdings" w:char="FD"/>');
	$document->setValue('box3','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box5','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box6','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box7','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box8','<w:sym w:font="Wingdings" w:char="6F"/>');
}
elseif($reqtype == "Termination"){
	$document->setValue('box5','<w:sym w:font="Wingdings" w:char="FD"/>');
	$document->setValue('box4','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box3','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box6','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box7','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box8','<w:sym w:font="Wingdings" w:char="6F"/>');
}
elseif($reqtype == "Role Change"){
	$document->setValue('box6','<w:sym w:font="Wingdings" w:char="FD"/>');
	$document->setValue('box4','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box5','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box3','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box7','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box8','<w:sym w:font="Wingdings" w:char="6F"/>');
}
elseif($reqtype == "Relocation"){
	$document->setValue('box7','<w:sym w:font="Wingdings" w:char="FD"/>');
	$document->setValue('box4','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box5','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box6','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box3','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box8','<w:sym w:font="Wingdings" w:char="6F"/>');
}
elseif($reqtype == "Other"){
	$document->setValue('box8','<w:sym w:font="Wingdings" w:char="FD"/>');
	$document->setValue('box4','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box5','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box6','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box7','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box3','<w:sym w:font="Wingdings" w:char="6F"/>');
}
else{
	$document->setValue('box3','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box4','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box5','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box6','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box7','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box8','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('name', $employee);
$document->setValue('date', $date);

$document->setValue('from1', $from1);
if($from1 != ""){
	$document->setValue('box9','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box9','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('from2', $from2);
if($from2 != ""){
	$document->setValue('box10','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box10','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('from3', $from3);
if($from3 != ""){
	$document->setValue('box11','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box11','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('from4', $from4);
if($from4 != ""){
	$document->setValue('box12','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box12','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('from5', $from5);
if($from5 != ""){
	$document->setValue('box13','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box13','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('from6', $from6);
if($from6 != ""){
	$document->setValue('box14','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box14','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('from7', $from7);
if($from7 != ""){
	$document->setValue('box15','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box15','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('from8', $from8);
if($from8 != ""){
	$document->setValue('box16','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box16','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('from9', $from9);
if($from9 != ""){
	$document->setValue('box17','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box17','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('from10', $from10);
if($from10 != ""){
	$document->setValue('box20','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box20','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('from11', $from11);
if($from11 != ""){
	$document->setValue('box21','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box21','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('from12', $from12);
if($from12 != ""){
	$document->setValue('box22','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box22','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('from13', $from13);
if($from12 != ""){
	$document->setValue('box23','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box23','<w:sym w:font="Wingdings" w:char="6F"/>');
}

$document->setValue('to1', $to1);
$document->setValue('to2', $to2);
$document->setValue('to3', $to3);
$document->setValue('to4', $to4);
$document->setValue('to5', $to5);
$document->setValue('to6', $to6);
$document->setValue('to7', $to7);
$document->setValue('to8', $to8);
$document->setValue('to9', $to9);
$document->setValue('to10', $to10);
$document->setValue('to11', $to11);
$document->setValue('to12', $to12);
$document->setValue('to13', $to13);


if($meal == "add"){
	$document->setValue('box18','<w:sym w:font="Wingdings" w:char="FD"/>');
	$document->setValue('box19','<w:sym w:font="Wingdings" w:char="6F"/>');
}
elseif($meal == "remove"){
	$document->setValue('box18','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box19','<w:sym w:font="Wingdings" w:char="FD"/>');
}
else{
	$document->setValue('box18','<w:sym w:font="Wingdings" w:char="6F"/>');
	$document->setValue('box19','<w:sym w:font="Wingdings" w:char="6F"/>');
}


$document->setValue('other1', $other1);
$document->setValue('other2', $other2);
$document->setValue('comments', $comment);
$document->setValue('note', $note);

$file='PAF.docx';

$document->save('paf.docx');

$head = array(
       'to'      =>array('aashfaq@eci.com'=>'Adeel Ashfaq'),
       'from'    =>array('aashfaq@eci.com' =>'Adeel Ashfaq'),
       );
$subject = date("mdY")." Personnel Action Form";
$body ='';
$body.="<div style='font-family:Arial;font-size:10pt;'>";
$body.=    "<br>"."Adeel,";
$body.=    "<br>"."";
$body.=    "<br>"."Please check the attached file.";
$body.=    "<br>"."";
$body.=    "<br>"."-Adeel";
$body.="</div>";
$files = array($file);

//mail::send($head,$subj,$body);//$files are optional param
mail::send($head,$subject,$body, $files);


if(!$file) {     
         // File doesn't exist, output error     
         die('file not found'); 
     } 
 else {     
	?>
	<meta http-equiv="refresh" content="3;url=download.php">
	<p>Thank you! The download will start in 3 seconds. If not, use this link to download the <a href="download.php">file</a>.</p>
	<p>Click <a href="paf.html">here</a> to go back to the form.</p>
	<?php
 }
//unlink($file);

?>