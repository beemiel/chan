<?php
/*
 * Access Token 요청 예제입니다.
 */
require_once('./autoload.php');
spl_autoload_register('BootpayAutoload');

use Bootpay\Rest\BootpayApi;

$bootpay = BootpayApi::setConfig(
    '5da6d6274f74b40025c5eeed',
    'GJ5hS/VXK/LMI1C7JSLIJjQD57EayREe7CNqaXsNbVA='
);

$response = $bootpay->requestAccessToken();

if ($response->status === 200) {
    print $response->data->token . "\n";
    print $response->data->server_time . "\n";
    print $response->data->expired_at . "\n";
} else {
    var_dump($response);
}

?>