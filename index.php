<?php

/* 
 * Google Analitycs Tracking
 * Example
 * 
 * For more info about parameters or others, please visit:
 * https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide
 */

/**
 * Required by Analitycs Measurement Protocol
 * @return type
 */
function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

$data = array(
    'v'   => 1,                 // Version
    'tid' => 'UA-XXXXXXXX-X',   // Tracking ID / Property ID
    'cid' => gen_uuid(),        // Anonymous Client ID
    't'   => 'pageview',        // Hit Type (pageview, event, ...)
    'dt'  => 'Title',           // Title
    'ec'  => 'video',           // Event Category. Required
    'ea'  => 'play',            // Event Action. Required
    'el'  => 'label',           // Event label
    'ev'  => 'value'            // Event value 
);


$url = 'http://www.google-analytics.com/collect';
$content = http_build_query($data);
$content = utf8_encode($content);
$user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X x.y; rv:10.0) Gecko/20100101 Firefox/10.0';

$ch = curl_init();
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
curl_exec($ch);
curl_close($ch);