<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'My Website');
        $this->migrator->add('general.site_description', 'This is my website description.');
        $this->migrator->add('general.email', 'admin@example.com');
        $this->migrator->add('general.phone', '123456789');
        $this->migrator->add('general.status', 0);
        $this->migrator->add('general.instagram', 'https://instagram.com/myaccount');
        $this->migrator->add('general.site_url', 'https://example.com');
        $this->migrator->add('general.facebook', 'https://facebook.com/myaccount');
        $this->migrator->add('general.logo', '');
    }
};
