<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use FeedReader;
use View;

class FeedReaderPodcastController extends Controller
{

    public function feedReaderParse() {

        $rssFeed = "https://nosleeppodcast.libsyn.com/rss";
        // $rssFeed = "https://www.omnycontent.com/d/playlist/aaea4e69-af51-495e-afc9-a9760146922b/43816ad6-9ef9-4bd5-9694-aadc001411b2/808b901f-5d31-4eb8-91a6-aadc001411c0/podcast.rss";
        // $rssFeed = "https://feeds.megaphone.fm/stuffyoushouldknow";
        // $rssFeed = "https://feeds.megaphone.fm/stuffyoumissedinhistoryclass";
        // $rssFeed = "https://media.perpetuatech.com/feeds/category/f/Q0RDRUE1M0ZENw";


        $xmlObject = simplexml_load_file($rssFeed);

        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);

        $podcastData = $phpArray['channel'];
        $episodeData = $podcastData['item'];

        // $feed = 'https://nosleeppodcast.libsyn.com/rss';
        // $feedReader = FeedReader::read($feed);

        $episodeArray = [];
        $podcastArray = [];

        // $podcastTitle = $podcastData['title']; //title
        // $podcastArtURL = isset($podcastData['image']['url']) ? $podcastData['image']['url'] : ""; //artwork_URL
        // $podcastFeedURL = $rssFeed; //feed_URL
        // $podcastDescription = $podcastData['description']; //description
        // $podcastLanguage = $podcastData['language']; //language
        // $podcastWebsiteURL = $podcastData['link']; //website_URL

        $finishedPodcast = array(
            $podcastTitle = (!isset($podcastData['title']) || empty($podcastData['title'])) ? "" : $podcastData['title'],
            $podcastArtURL = (!isset($podcastData['image']['url']) || empty($podcastData['title'])) ? "" : $podcastData['image']['url'],
            $podcastFeedURL = $rssFeed,
            $podcastDescription = (!isset($podcastData['description']) || empty($podcastData['description'])) ? "" : $podcastData['description'],
            $podcastLanguage = (!isset($podcastData['language']) || empty($podcastData['title'])) ? "" : $podcastData['language'],
            $podcastWebsiteURL = (!isset($podcastData['link']) || empty($podcastData['link'])) ? "" : $podcastData['link']
        );



        foreach ($episodeData as $episode) {
                
            $finishedEpisode = array(

                $episodeTitle = (!isset($episode['title']) || empty($episode['title'])) ? "" : $episode['title'],
                $episodeDescription = (!isset($episode['description']) || empty($episode['description'])) ? "" : $episode['description'],
                $episodeAudioURL = (!isset($episode['enclosure']['@attributes']['url']) || empty($episode['enclosure']['@attributes']['url'])) ? "" : $episode['enclosure']['@attributes']['url'],
                $episodeURL = (!isset($episode['link']) || empty($episode['link'])) ? "" : $episode['link']
            );

            array_push($episodeArray, $finishedEpisode);
        }

        return View::make('podcast')->with('podcast', $podcastData)->with('episodes', $episodeData);


        // foreach ($episodeData as $episode) {

        //     $episodeTitle = $episode['title']; //title
        //     $episodeDescription = $episode['description']; //description
        //     $episodeAudioURL = $episode['enclosure']['@attributes']['url']; //audio_URL
        //     $episodeURL = isset($episode['link']) ? $episode['link'] : ""; //episode_URL
        // }



        // $podcastTitle = $feedReader->get_title();
        // $podcastArtURL = $feedReader->get_image_link();
        // $podcastDescription = $feedReader->get_description();
        // $podcastLanguage = $feedReader->get_language();
        // $podcastFeedURL = $feed; 
        // $podcastWebsiteURL = $feedReader->get_link();



        // $episodes = $feedReader->get_items();

        // foreach ($episodes as $episode) {
        //     $episodeTitle = $episode->get_title();
        //     $episodeDescription = $episode->get_description();
        //     $episodeURL = $episode->get_link();
        // }


    }

    public function getPodcastInformation($parsedFeed) {

    }

    public function getEpisodeInformation($parsedFeed) {
        
    }
}
