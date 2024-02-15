<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Resource;

use OnixSystemsPHP\HyperfCore\Resource\AbstractResource;
use OnixSystemsPHP\HyperfImpersonate\DTO\ImpersonateInfoDTO;
use OpenApi\Attributes as OA;

/**
 * @method __construct(ImpersonateInfoDTO $resource)
 * @property ImpersonateInfoDTO $resource
 */
#[OA\Schema(
    schema: 'ResourceInfoImpersonate',
    properties: [
        new OA\Property(property: 'impersonating', type: 'boolean'),
        new OA\Property(property: 'impersonated', ref: '#/components/schemas/ResourceUser'),
        new OA\Property(property: 'impersonator', ref: '#/components/schemas/ResourceUser'),
        new OA\Property(property: 'token', ref: '#/components/schemas/ResourceAuthToken'),
    ],
)]
class ResourceInfoImpersonate extends AbstractResource
{
    public function toArray(): array
    {
        return [
            'impersonating' => $this->resource->impersonating,
            'impersonated' => $this->resource->impersonated,
            'impersonator' => $this->resource->impersonator,
            'token' => $this->resource->token,
        ];
    }
}
