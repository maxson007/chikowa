<?php


namespace App\OpenStreetMap;


class AddresseFactory
{

    public static function create(array $data){
        $town=$data['address']['town']??'';
        $state=$data['address']['state']??'';
        $country=$data['address']['country']??'';
        $countryCode=$data['address']['country_code']??'';
        $city=$data['address']['city']??'';
        $postcode=$data['address']['town']??'';
        $displayName=$data['display_name']??'Aucune donnée';
        return new Addresse($town, $state, $country, $countryCode, $city, $postcode, $displayName);

    }
}