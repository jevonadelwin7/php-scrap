<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

$httpClient = new Client();
$response = $httpClient->get('https://www.bola.net/tag/manchester-united/berita-sepak-bola/');
$htmlString = (string) $response->getBody();
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);
$titles = $xpath->evaluate('//ul//li//div[@class="item"]//div[@class="description"]//p');
$desc = $xpath->evaluate('//ul//li//div[@class="item"]//div[@class="description"]//span[@class="description-top"]//span');
$links= $xpath->evaluate('//ul//li//div[@class="item"]//div[@class="description"]//p/a/@href');

$data = [];

foreach ($titles as $key => $title) {
    $data[] = [
        'title' => $title->textContent,
        'link' => $links[$key]->textContent,
        'description' => $desc[$key]->textContent
    ];
}

header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);
?>