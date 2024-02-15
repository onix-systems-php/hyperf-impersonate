<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Trait;

use Hyperf\Context\ApplicationContext;
use OnixSystemsPHP\HyperfImpersonate\Contract\Impersonatable as ImpersonatableInterface;
use OnixSystemsPHP\HyperfImpersonate\DTO\ImpersonateLeaveDTO;
use OnixSystemsPHP\HyperfImpersonate\DTO\ImpersonateTakeDTO;
use OnixSystemsPHP\HyperfImpersonate\Service\ImpersonateService;

trait Impersonatable
{
    /**
     * Return true or false if the user can impersonate another user.
     */
    public function canImpersonate(): bool
    {
        return true;
    }

    /**
     * Return true or false if the user can be impersonate.
     */
    public function canBeImpersonated(): bool
    {
        return true;
    }

    /**
     * Impersonate the given user.
     */
    public function impersonate(ImpersonatableInterface $user): ImpersonateTakeDTO
    {
        return ApplicationContext::getContainer()->get(ImpersonateService::class)->take($this, $user);
    }

    /**
     * Check if the current user is impersonated.
     */
    public function isImpersonated(): bool
    {
        return ApplicationContext::getContainer()->get(ImpersonateService::class)->isImpersonating();
    }

    /**
     * Leave the current impersonation.
     */
    public function leaveImpersonation(): ImpersonateLeaveDTO
    {
        return ApplicationContext::getContainer()->get(ImpersonateService::class)->leave();
    }
}
