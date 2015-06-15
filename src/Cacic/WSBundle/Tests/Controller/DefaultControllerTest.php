<?php

namespace Cacic\WSBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $response = $client->getResponse();

        $this->assertNotEquals(500, $response->getStatusCode());
    }
}
