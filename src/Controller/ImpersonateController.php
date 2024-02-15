<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Controller;

use OnixSystemsPHP\HyperfAuth\AuthManager;
use OnixSystemsPHP\HyperfCore\Controller\AbstractController;
use OnixSystemsPHP\HyperfImpersonate\Resource\ResourceInfoImpersonate;
use OnixSystemsPHP\HyperfImpersonate\Resource\ResourceLeaveImpersonate;
use OnixSystemsPHP\HyperfImpersonate\Resource\ResourceTakeImpersonate;
use OnixSystemsPHP\HyperfImpersonate\Service\ImpersonateService;
use OpenApi\Attributes as OA;

class ImpersonateController extends AbstractController
{
    public function __construct(
        private readonly AuthManager $authManager,
        private readonly ImpersonateService $impersonateService,
    ) {}

    #[OA\Get(
        path: '/v1/impersonate/take/{id}',
        operationId: 'impersonateTake',
        summary: 'Take impersonate',
        security: [['bearerAuth' => []]],
        tags: ['impersonate'],
        parameters: [
            new OA\Parameter(ref: '#/components/parameters/Locale'),
            new OA\Parameter(
                name: 'id',
                description: 'User id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(response: 200, description: '', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'status', type: 'string'),
                new OA\Property(property: 'data', ref: '#/components/schemas/ResourceTakeImpersonate'),
            ])),
            new OA\Response(ref: '#/components/responses/401', response: 401),
            new OA\Response(ref: '#/components/responses/403', response: 403),
            new OA\Response(ref: '#/components/responses/404', response: 404),
            new OA\Response(ref: '#/components/responses/422', response: 422),
            new OA\Response(ref: '#/components/responses/500', response: 500),
        ],
    )]
    public function take(int $id): ResourceTakeImpersonate
    {
        return ResourceTakeImpersonate::make(
            $this->impersonateService->take(
                $this->authManager->user(),
                $this->impersonateService->findUserById($id)
            )
        );
    }

    #[OA\Get(
        path: '/v1/impersonate/leave',
        operationId: 'impersonateLeave',
        summary: 'Leave impersonate',
        security: [['bearerAuth' => []]],
        tags: ['impersonate'],
        parameters: [new OA\Parameter(ref: '#/components/parameters/Locale')],
        responses: [
            new OA\Response(response: 200, description: '', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'status', type: 'string'),
                new OA\Property(property: 'data', ref: '#/components/schemas/ResourceLeaveImpersonate'),
            ])),
            new OA\Response(ref: '#/components/responses/401', response: 401),
            new OA\Response(ref: '#/components/responses/403', response: 403),
            new OA\Response(ref: '#/components/responses/404', response: 404),
            new OA\Response(ref: '#/components/responses/422', response: 422),
            new OA\Response(ref: '#/components/responses/500', response: 500),
        ],
    )]
    public function leave(): ResourceLeaveImpersonate
    {
        return ResourceLeaveImpersonate::make(
            $this->impersonateService->leave()
        );
    }

    #[OA\Get(
        path: '/v1/impersonate/info',
        operationId: 'impersonateInfo',
        summary: 'Impersonate info',
        security: [['bearerAuth' => []]],
        tags: ['impersonate'],
        parameters: [new OA\Parameter(ref: '#/components/parameters/Locale')],
        responses: [
            new OA\Response(response: 200, description: '', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'status', type: 'string'),
                new OA\Property(property: 'data', ref: '#/components/schemas/ResourceInfoImpersonate'),
            ])),
            new OA\Response(ref: '#/components/responses/401', response: 401),
            new OA\Response(ref: '#/components/responses/403', response: 403),
            new OA\Response(ref: '#/components/responses/404', response: 404),
            new OA\Response(ref: '#/components/responses/422', response: 422),
            new OA\Response(ref: '#/components/responses/500', response: 500),
        ],
    )]
    public function info(): ResourceInfoImpersonate
    {
        return ResourceInfoImpersonate::make(
            $this->impersonateService->info()
        );
    }
}
