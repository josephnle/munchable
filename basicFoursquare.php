<?php 
	require __DIR__.'/vendor/autoload.php';
	//require_once("../src/FoursquareApi.class.php");   Not sure if i Need
	
	// This file is intended to be used as your redirect_uri for the client on Foursquare
	
	// Set your client key and secret
	$client_key = "HJYN5QVLVCJ5QYM43M1DGK40SN4L1D1K4WEMKBXWWM4KHRWW";
	$client_secret = "KJSVREUAP0M51NRDVMNPRJPLDG5M42TQMPVVABLIFP5SWJ5K";
	//$redirect_uri = "munchable.app"; Also not sure
	
	// Load the Foursquare API library
	$foursquare = new FoursquareApi($client_key,$client_secret);


	$DEFAULT_LIMIT = 50;
	$DEFAULT_LL = '37.787302, -122.397035';
	$DEFAULT_RADIUS = 500;
	$FOODID = '4d4b7105d754a06374d81259';
	//$RESTAURANTID ='4bf58dd8d48988d1c4941735';
	$DEFAULT_CATEGORYID = $FOODID;

	$defaultarray = array("ll"=>$DEFAULT_LL,"radius"=>$DEFAULT_RADIUS,"categoryId"=>$DEFAULT_CATEGORYID);

	function buildParamArray($currentlocation, $radius, $category)
	{
		$radius = $radius*1609.34;

		if($category == 'Food')
		{
			$categoryId = '4d4b7105d754a06374d81259';
		}
		else if($category == 'Restaurant')
		{
			'4bf58dd8d48988d1c4941735';
		}
		return $paramarray = array('ll'=>$currentlocation, 'radius'=>$radius, 'categoryId'=>$categoryId);
	}



	function venueSearch($foursquare, $paramarray)
	{
		$venuesjson = $foursquare->GetPublic('venues/search', $paramarray, $POST=false);
		$venues = json_decode($venuesjson, true);
		/*
		foreach($venues['response']['venues'] as $venue)
		{
			echo $venue['name']."\n";
		}
		*/
		return $venues['response']['venues'];
		
	}

	function venueByID($foursquare,$venue)
	{
		$venuejson = $foursquare->GetPublic('venues/'.$venue['id']);
		$venue = json_decode($venuejson, true);
		return $venue;
	}
	
	/*
	function getVenueInfo($venue)
	{
		//guaranteed
		$foursquareid = $venue['id'];

		//starRating not from FourSquare Api
		$starRating = 

		//guaranteed
		//DONE with return address
		$location = $venue['location'];

		//import google maps api
		$distance
		$lat = $venue['location'];
		$long = $venue['location'];

		//url not guaranteed
		//doesn't feel necessary
		$url = $venue['url'];

		//not guaranteed
		//get from google if not there
		$price = $venue['price'];

		//not guaranteed
		//DONE
		$tips = $venue['tips']

		//not guaranteed
		//DONE
		$photos = $venue['photos'];

		//guaranteed
		//DONE
		$categories = $venue['categories'];
	}
	*/

/*
	function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
	// Calculate the distance in degrees
	$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
 
	// Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
	switch($unit) {
		case 'km':
			$distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
			break;
		case 'mi':
			$distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
			break;
		case 'nmi':
			$distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
	}
	return round($distance, $decimals);
}
*/

	function getCategory($venue)
	{
		return $venue['categories']['name'];
	}

	function getAddress($venue)
	{
		return $venue['location']['addresss'];
	}

	function getDistance($venue)
	{
		return round(($venue['location']['distance'])/1609.34,1);
	}

	function tipFromInfo($tipInfo)
	{
		if(isset($tipInfo['text']))
		{
			return $tipInfo['text'];
		}
	}

	function getTips($foursquare, $venue)
	{
		$venue2 = venueByID($foursquare,$venue);
		if (isset($venue2['response']['venue']['tips']['groups'][0]['items']))
		{
			$tipInfoArray = $venue2['response']['venue']['tips']['groups'][0]['items'];
			$tipArray = array_map("tipFromInfo", $tipInfoArray);
			return $tipArray;
		}
	}

	function getPhotoInfoArray($foursquare, $venue)
	{
		$venue2 = venueByID($foursquare, $venue);
		if (isset($venue2['response']['venue']['photos']['groups'][0]['items']))
		{
			return $venue2['response']['venue']['photos']['groups'][0]['items'];
		}
	}

	function getPrice($foursquare, $venue)
	{
		$venue2 = venueByID($foursquare, $venue);
		if (isset($venue2['response']['venue']['price']))
		{
			return $venue2['response']['venue']['price']['tier'];
		}
	}

	//$venue = venueSearch($foursquare, $defaultarray)[5];

	//var_dump($venue['name']);
	//var_dump(getTips($foursquare, $venue));
	//echo getPrice($foursquare, $venue)."\n";
	//var_dump(getTips($foursquare, $venue));


?>