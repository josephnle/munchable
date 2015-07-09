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

	$uberclient = new Stevenmaguire\Uber\Client(array(
		//'access_token' => 'ONAeycdFNH6uTiEl9bQrCVZwoM-9VAxu',
    	'server_token' => 'bjfrsW0i-dusO4ojZH0zu9eHmX3Kr_pRub1fIZic',
   		'use_sandbox'  => true, // optional, default false
    	'version'      => 'v1', // optional, default 'v1'
    	'locale'       => 'en_US', // optional, default 'en_US'
    ));


	$DEFAULT_LIMIT = 50;
	$DEFAULT_START_LAT = 37.787302;
	$DEFAULT_START_LNG = -122.397035;
	$DEFAULT_LL = '37.787302, -122.397035';
	$DEFAULT_RADIUS = 500;
	$FOODID = '4d4b7105d754a06374d81259';
	//$RESTAURANTID ='4bf58dd8d48988d1c4941735';
	$DEFAULT_CATEGORYID = $FOODID;

	$defaultarray = array("ll"=>$DEFAULT_LL,"radius"=>$DEFAULT_RADIUS,"section"=>'food');



	function buildParamArray($currentlocation, $radius)
	{
		$radius = $radius*1609.34;

		return $paramarray = array('ll'=>$currentlocation, 'radius'=>$radius, 'categoryId'=>'food', 'offset'=>20);
	}


	function getVenuefromItems($item)
	{
		return $item['venue'];
	}

	function venueSearch($foursquare, $paramarray)
	{
		$venuesjson = $foursquare->GetPublic('venues/explore', $paramarray, $POST=false);
		$venues = json_decode($venuesjson, true);
		/*
		foreach($venues['response']['venues'] as $venue)
		{
			echo $venue['name']."\n";
		}
		*/
		$itemsArray = $venues['response']['groups'][0]['items'];
		$venues = array_map("getVenuefromItems",$itemsArray);
		return $venues;
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


	function getCategory($venue)
	{
		return $venue['categories']['name'];
	}

	function getAddress($venue)
	{
		return $venue['location']['addresss'];
	}



	/*NOTE WROTE THIS BECAUSE SEARCH BY VENUE ID DOESN'T RETURN
	A DISTANCE BECAUSE IT DOESN'T REQUIRE A CURRENT LOCATION
	PARAMETER, BUT WE HAVEN'T IMPLEMENTED YET SO I'M NOT YET GOING TO TEST IT*/
	function getDistance($venue/*, $currentlat, $currentlng*/)
	{
		$dist = $venue['location']['distance'];
		if (isset($dist))
		{
			return round($dist/1609.34,1);
		}
		/*
		else
		{
			return distanceCalculation($venue['location']['lat'], $venue['location']['lng'], $currentlat, $currentlng, $unit = 'mi', $decimals = 1)
		}
		*/
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

	function photoFromInfo($photoInfo)
	{
		if(isset($photoInfo['prefix']) and isset($photoInfo['suffix']))
		{
			return (rtrim($photoInfo['prefix'],"/").$photoInfo['suffix']);
		}
	}

	function getPhotos($foursquare, $venue)
	{
		$venue2 = venueByID($foursquare, $venue);
		if (isset($venue2['response']['venue']['photos']['groups'][0]['items']))
		{
			$photoInfoArray = $venue2['response']['venue']['photos']['groups'][0]['items'];
			$photoArray = array_map("photoFromInfo", $photoInfoArray);
			return $photoArray;
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

	function uberPriceEstimate($uberclient, $venue, $currentlat, $currentlng)
	{
		$estimates = $uberclient->getPriceEstimates(array(
			'start_latitude' => $currentlat,
    		'start_longitude' => $currentlng,
    		'end_latitude' => $venue['location']['lat'],
    		'end_longitude' => $venue['location']['lng']
		));
		return $estimates->prices[0]->estimate;
	}

	//returns around when the uber will arrive
	function uberTimeEstimate($uberclient, $currentlat, $currentlng)
	{
		$estimates = $uberclient->getTimeEstimates(array(
			'start_latitude' => $currentlat,
			'start_longitude' => $currentlng));
		$timeSeconds = $estimates->times[0]->estimate;
		$time = round(($timeSeconds/60.0));
		return $time;
	}


	//$venue = venueSearch($foursquare, $defaultarray)[1];

	//var_dump($venue['name']);

	//var_dump(uberTimeEstimate($uberclient, $DEFAULT_START_LAT, $DEFAULT_START_LNG));

	//var_dump(getPhotos($foursquare, $venue));
	//echo getDistance($venue)."\n";
	//var_dump(getTips($foursquare, $venue));


	//$venuesjson = $foursquare->GetPublic('venues/explore', $defaultarray, $POST=false);
	//$venues = json_decode($venuesjson, true);
	//var_dump($venues['response']['groups'][0]['items'])


?>