<?php declare(strict_types = 1);

use App\Controllers\BaseController;
use Ssil\Foundation\Router\Route;

return [
    'index' => Route::get('/', [BaseController::class, 'index']),
];
