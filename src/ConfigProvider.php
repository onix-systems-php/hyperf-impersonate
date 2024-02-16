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
        $languagesPath = $this->getLanguagePath();

        return [
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The impersonate config for onix-systems-php/hyperf-impersonate.',
                    'source' => __DIR__ . '/../publish/config/impersonate.php',
                    'destination' => BASE_PATH . '/config/autoload/impersonate.php',
                ],
                [
                    'id' => 'en_us_translation',
                    'description' => 'The impersonate English translation for onix-systems-php/hyperf-impersonate.',
                    'source' => __DIR__ . '/../publish/languages/en-US/impersonate.php',
                    'destination' => $languagesPath . '/en-US/impersonate.php',
                ],
                [
                    'id' => 'ua_uk_translation',
                    'description' => 'The impersonate Ukraine translation for onix-systems-php/hyperf-impersonate.',
                    'source' => __DIR__ . '/../publish/languages/uk-UA/impersonate.php',
                    'destination' => $languagesPath . '/uk-UA/impersonate.php',
                ],
            ],
        ];
    }

    private function getLanguagePath(): string
    {
        $languagesPath = BASE_PATH . '/storage/languages';
        $translationConfigFile = BASE_PATH . '/config/autoload/translation.php';
        if (file_exists($translationConfigFile)) {
            $translationConfig = include $translationConfigFile;
            $languagesPath = $translationConfig['path'] ?? $languagesPath;
        }

        return $languagesPath;
    }
}
