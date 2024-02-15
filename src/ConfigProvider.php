<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfImpersonate;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
            ],
            'commands' => [
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'aspects' => [
            ],
            'publish' => [
                [
                    'id' => 'config_auth',
                    'description' => 'The auth config for onix-systems-php/hyperf-impersonate.',
                    'source' => __DIR__ . '/../publish/config/impersonate.php',
                    'destination' => BASE_PATH . '/config/autoload/impersonate.php',
                ],
            ],
        ];
    }
}
