<?php

declare(strict_types=1);

use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\NotificationPackageController;
use App\Http\Controllers\Api\PingController;
use Illuminate\Support\Facades\Route;


Route::post('/notification-package', [NotificationPackageController::class, 'post']);
Route::get('/notifications/receiver/{receiver}', [NotificationController::class, 'getByReceiver']);
Route::get('/ping', [PingController::class, 'ping']);