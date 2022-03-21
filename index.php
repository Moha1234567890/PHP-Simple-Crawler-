<?php


require 'vendor/autoload.php';
use Symfony\Component\DomCrawler\Crawler;

$term = 'nokia';

$url = 'https://listado.mercadolibre.com.ar/' . $term . '#D[A:nokia]';




$client = new \GuzzleHttp\Client();
$response = $client->request('GET', $url);


$html = '' . $response->getBody();


$crawler = new Crawler($html);


$nodeValues = $crawler->filter('.ui-search-layout > li')->each(function (Crawler $node, $i) {
   // echo $node->text();

    echo $node->filter('img')->attr('src');
    echo '<br>';
});

