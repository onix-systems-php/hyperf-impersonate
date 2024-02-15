<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Exception;

class AlreadyImpersonatingException extends \RuntimeException
{
    public function __construct(
        string $message = 'This user is already impersonating someone.',
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
