<?php

if (!defined('DNS_A'))		define('DNS_A', 0x00000001);
if (!defined('DNS_NS'))		define('DNS_NS', 0x00000002);
if (!defined('DNS_CNAME'))	define('DNS_CNAME', 0x00000010);
if (!defined('DNS_SOA'))	define('DNS_SOA', 0x00000020);
if (!defined('DNS_PTR'))	define('DNS_PTR', 0x00000800);
if (!defined('DNS_HINFO'))	define('DNS_HINFO', 0x00001000);
if (!defined('DNS_MX'))		define('DNS_MX', 0x00004000);
if (!defined('DNS_TXT'))	define('DNS_TXT', 0x00008000);
if (!defined('DNS_A6'))		define('DNS_A6', 0x01000000);
if (!defined('DNS_SRV'))	define('DNS_SRV', 0x02000000);
if (!defined('DNS_NAPTR'))	define('DNS_NAPTR', 0x04000000);
if (!defined('DNS_AAAA'))	define('DNS_AAAA', 0x08000000);
if (!defined('DNS_ANY'))	define('DNS_ANY', 0x10000000);
if (!defined('DNS_ALL'))	define('DNS_ALL', (DNS_A|DNS_NS|DNS_CNAME|DNS_SOA|DNS_PTR|DNS_HINFO|DNS_MX|DNS_TXT|DNS_A6|DNS_SRV|DNS_NAPTR|DNS_AAAA));

// dns_get_record() support for Windows by HM2K <php [spat] hm2k.org>
function win_dns_get_record($hostname,$type=false,&$authns=false,&$addtl=false) {
	if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN') { return; }
	switch (func_num_args()) {
		case 1:
			if (empty($host)) {
				user_error("dns_get_record() Host cannot be empty", E_USER_WARNING);
				return;
			}
		break;
		case 2:

		break;
	}
	$data=array();
	switch ($type) {
		case DNS_A:
			$data['type']='A';
			break;
		case DNS_NS:
			$data['type']='NS';
			break;
		case DNS_CNAME:
			$data['type']='CNAME';
			break;
		case DNS_SOA:
			$data['type']='SOA';
			break;
		case DNS_PTR:
			$data['type']='PTR';
			break;
		case DNS_HINFO:
			$data['type']='HINFO';
			break;
		case DNS_MX:
			$data['type']='MX';
			break;
		case DNS_TXT:
			$data['type']='TXT';
			break;
		case DNS_A6:
			$data['type']='A6';
			break;
		case DNS_SRV:
			$data['type']='SRV';
			break;
		case DNS_NAPTR:
			$data['type']='NAPTR';
			break;
		case DNS_AAAA:
			$data['type']='AAAA';
			break;
		default:
			//nothing atm
	}
	@exec('nslookup -type='.$data['type'].' -d '.escapeshellarg($host),$output);
}

function php_compat_dns_get_record($hostname,$type=false,&$authns=false,&$addtl=false) {
	if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') { return win_dns_get_record($hostname,$type,$authns,$addtl); }
	if (empty($hostname)) { return; }
}

// Define
if (!function_exists('dns_get_record')) {
    function dns_get_record($hostname,$type=false,&$authns=false,&$addtl=false) {
		return php_compat_dns_get_record($hostname,$type,$authns,$addtl);
    }
}

/* example */
echo "<pre>";
$result = dns_get_record("pzena.com");
print_r($result);

/* Request "ANY" record for php.net,
   and create $authns and $addtl arrays
   containing list of name servers and
   any additional records which go with
   them */
$result = dns_get_record("pzena.com", DNS_ANY, $authns, $addtl);
echo "Result = ";
print_r($result);
echo "Auth NS = ";
print_r($authns);
echo "Additional = ";
print_r($addtl);

?>