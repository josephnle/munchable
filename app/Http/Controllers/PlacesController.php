<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlacesController extends Controller
{

    protected $foursquare;
    protected $defaultArray;

    private static $DEFAULT_LIMIT = 50;
    private static $DEFAULT_LL = '37.787302, -122.397035';
    private static $DEFAULT_RADIUS = 500;
    private static $FOODID = '4d4b7105d754a06374d81259';
    private static $DEFAULT_CATEGORYID = '4d4b7105d754a06374d81259';

    public function __construct()
    {
        $this->foursquare = new \FoursquareApi(env('FOURSQUARE_KEY'),env('FOURSQUARE_SECRET'));
        $this->defaultArray = array("ll"=>self::$DEFAULT_LL,"radius"=>self::$DEFAULT_RADIUS,
            "categoryId"=>self::$DEFAULT_CATEGORYID);
    }

    public function search()
    {
        $params = $this->buildParamArray(
            self::$DEFAULT_LL,
            self::$DEFAULT_RADIUS,
            'Food',
            \Request::get('limit'));

        $options = explode(',', \Request::get('with'));

        $results = $this->venueSearch($params);

        if (isset($options)) {
            $results = array_map(function($result) use ($options) {
                foreach($options as $option) {
                    switch ($option) {
                        case 'price':
                            $result['price'] = $this->getPrice($result);
                            break;
                        case 'category':
                            $result['category'] = $this->getCategory($result);
                            break;
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

        return json_encode($results);
    }


    //===========================

    private function buildParamArray($currentLocation, $radius, $category, $limit)
    {
        $radius = $radius*1609.34;

        if($category == 'Food')
        {
            $categoryId = '4d4b7105d754a06374d81259';
        }
        else if($category == 'Restaurant')
        {
            $categoryId = '4bf58dd8d48988d1c4941735';
        }

        return array('ll'=>$currentLocation, 'radius'=>$radius, 'categoryId'=>$categoryId, 'limit' => $limit);
    }

    private function venueSearch($params)
    {
        $venuesJson = $this->foursquare->GetPublic('venues/search', $params, $POST=false);
        $venues = json_decode($venuesJson, true);

        return $venues['response']['venues'];
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
        $venue2 = $this->venueByID($venue);
        if (isset($venue2['response']['venue']['price']))
        {
            return $venue2['response']['venue']['price']['tier'];
        }
        return null;
    }
}
