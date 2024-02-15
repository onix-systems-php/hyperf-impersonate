<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;
use OnixSystemsPHP\HyperfImpersonate\Controller\ImpersonateController;

Router::addGroup('/v1/impersonate', function () {
    Router::get('/take/{id}', [ImpersonateController::class, 'take']);
    Router::get('/leave', [ImpersonateController::class, 'leave']);
    Router::get('/info', [ImpersonateController::class, 'info']);
});
