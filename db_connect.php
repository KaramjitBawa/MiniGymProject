<?php 
error_reporting(E_ALL);

function getAddress($latitude, $longitude)
{
        //google map api url
        $url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyD4br3YHyimkmBJnKG02nZDlAZlh58MdWc&latlng=$latitude,$longitude";

        // send http request
        $geocode = file_get_contents($url);
        $json = json_decode($geocode);print_r($json);
        $address = $json->results[0]->formatted_address;
        return $address;
}
// coordinates
$latitude = '40.6781784';
$longitude = '-73.9441579';
$result = getAddress($latitude, $longitude);
echo 'Address: ' . $result;

// produces output
// Address: 58 Brooklyn Ave, Brooklyn, NY 11216, USA

die;
function getGeoLocation($addr)
{
    $cleanAddress = str_replace (" ", "+", $addr);
	$key = "AIzaSyDIoaE2qUQhNW-0eG7vWZIIDE3-YHyZuq4";
    $details_url = "https://maps.googleapis.com/maps/api/geocode/json?key=$key&latlng=".$cleanAddress."&sensor=false";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $details_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $geoloc = json_decode(curl_exec($ch), true);
	print_r($geoloc);
  switch ($geoloc['status']) {
    case 'ZERO_RESULTS':
      return 0;
      break;
    case 'OK':
      return $geoloc['results'][0]['geometry']['location'];
      break;
  }
}

$location = getGeoLocation('51.0272883,-114.3680132');
echo '<pre>';
print_r($location);
echo '</pre>';

die;
date_default_timezone_set('EST');
echo $curdate =  date("Y-m-d H:i:s");die;
echo $randomcode = random_int(100000, 999999);die;
$conn= new mysqli('localhost','root','','gym_db');
if(mysqli_connect_errno())
			{
				printf("Connection failed %s\n",mysqli_connect_error());
				exit();
			}
			else
			{
				echo "YES";
			}
?>
