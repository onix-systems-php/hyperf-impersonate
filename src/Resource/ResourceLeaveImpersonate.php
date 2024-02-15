<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Resource;

use OnixSystemsPHP\HyperfCore\Resource\AbstractResource;
use OnixSystemsPHP\HyperfImpersonate\DTO\ImpersonateLeaveDTO;
use OpenApi\Attributes as OA;

/**
 * @method __construct(ImpersonateLeaveDTO $resource)
 * @property ImpersonateLeaveDTO $resource
 */
#[OA\Schema(
    schema: 'ResourceLeaveImpersonate',
    properties: [
        new OA\Property(property: 'impersonator', ref: '#/components/schemas/ResourceUser'),
        new OA\Property(property: 'token', ref: '#/components/schemas/ResourceAuthToken'),
    ],
)]
class ResourceLeaveImpersonate extends AbstractResource
{
    public function toArray(): array
    {
        return [
            'impersonator' => $this->resource->impersonator,
            'token' => $this->resource->token,
        ];
    }
}
