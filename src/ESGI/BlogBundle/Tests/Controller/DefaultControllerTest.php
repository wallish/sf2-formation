<?php

namespace ESGI\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/post/show/test');

        $this->assertTrue($crawler->filter('html:contains("article test")')->count() > 0);
    }
}
