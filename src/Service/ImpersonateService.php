<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate\Service;

use Hyperf\Contract\ConfigInterface;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;
use OnixSystemsPHP\HyperfAuth\AuthManager;
use OnixSystemsPHP\HyperfAuth\DTO\AuthTokensDTO;
use OnixSystemsPHP\HyperfCore\Service\Service;
use OnixSystemsPHP\HyperfImpersonate\Contract\Impersonatable;
use OnixSystemsPHP\HyperfImpersonate\DTO\ImpersonateInfoDTO;
use OnixSystemsPHP\HyperfImpersonate\DTO\ImpersonateLeaveDTO;
use OnixSystemsPHP\HyperfImpersonate\DTO\ImpersonateTakeDTO;
use OnixSystemsPHP\HyperfImpersonate\Event\LeaveImpersonation;
use OnixSystemsPHP\HyperfImpersonate\Event\TakeImpersonation;
use OnixSystemsPHP\HyperfImpersonate\Exception\AlreadyImpersonatingException;
use OnixSystemsPHP\HyperfImpersonate\Exception\CantBeImpersonatedException;
use OnixSystemsPHP\HyperfImpersonate\Exception\CantImpersonateException;
use OnixSystemsPHP\HyperfImpersonate\Exception\CantImpersonateSelfException;
use OnixSystemsPHP\HyperfImpersonate\Exception\NotImpersonatingException;
use Psr\EventDispatcher\EventDispatcherInterface;

use function Hyperf\Translation\__;

#[Service]
class ImpersonateService
{
    public function __construct(
        private readonly AuthManager $authManager,
        private readonly ConfigInterface $config,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {}

    public function findUserById(int $id): Impersonatable
    {
        return $this->authManager->provider()->retrieveByCredentials($id);
    }

    public function isImpersonating(): bool
    {
        return $this->getImpersonatorId() !== null;
    }

    public function getImpersonatorId(): ?int
    {
        return $this->authManager->tokenGuard()->getCustomClaim($this->getSessionKey());
    }

    public function setImpersonatorId(Impersonatable $impersonator): void
    {
        $this->authManager->tokenGuard()->customClaims([$this->getSessionKey() => $impersonator->getId()]);
    }

    public function take(?Impersonatable $from, Impersonatable $to): ImpersonateTakeDTO
    {
        if ($from === null) {
            throw new NotFoundHttpException(__('impersonate.impersonator_not_found'));
        }

        if (! $this->isImpersonating()) {
            if ($to->getId() !== $from->getId()) {
                if ($to->canBeImpersonated()) {
                    if ($from->canImpersonate()) {
                        $this->deferLogout();
                        $this->setImpersonatorId($from);
                        $token = $this->deferLogin($to);

                        $this->eventDispatcher->dispatch(new TakeImpersonation($from, $to));

                        return ImpersonateTakeDTO::make([
                            'requested_id' => $to->getId(),
                            'impersonated' => $to,
                            'impersonator' => $from,
                            'token' => $token,
                        ]);
                    }

                    throw new CantImpersonateException();
                }

                throw new CantBeImpersonatedException();
            }

            throw new CantImpersonateSelfException();
        }

        throw new AlreadyImpersonatingException();
    }

    public function leave(): ImpersonateLeaveDTO
    {
        if ($this->isImpersonating()) {
            $impersonated = $this->authManager->user();
            $impersonator = $this->findUserById($this->getImpersonatorId());
            $this->deferLogout();
            $this->clear();
            $token = $this->deferLogin($impersonator);

            $this->eventDispatcher->dispatch(new LeaveImpersonation($impersonator, $impersonated));

            return ImpersonateLeaveDTO::make([
                'impersonator' => $impersonator,
                'token' => $token,
            ]);
        }

        throw new NotImpersonatingException();
    }

    public function info(): ImpersonateInfoDTO
    {
        $token = $this->retrieveToken();

        return ImpersonateInfoDTO::make([
            'impersonating' => $this->isImpersonating(),
            'impersonated' => $this->authManager->user(),
            'impersonator' => $this->isImpersonating()
                ? $this->findUserById($this->getImpersonatorId())
                : null,
            'token' => $token,
        ]);
    }

    public function retrieveToken(): string
    {
        return $this->authManager->tokenGuard()->getAccessToken();
    }

    public function deferLogout(): void
    {
        if (! empty($this->authManager->user())) {
            $this->authManager->logout();
        }
    }

    public function deferLogin(Impersonatable $impersonator): AuthTokensDTO
    {
        return $this->authManager->login($impersonator);
    }

    public function clear(): void
    {
        $this->authManager->tokenGuard()->customClaims([$this->getSessionKey() => null]);
    }

    public function getSessionKey(): string
    {
        return $this->config->get('impersonate.session_key');
    }
}
