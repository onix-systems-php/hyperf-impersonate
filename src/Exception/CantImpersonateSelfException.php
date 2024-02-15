<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Exception;

class CantImpersonateSelfException extends \RuntimeException
{
    public function __construct(
        string $message = 'It is not possible to impersonate self.',
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
