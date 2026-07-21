<?php
require 'config/bootstrap.php';

use Cake\Http\ServerRequest;
use Cake\Http\Response;
use App\Controller\CheckoutController;
use Cake\ORM\TableRegistry;

$data = [
    'FullName' => 'Test',
    'Email' => 'test@test.com',
    'Phone' => '0123456789',
    'Username' => 'testuser1',
    'Password' => 'password',
    'payment_method' => 'stripe'
];

$request = (new ServerRequest())
    ->withEnv('REQUEST_METHOD', 'POST')
    ->withParsedBody($data);

$response = new Response();

$controller = new CheckoutController($request, $response, 'Checkout');
$result = $controller->package(1);

echo "Done.\n";
if (file_exists(TMP . 'checkout_errors.log')) {
    echo file_get_contents(TMP . 'checkout_errors.log');
} else {
    echo "No errors logged.";
}
