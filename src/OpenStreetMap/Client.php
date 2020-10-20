<?php


namespace App\OpenStreetMap;


use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client
{
    const URL="https://nominatim.openstreetmap.org";
    const SEARCH_URL="https://nominatim.openstreetmap.org/search?q={{query}}&format=json&addressdetails=1&limit=100&polygon_svg=1";
    const SEARCH_CITY_URL="https://nominatim.openstreetmap.org/search?city={{city}}&format=json&addressdetails=1&limit=100&polygon_svg=1";

    private $client;

    /**
     * Client constructor.
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param $query
     * @return array|string
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchDataQuery($query){
        $url=str_replace("{{query}}",$query,self::SEARCH_URL);
        try {
            $response = $this->client->request("GET", $url);
        } catch (TransportExceptionInterface $e) {
            return $e->getMessage();
        }
        return $response->toArray();
    }

    public function fetchDataByCity($city){
        $url=str_replace("{{city}}",$city,self::SEARCH_CITY_URL);
        try {
            $response = $this->client->request("GET", $url);
        } catch (TransportExceptionInterface $e) {
            return $e->getMessage();
        }
        $toArray = $response->toArray();
        $result=[];
        foreach ($toArray as $value)
            $result[]=AddresseFactory::create($value);
        return $result;
    }


    /**
     * @return mixed
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

}