<?php
# scraping books to scrape: https://books.toscrape.com/
require 'vendor/autoload.php';
$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get('https://sport.detik.com/sepakbola/klasemen/liga-inggris');
$htmlString = (string) $response->getBody();
//add this line to suppress any warnings
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);
$titles = $xpath->evaluate('//div[@class="new_klasemen"]//div[@class="klasemen-table"]//span');
$extractedTitles = [];
foreach ($titles as $title) {
$extractedTitles[] = $title->textContent.PHP_EOL;
echo $title->textContent.PHP_EOL;
}