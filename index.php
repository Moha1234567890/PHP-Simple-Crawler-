<?php


require 'vendor/autoload.php';
use Symfony\Component\DomCrawler\Crawler;

$term = 'nokia';

$url = 'https://listado.mercadolibre.com.ar/' . $term . '#D[A:nokia]';




$client = new \GuzzleHttp\Client();
$response = $client->request('GET', $url);


$html = '' . $response->getBody();


$crawler = new Crawler($html);


$items = $crawler->filter('.ui-search-layout > li')->each(function (Crawler $node, $i) {
    $text = $node->text();

    $image = $node->filter('img')->attr('src');

    $arr = [
      "text" => $text,
     "image" => $image
    ];
    return $arr;
   
});

foreach($items as $item) {
   // echo '<img src="'. $item['image']. '"/>';
   // echo '<p>"' . $item['text']. '"</p>';
}

$file = fopen('images.csv', "w");

foreach($items as $item) {
   fputcsv($file, $item);
   // echo '<img src="'. $item['image']. '"/>';
   // echo '<p>"' . $item['text']. '"</p>';
}

fclose($file);

echo "done";
