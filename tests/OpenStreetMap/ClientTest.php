<?php

namespace App\Tests\OpenStreetMap;

use App\Kernel;
use App\OpenStreetMap\Client;
use PHPUnit\Framework\TestCase;

/**
 * Pour le test mettre le service en publique
 *     App\OpenStreetMap\Client:
 *         public: true
 * Class ClientTest
 * @package App\Tests\OpenStreetMap
 */
class ClientTest extends TestCase
{
    public function testSomething()
    {
        $this->assertTrue(true);
    }

    public function testFetchData(){

        $kernel = new Kernel('dev',true);
        $kernel->boot();
        $container = $kernel->getContainer();
        $client=$container->get(Client::class);
        $result=$client->fetchDataByCity("massy");
        dump($result);
    }
}
