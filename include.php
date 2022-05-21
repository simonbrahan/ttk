<?php

define('CLIENT_ID', '22edce8d6cb7321');

function sendToImgur($path): string
{
    $image_source = file_get_contents($path);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/upload');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization:  CLIENT-ID ' . CLIENT_ID]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ['image' => base64_encode($image_source), 'type' => 'base64']);
    $raw_res = curl_exec($ch);

    $res = json_decode($raw_res);

    if (!$res->success) {
        throw new Exception('Imgur upload of ' . $path . ' failed: ' . $raw_res);
    }

    return $res->data->link;
}
