<?php

echo "Thank you for your submission. \n";

$FirstName = $_POST['first_name'];
$LastName = $_POST['last_name'];
$Entity = $_POST['entity'];
#$EmailAddress = $_POST['email_address'];
$Location = $_POST['office_location'];
$Mapped_Drives = $_POST['mapped_drives'];
$Citrix_Apps = $_POST['citrix_applications'];


#<<OPTIONAL>> Ensure that the Form does NOT contain any Blank Fields:
if(empty($first_name) || empty($last_name) || empty($entity) || empty($location) || empty($Mapped_drives) || empty($Citrix_applications))
{$message = 'Please Fill in all Fields!';
$aClass = 'errorClass';
}
#When the Form is Completely Filled out, we can now proceed with the Insert:

#Create Headers to Format the CSV file cleanly into powerhsell
$HeadersUser = "\"FirstName\"" . "," . "\"LastName\"" . "," . "\"Entity\"" . "," . "\"Location\"" . "," . "\"MappedDrives\"" . "," . "\"CitrixApps\"" .  "\n";


#Format Data to be insert in csv format:
$UserData = $HeadersUser . $FirstName . "," . $LastName . "," . $Entity . "," . $Location .	","	. implode("/",$Mapped_Drives) . "," . implode("/",$Citrix_Apps)	. "\n";

#Command to Open the File for Writing:
$fp = fopen("UserData.csv","w"); 

#Command to Write the form contents to the csv file:

fwrite($fp,$UserData);

fclose($fp);


?>

