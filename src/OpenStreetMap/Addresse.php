<?php


namespace App\OpenStreetMap;


class Addresse
{
    //address
    private $town;
    private $state;
    private $country;
    private $countryCode;//country_code
    private $city;
    private $postcode;
    private $displayName; //display_name

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
    public function __construct($town, $state, $country, $countryCode, $city, $postcode, $displayName)
    {
        $this->town = $town;
        $this->state = $state;
        $this->country = $country;
        $this->countryCode = $countryCode;
        $this->city = $city;
        $this->postcode = $postcode;
        $this->displayName = $displayName;
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


    public function __toString()
    {
       return $this->displayName;
    }

}