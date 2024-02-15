<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Exception;

class CantBeImpersonatedException extends \RuntimeException
{
    public function __construct(
        string $message = 'Target user can\'t be impersonated.',
        int $code = 403,
        \Throwable $previous = null,
    ) {
        parent::__construct(
            $message,
            $code,
            $previous,
        );
    }
}
