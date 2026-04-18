<?php
function randomString($length = 10) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $str = '';
    $max = strlen($chars) - 1;

    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[random_int(0, $max)];
    }

    return $str;
}

$cookieName = 'unique_path';
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

if ($uri === '') {
    if (!isset($_COOKIE[$cookieName]) || empty($_COOKIE[$cookieName])) {
        $uniquePath = randomString(10);

        setcookie(
            $cookieName,
            $uniquePath,
            time() + (86400 * 30), // 30 days
            "/",
            "",
            false,
            true
        );
    } else {
        $uniquePath = $_COOKIE[$cookieName];
    }

    header("Location: /" . $uniquePath . "/index.php");
    exit;
}

http_response_code(404);
echo "Not Found";