<?php

namespace Pstoregr\Myaade\Config;

/**
 * AppConfig class
 *  
 * Here you can pass all your app configs
 */
class AppConfig
{
    /**
     * @var protected static array $settings
     */
    protected static array $settings;

    /** 
     * @param array $settings
     * 
     * @return void
     */
    public static function load($settings): void
    {
        require __DIR__ . '/../../vendor/autoload.php';

        self::$settings = $settings;

        if ((new self)->isEmptyEnv()) {
            dd("Specify the environment settings [dev|prod].");
        } elseif ((new self)->isEmptyCredentials()) {
            dd("Specify the user credentials.");
        } else {
            \Firebed\AadeMyData\Http\MyDataRequest::setEnvironment($settings['environment']);
            \Firebed\AadeMyData\Http\MyDataRequest::setCredentials($settings['credentials']['user_id'], $settings['credentials']['subscription_key']);
        }
    }

    /** 
     * @return bool
     */
    private function isEmptyEnv(): bool
    {
        return empty(self::$settings['environment']);
    }

    /**
     * @return bool
     */
    private function isEmptyCredentials(): bool
    {
        return empty(self::$settings['credentials']['user_id']) || empty(self::$settings['credentials']['subscription_key']);
    }
}
