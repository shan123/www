<?php
// Get a file into an array.  In this example we'll go through HTTP to get
// the HTML source of a URL.
$lines = file('http://ns1.ezecastle.com/zonefiles/pzena.com');

// Loop through our array, show HTML source as HTML source; and line numbers too.
foreach ($lines as $line_num => $line) {
	$one_line = htmlspecialchars($line);
	if(!(substr($one_line,0,1) == ";")){
    	echo "Line #<b>{$line_num}</b> : " . $one_line . "<br />\n";
    }
}

?>