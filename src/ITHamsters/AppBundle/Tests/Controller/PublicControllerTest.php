<?php

namespace ITHamsters\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PublicControllerTest extends WebTestCase
{
    /**
     * @test
     * @dataProvider pagesProvider
     */
    public function allPagesShouldBeAvailable($url)
    {
        $client = static::createClient();

        $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function pagesProvider()
    {
        return [
            [ '/' ],
        ];
    }
}
