<?php

define('CLIENT_ID', '22edce8d6cb7321');
define('DB_NAME', 'through_the_keyhole');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', null);

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

function getSubmissionsForUser(int $user_id)
{
    $res = runQuery(
        'select s.url, t.id as theme_id, t.name as theme_name, s.created_at as submission_created
         from submission s
         join theme t on s.theme_id = t.id
         order by s.created_at desc'
    );

    $out = [];
    foreach ($res as $row) {
        $out[] = (object) [
            'url' => $row->url,
            'theme' => (object) ['id' => $row->theme_id, 'name' => $row->theme_name],
            'created_at' => $row->submission_created
        ];
    }

    return $out;
}

function createTheme(int $user_id, string $theme_name)
{
    runQuery(
        'insert into theme (user_id, name, created_at) values (?, ?, ?)',
        [$user_id, $theme_name, time()]
    );
}

function getAllUsers()
{
    return runQuery('select id, name from user order by name');
}

function getUser(int $user_id)
{
    $res = runQuery('select id, name from user where id = ?', [$user_id]);

    if (empty($res)) {
        throw new Exception('No user with id ' . $user_id);
    }

    return reset($res);
}

function getAllThemes()
{
    return runQuery(
        'select t.id, t.name, t.created_at, u.name as creator
         from theme t
         join user u on t.user_id = u.id
         order by t.created_at'
    );
}

function getUnsubmittedThemesForUser(int $user_id)
{
    return runQuery(
        'select t.id, t.name, t.created_at, u.name as creator
         from theme t
         join user u on t.user_id = u.id
         left join submission s on s.user_id = ? and s.theme_id = t.id
         where s.theme_id is null
         order by t.created_at',
        [$user_id]
    );
}

function runQuery(string $query, array $params = []): array
{
    $db = getDb();
    $query = $db->prepare($query);
    $query->execute($params);

    return $query->fetchAll();
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

function getAuthedUser()
{
    return getUser(1);
}

function e(string $content)
{
    echo htmlspecialchars($content);
}
