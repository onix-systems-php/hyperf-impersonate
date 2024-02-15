<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Exception;

class ProtectedAgainstImpersonationException extends \RuntimeException
{
    public function __construct(
        string $message = 'These data can\'t be accessed by an impersonator.',
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
