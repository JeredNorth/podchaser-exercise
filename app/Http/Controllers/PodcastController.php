<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcast;
use App\Models\Episode;
use View;

class PodcastController extends Controller
{
    public function parseRssFeed($rssFeed) { //$rssFeed is a url (string)
       
        $xmlObject = simplexml_load_file($rssFeed);

        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);

        $podcastData = $phpArray['channel'];
        $episodeData = $podcastData['item'];

        $this->savePodcastInformation($podcastData, $rssFeed);
        $this->saveEpisodeInformation($episodeData);

        return "finished";
    }

    // (!isset($podcast) || empty($podcast)  checking to see if the part we want is set and also not set as an empty array.

    public function savePodcastInformation($podcastData, $rssFeed) {

        $podcast = new Podcast();
            $podcast->title = (!isset($podcastData['title']) || empty($podcastData['title'])) ? "" : $podcastData['title'];
            $podcast->artwork_URL = (!isset($podcastData['image']['url']) || empty($podcastData['title'])) ? "" : $podcastData['image']['url'];
            $podcast->feed_URL = $rssFeed;
            $podcast->description = (!isset($podcastData['description']) || empty($podcastData['description'])) ? "" : $podcastData['description'];
            $podcast->language = (!isset($podcastData['language']) || empty($podcastData['title'])) ? "" : $podcastData['language'];
            $podcast->website_URL = (!isset($podcastData['link']) || empty($podcastData['link'])) ? "" : $podcastData['link'];

        $podcast->save();
    }

    public function saveEpisodeInformation($episodeData) {

        foreach ($episodeData as $episode) {
        
        $finishedEpisode = new Episode();
            $finishedEpisode->title = (!isset($episode['title']) || empty($episode['title'])) ? "" : $episode['title'];
            $finishedEpisode->description = (!isset($episode['description']) || empty($episode['description'])) ? "" : $episode['description'];
            $finishedEpisode->audio_URL = (!isset($episode['enclosure']['@attributes']['url']) || empty($episode['enclosure']['@attributes']['url'])) ? "" : $episode['enclosure']['@attributes']['url'];
            $finishedEpisode->episode_URL = (!isset($episode['link']) || empty($episode['link'])) ? "" : $episode['link'];

        $finishedEpisode->save();
        }
    }
}
