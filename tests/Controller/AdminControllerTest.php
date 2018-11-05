<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testShowAdmin()
    {
        $client = static::createClient();

        $client->request('GET', '/admin');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}

?>