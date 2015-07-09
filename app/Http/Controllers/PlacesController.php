<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlacesController extends Controller
{

    protected $foursquare;
    protected $defaultArray;

    private static $DEFAULT_LIMIT = 10;
    private static $DEFAULT_LL = '37.787302, -122.397035';
    private static $DEFAULT_RADIUS = 250;
    private static $FOODID = '4d4b7105d754a06374d81259';
    private static $DEFAULT_CATEGORYID = '4d4b7105d754a06374d81259';

    public function __construct()
    {
        $this->foursquare = new \FoursquareApi(env('FOURSQUARE_KEY'),env('FOURSQUARE_SECRET'));
        $this->defaultArray = array("ll"=>self::$DEFAULT_LL,"radius"=>self::$DEFAULT_RADIUS,
            "categoryId"=>self::$DEFAULT_CATEGORYID);
    }

    public function show($id)
    {
        $place = $this->searchVenueByID($id);
        $place['category'] = $this->getCategory($place);
        $place['price'] = str_repeat('$', $this->getPrice($place));
        $place['tips'] = array_slice($place['tips']['groups'][0]['items'], 0, 4);
        $place['photos'] = $place['photos']['groups'][0]['items'];

        return view('place', compact('place'));
    }

    public function search()
    {
        $params = $this->buildParamArray(
            \Request::get('ll', self::$DEFAULT_LL),
            \Request::get('radius', self::$DEFAULT_RADIUS),
            \Request::get('limit', self::$DEFAULT_LIMIT));

        $options = explode(',', \Request::get('with'));

        $results = $this->venueSearch($params);

        if (isset($options)) {
            $results = array_map(function($result) use ($options) {
                $result['category'] = $this->getCategory($result);
                $result['price'] = str_repeat('$', $this->getPrice($result));

                foreach($options as $option) {
                    switch ($option) {
                        case 'tips':
                            $result['tips'] = $this->getTips($result);
                            break;
                        case 'photos':
                            $result['photos'] = $this->getPhotoInfoArray($result);
                            break;
                    }
                }
                return $result;
            }, $results);
        }

        $results = array_map(function($result) {
            $link = $result['photos']['groups'][0]['items'][0]['prefix'] . 'original' .
                $result['photos']['groups'][0]['items'][0]['suffix'];

            $result['photo'] = $link;

            return $result;
        }, $results);

        return view('home', compact('results'));
    }


    //===========================

    private function buildParamArray($currentlocation, $radius, $limit, $offset=0)
    {
//        $radius = $radius*1609.34;

        return $paramarray = array('ll'=>$currentlocation, 'radius' => $radius, 'limit' => $limit, 'section'=>'food',
        'offset'=>$offset, 'venuePhotos' => 1);
    }

    private function venueSearch($paramarray)
    {
        $venuesjson = $this->foursquare->GetPublic('venues/explore', $paramarray, $POST=false);
        $venues = json_decode($venuesjson, true);

        $itemsArray = $venues['response']['groups'][0]['items'];
        $venues = array_map(function($item)
        {
            return $item['venue'];
        }, $itemsArray);

        return $venues;
    }

    /**
     * Gets venue by ID
     * @param $venue
     * @return mixed
     */
    private function venueByID($venue)
    {
        $venueJson = $this->foursquare->GetPublic('venues/'.$venue['id']);
        $venue = json_decode($venueJson, true);
        return $venue;
    }

    /**
     * Gets venue by ID
     * @param $venue
     * @return mixed
     */
    private function searchVenueByID($id)
    {
        $venueJson = $this->foursquare->GetPublic('venues/'.$id);
        $venue = json_decode($venueJson, true);
        return $venue['response']['venue'];
    }

    /**
     * Gets category from venue
     * @param $venue
     * @return mixed
     */
    private function getCategory($venue)
    {
        return $venue['categories'][0]['name'];
    }

    /**
     * Gets address from venue
     * @param $venue
     * @return mixed
     */
    private function getAddress($venue)
    {
        return $venue['location']['addresss'];
    }

    /**
     * Gets distance from venue
     * @param $venue
     * @return float
     */
    private function getDistance($venue)
    {
        return round(($venue['location']['distance'])/1609.34,1);
    }

    /**
     * Gets tips from venue
     * @param $venue
     * @return null
     */
    private function getTips($venue)
    {
        $venue2 = $this->venueByID($venue);
        if (isset($venue2['response']['venue']['tips']['groups'][0]['items']))
        {
            $tipInfoArray = $venue2['response']['venue']['tips']['groups'][0]['items'];
            $tipArray = array_map(function ($tipInfo)
            {
                if(isset($tipInfo['text']))
                {
                    return $tipInfo['text'];
                }
                return null;
            }, $tipInfoArray);

            return $tipArray;
        }
    }

    /**
     * Gets photos from venue
     * @param $venue
     * @return null
     */
    private function getPhotoInfoArray($venue)
    {
        $venue2 = $this->venueByID($venue);
        if (isset($venue2['response']['venue']['photos']['groups'][0]['items']))
        {
            return $venue2['response']['venue']['photos']['groups'][0]['items'];
        }
    }

    /**
     * Gets price from venue
     * @param $venue
     * @return null
     */
    private function getPrice($venue)
    {
        if (isset($venue['price']))
        {
            return $venue['price']['tier'];
        }
        return null;
    }
}
