<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public string $site_description;
    public string $email;
    public string $phone;
    public string $status;
    public string $instagram;
    public string $site_url;
    public string $facebook;
    public string $logo;

    public static function group(): string
    {
        return 'general';
    }
}
