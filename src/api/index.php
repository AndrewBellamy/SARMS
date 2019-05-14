<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

include_once 'Request.php';
include_once 'Router.php';

echo 'Current PHP version: ' . phpversion();
$router = new Router(new Request);


$router->get('/', function() {
    return <<<HTML
    <h2>SSR Testing</h2>
HTML;
});

$router->get('/data', function($request) {
    return json_encode($request->getBody());
});

?>