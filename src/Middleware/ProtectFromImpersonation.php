<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Middleware;

use Hyperf\Context\ApplicationContext;
use OnixSystemsPHP\HyperfImpersonate\Exception\ProtectedAgainstImpersonationException;
use OnixSystemsPHP\HyperfImpersonate\Service\ImpersonateService;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProtectFromImpersonation implements MiddlewareInterface
{
    /**
     * @throws ContainerExceptionInterface|NotFoundExceptionInterface|ProtectedAgainstImpersonationException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $impersonateService = ApplicationContext::getContainer()->get(ImpersonateService::class);

        if ($impersonateService->isImpersonating()) {
            throw new ProtectedAgainstImpersonationException();
        }

        return $handler->handle($request);
    }
}
