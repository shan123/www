<?php
require_once 'phpword/PHPWord.php';

$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('phpword/PAF_Template.docx');

$document->setValue('name', 'Adeel Ashfaq');
$document->setValue('date', '12/12/12');
$document->setValue('from1', 'test');
$document->setValue('from2', 'Earth');
$document->setValue('from3', 'Mars');
$document->setValue('from4', 'Jupiter');
$document->setValue('from5', 'Saturn');
$document->setValue('from6', 'Uranus');
$document->setValue('from7', 'Neptun');
$document->setValue('from8', 'Pluto');
$document->setValue('box','<w:sym w:font="Wingdings" w:char="FD"/>');
$document->setValue('box2','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box3','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box4','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box5','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box6','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box7','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box8','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box9','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box10','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box11','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box12','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box13','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box14','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box15','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box16','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box17','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box18','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box19','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box20','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box21','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box22','<w:sym w:font="Wingdings" w:char="6F"/>');
$document->setValue('box23','<w:sym w:font="Wingdings" w:char="6F"/>');

$document->setValue('comments', 'asfdasdfsafdsdffafsfasfdsafdsfdsafsafdsgdsagdsgdghsahshsdsgdgddasdsfdsafdafsdafsafdd');

$file='Solarsystem.docx';

$document->save('Solarsystem.docx');
//  if(!$file) {     
//          // File doesn't exist, output error     
//          die('file not found'); 
//      } 
//  else {     
//      header("Cache-Control: public");     
//      header("Content-Description: File Transfer");     
//      header("Content-Disposition: attachment; filename=$file");     
//      header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");     
//      header("Content-Transfer-Encoding: binary");         

//      readfile($file); 
// }

//  unlink($file);

// exit;
?>