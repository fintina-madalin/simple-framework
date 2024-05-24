<?php
require_once '../vendor/autoload.php';

use App\Controllers\ContactsController;
use App\Core\Config;
use App\Core\Exceptions\DatabaseException;
use App\Core\Exceptions\RouterException;
use App\Core\Exceptions\ViewException;
use App\Core\Request;
use App\Core\Router;

$router = new Router();

$router->add([Request::GET], "/", [ContactsController::class, 'list']);
$router->add([Request::GET, Request::POST], "/add", [ContactsController::class, 'add']);
$router->add([Request::GET, Request::POST], "/edit", [ContactsController::class, 'edit']);
$router->add([Request::GET], "/delete", [ContactsController::class, 'delete']);

$router->add([Request::GET], '/download/xml', [ContactsController::class, 'downloadXml']);
$router->add([Request::GET], '/download/csv', [ContactsController::class, 'downloadCsv']);

try {
    $router->dispatch($_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} catch (RouterException|ViewException $e) {
    print_r($e->getMessage());
    http_response_code(404);
    echo '404 Not Found';
} catch (DatabaseException $e) {
    http_response_code(500);
    echo 'Database Error';
} catch (Throwable $e) {
    http_response_code(500);
    echo 'An unexpected error occurred';
}

if (Config::get('is_debug') && isset($e)) {
    echo '<pre>';
    print_r($e);
    echo '</pre>';
}
