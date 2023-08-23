<?php
# scraping books to scrape: https://books.toscrape.com/
require 'vendor/autoload.php';
$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get('https://www.bola.net/tag/manchester-united/berita-sepak-bola/');
$htmlString = (string) $response->getBody();
//add this line to suppress any warnings
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);
$titles = $xpath->evaluate('//ul//li//div[@class="item"]//div[@class="description"]//p');
$desc = $xpath->evaluate('//ul//li//div[@class="item"]//div[@class="description"]//span[@class="description-top"]//span');

// $extractedTitles = [];
// foreach ($titles as $title) {
// $extractedTitles[] = $title->textContent.PHP_EOL;
// echo $title->textContent.PHP_EOL;

// }
$descArray = [];
foreach ($desc as $key => $descs) {
$descArray[] = $descs->textContent;
}

foreach ($titles as $key => $title) {
    echo $title->textContent . ' - '. $descArray[$key] . PHP_EOL;
    }