<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Exception;

use OnixSystemsPHP\HyperfCore\Exception\BusinessException;

use function Hyperf\Translation\__;

class AlreadyImpersonatingException extends BusinessException
{
    public function __construct(
        int $code = 403,
        string $message = null,
        ?\Throwable $previous = null,
    ) {
        parent::__construct(
            $code,
            $message ?? __('impersonate.already_impersonating'),
            $previous,
        );
    }
}
