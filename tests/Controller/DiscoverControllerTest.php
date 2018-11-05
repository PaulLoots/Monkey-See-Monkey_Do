<?php
namespace App\Tests\Controller;

// use App\Entity\Profile;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DiscoverControllerTest extends WebTestCase
{
    public function testShowDiscover()
    {
        // $profile = $this->getDoctrine()
        // ->getRepository(Profile::class)
        // ->findBy(8);

        // $session->set('profile', $profile);

        $client = static::createClient();

        $client->request('GET', '/discover');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}

?>