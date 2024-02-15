<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Contract;

use OnixSystemsPHP\HyperfCore\Contract\CoreAuthenticatable;
use OnixSystemsPHP\HyperfImpersonate\DTO\ImpersonateLeaveDTO;
use OnixSystemsPHP\HyperfImpersonate\DTO\ImpersonateTakeDTO;

interface Impersonatable extends CoreAuthenticatable
{
    public function canImpersonate(): bool;

    public function canBeImpersonated(): bool;

    public function impersonate(self $user): ImpersonateTakeDTO;

    public function isImpersonated(): bool;

    public function leaveImpersonation(): ImpersonateLeaveDTO;
}
