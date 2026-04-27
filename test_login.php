<?php
$ch = curl_init('http://localhost:8765/users/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'Username' => 'trainer799',
    'Password' => 'password123'
]));
$res = curl_exec($ch);
echo "LOGIN RESPONSE:\n";
echo substr($res, 0, 1000);
echo "\n====================\n";

// Extract cookies
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $res, $matches);
$cookies = array();
foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
}

$cookieStr = '';
foreach ($cookies as $k => $v) {
    $cookieStr .= "$k=$v; ";
}

$ch2 = curl_init('http://localhost:8765/trainer');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_HEADER, true);
curl_setopt($ch2, CURLOPT_COOKIE, $cookieStr);
$res2 = curl_exec($ch2);
echo "TRAINER RESPONSE: \n";
echo substr($res2, 0, 1500);
curl_close($ch);
curl_close($ch2);
