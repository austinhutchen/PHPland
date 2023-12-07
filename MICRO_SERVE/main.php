<!DOCTYPE html> 
<div class="php">
<?php
require __DIR__ . '/GET_POST.php';

$realm = 'Restricted area';
//user => password
$users = array('sysadmin' => 'ADMINPASS', 'guest' => 'GUESTPASS');

if (empty($_SERVER['PHP_AUTH_DIGEST']) || !($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) ||  !isset($users[$data['username']])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="' . $realm .
        '",qop="auth",nonce="' . uniqid() . '",opaque="' . md5($realm) . '"');

    die('Text to send if user hits Cancel button');
}

 echo "<h3 style='color:green;'>You are currently logged in as: "  . '<b>'. $data['username'] . "<b/></h3>";
// generate the valid response
$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
$A2 = md5($_SERVER['REQUEST_METHOD'] . ':' . $data['uri']);
$valid_response = md5($A1 . ':' . $data['nonce'] . ':' . $data['nc'] . ':' . $data['cnonce'] . ':' . $data['qop'] . ':' . $A2);



// Example POST request to the ESP32
$post_data = array(
    'param1' => 'value1',
    'param2' => 'value2'
);
$post_response = sendPostRequest("http://$esp32_ip/another_endpoint", json_encode($post_data));

echo "POST Response: " . $post_response . "\n";



// function to parse the http auth header
function http_digest_parse($txt)
{
    // protect against missing data
    $needed_parts = array('nonce' => 1, 'nc' => 1, 'cnonce' => 1, 'qop' => 1, 'username' => 1, 'uri' => 1, 'response' => 1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));

    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}
?>
</div>
<html style="background-color: #142d4c">
<div class ="static">
<iframe width="100%" height="350svh" src="./images/SOLDER.mp4">
<button onclick={$echo "HELLO"}> </button>
</div>
</html>
