<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PodcastTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $rssFeed = "https://nosleeppodcast.libsyn.com/rss"

        $xmlObject = simplexml_load_file($rssFeed);

        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);

        $podcastData = $phpArray['channel'];
        

        $this->assertIsString($podcastData['title']);
        $this->assertIsString($podcastData['image']['url']);
        $this->assertIsString($podcastData['description']);
        $this->assertIsString($podcastData['language']);
        $this->assertIsString($podcastData['link']);
        
    }
}
