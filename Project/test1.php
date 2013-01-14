<?php
require_once 'Net/IPv4.php';

// create IPv4 object
$ip_calc = new Net_IPv4();

// set variables
$ip_calc->ip = "192.168.1.10";
$ip_calc->netmask = "255.255.255.0";

/* alternative method with numerical values:
$ip_calc->long = 3232235786;
$ip_calc->bitmask = 24;
*/

// calculate
$error = $ip_calc->calculate();
if (!is_object($error))
{
  // if returned true, output
  $ipaddress = explode('.',$ip_calc->network);
  echo $ipaddress[2] . "<br>";

  echo "Your network address: ".$ip_calc->network."<br />";
  echo "Your broadcast address: ".$ip_calc->broadcast."<br />";
}
else
{
  // otherwise handle error
  echo "An error occured: ".$error->getMessage();
}


?>