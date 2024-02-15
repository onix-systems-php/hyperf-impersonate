<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Resource;

use OnixSystemsPHP\HyperfCore\Resource\AbstractResource;
use OnixSystemsPHP\HyperfImpersonate\DTO\ImpersonateTakeDTO;
use OpenApi\Attributes as OA;

/**
 * @method __construct(ImpersonateTakeDTO $resource)
 * @property ImpersonateTakeDTO $resource
 */
#[OA\Schema(
    schema: 'ResourceTakeImpersonate',
    properties: [
        new OA\Property(property: 'requested_id', type: 'number'),
        new OA\Property(property: 'impersonated', ref: '#/components/schemas/ResourceUser'),
        new OA\Property(property: 'impersonator', ref: '#/components/schemas/ResourceUser'),
        new OA\Property(property: 'token', ref: '#/components/schemas/ResourceAuthToken'),
    ],
)]
class ResourceTakeImpersonate extends AbstractResource
{
    public function toArray(): array
    {
        return [
            'requested_id' => $this->resource->requested_id,
            'impersonated' => $this->resource->impersonated,
            'impersonator' => $this->resource->impersonator,
            'token' => $this->resource->token,
        ];
    }
}
