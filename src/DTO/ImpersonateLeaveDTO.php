<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\DTO;

use OnixSystemsPHP\HyperfAuth\DTO\AuthTokensDTO;
use OnixSystemsPHP\HyperfCore\DTO\AbstractDTO;
use OnixSystemsPHP\HyperfImpersonate\Contract\Impersonatable;

class ImpersonateLeaveDTO extends AbstractDTO
{
    /** @var null|Impersonatable */
    public $impersonator;

    /** @var AuthTokensDTO */
    public $token;
}
