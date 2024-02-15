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

class ImpersonateTakeDTO extends AbstractDTO
{
    public int $requested_id;

    /** @var null|Impersonatable */
    public $impersonated;

    /** @var null|Impersonatable */
    public $impersonator;

    /** @var AuthTokensDTO */
    public $token;
}
