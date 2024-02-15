<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Event;

use OnixSystemsPHP\HyperfImpersonate\Contract\Impersonatable;

class LeaveImpersonation
{
    public function __construct(
        public Impersonatable $impersonator,
        public Impersonatable $impersonated,
    ) {}
}
