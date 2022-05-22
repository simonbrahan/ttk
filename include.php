<?php

define('CLIENT_ID', '22edce8d6cb7321');
define('DB_NAME', 'through_the_keyhole');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');

function sendToImgur(string $path): string
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

function createSubmission(int $user_id, int $theme_id, string $url)
{
    runQuery(
        'insert into submission (user_id, theme_id, url, created_at) values (?, ?, ?, ?)',
        [$user_id, $theme_id, $url, time()]
    );
}

function runQuery(string $query, array $params = []): PDOStatement
{
    $db = getDb();
    $query = $db->prepare($query);
    $query->execute($params);

    return $query;
}

function getDb()
{
    return new Pdo(
        'mysql:dbname=' . DB_NAME,
        DB_USERNAME,
        DB_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]
    );
}
