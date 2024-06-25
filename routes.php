<?php

require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/app/Repositories/UserRepository.php';
require_once __DIR__ . '/app/Controllers/UserController.php';
require_once __DIR__ . '/app/Repositories/ColorRepository.php';
require_once __DIR__ . '/app/Controllers/ColorController.php';
require_once __DIR__ . '/app/Repositories/UserColorRepository.php';
require_once __DIR__ . '/app/Controllers/UserColorController.php';
require_once __DIR__ . '/app/Repositories/DashboardRepository.php';
require_once __DIR__ . '/app/Controllers/DashboardController.php';
require_once __DIR__ . '/app/Repositories/ReportRepository.php';
require_once __DIR__ . '/app/Controllers/ReportController.php';

use App\Controllers\UserController;
use App\Repositories\UserRepository;
use App\Controllers\ColorController;
use App\Repositories\ColorRepository;
use App\Controllers\UserColorController;
use App\Repositories\UserColorRepository;
use App\Controllers\DashboardController;
use App\Repositories\DashboardRepository;
use App\Controllers\ReportController;
use App\Repositories\ReportRepository;

$connection = new Connection();
$userRepository = new UserRepository($connection->getConnection());
$userController = new UserController($userRepository);
$colorRepository = new ColorRepository($connection->getConnection());
$colorController = new ColorController($colorRepository);
$usercolorRepository = new UserColorRepository($connection->getConnection());
$userColorController = new UserColorController($userRepository, $colorRepository, $usercolorRepository,);
$dashboardRepository = new DashboardRepository($connection->getConnection());
$dashboardController = new DashboardController($dashboardRepository);
$reportRepository = new ReportRepository($connection->getConnection());
$reportController = new ReportController($reportRepository);

$routes = [
    '/' => [$dashboardController, 'index'],
    '/users' => [$userController, 'index'],
    '/users/create' => [$userController, 'create'],
    '/users/store' => [$userController, 'store'],
    '/users/edit/(\d+)' => [$userController, 'edit'],
    '/users/update/(\d+)' => [$userController, 'update'],
    '/users/delete/(\d+)' => [$userController, 'delete'],
    '/users/check-email' => [$userController, 'checkEmail'],
    '/colors' => [$colorController, 'index'],
    '/colors/create' => [$colorController, 'create'],
    '/colors/store' => [$colorController, 'store'],
    '/colors/edit/(\d+)' => [$colorController, 'edit'],
    '/colors/update/(\d+)' => [$colorController, 'update'],
    '/colors/delete/(\d+)' => [$colorController, 'delete'],
    '/colors/check-color' => [$colorController, 'checkColor'],
    '/users-colors/add-colors/' => [$userColorController, 'create'],
    '/users-colors/add-colors-to-user/(\d+)' => [$userColorController, 'edit'],
    '/users-colors/store-colors-to-user/(\d+)' => [$userColorController, 'addColorsToUser'],
    '/users-colors/store-add-colors' => [$userColorController, 'addColors'],
    '/reports' => [$reportController, 'index'],
    '/reports/filter' => [$reportController, 'filter'],
    '/users-colors/remove-colors/(\d+)' => [$userColorController, 'show'],
    '/users-colors/destroy-colors/(\d+)/(\d+)' => [$userColorController, 'removeColorsToUser'],
    '/users/check-update-user/(\d+)' => [$userController, 'checkUpdateUser'],
    '/colors/check-update-color/(\d+)' => [$colorController, 'checkUpdateColor'],
    '/users/check-delete-user/(\d+)' => [$userController, 'checkDeleteUser'],
    '/colors/check-delete-color/(\d+)' => [$colorController, 'checkDeleteColor'],

];

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$matched = false;
foreach ($routes as $pattern => $callable) {
    if (preg_match("#^" . $pattern . "$#", $url, $matches)) {
        array_shift($matches);
        call_user_func_array($callable, $matches);
        $matched = true;
        break;
    }
}
