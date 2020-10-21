<?php


namespace App\OpenStreetMap;


class Addresse
{
    private $placeId;
    //address
    private $town;
    private $state;
    private $country;
    private $countryCode;//country_code
    private $city;
    private $postcode;
    private $displayName; //

    private $latitude ;
    private $longitude;

    /**
     * Addresse constructor.
     * @param $town
     * @param $state
     * @param $country
     * @param $countryCode
     * @param $city
     * @param $postcode
     * @param $displayName
     */
    public function __construct($placeId,$town, $state, $country, $countryCode, $city, $postcode, $displayName,$latitude,$longitude)
    {
        $this->placeId=$placeId;
        $this->town = $town;
        $this->state = $state;
        $this->country = $country;
        $this->countryCode = $countryCode;
        $this->city = $city;
        $this->postcode = $postcode;
        $this->displayName = $displayName;
        $this->latitude=$latitude;
        $this->longitude=$longitude;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @return mixed
     */
    public function getPlaceId()
    {
        return $this->placeId;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }


    public function __toString()
    {
       return $this->displayName;
    }


}