<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class AppSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'الاعدادات';
    protected static string $settings = GeneralSettings::class;

    public function getTitle(): string
    {
        return __('settings.app_settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('settings.app_settings'); // ترجمة اسم الصفحة في القائمة الجانبية
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('site_name')->label(__('settings.site_name'))->required(),
                Forms\Components\Textarea::make('site_description')->label(__('settings.site_description'))->required(),
                Forms\Components\TextInput::make('email')->label(__('settings.email'))->email()->required(),
                Forms\Components\TextInput::make('phone')->label(__('settings.phone'))->required(),
                Forms\Components\Toggle::make('status')->label(__('settings.status'))->required(),
                Forms\Components\TextInput::make('instagram')->label(__('settings.instagram'))->url(),
                Forms\Components\TextInput::make('site_url')->label(__('settings.site_url'))->url()->required(),
                Forms\Components\TextInput::make('facebook')->label(__('settings.facebook'))->url(),
                Forms\Components\FileUpload::make('logo')
                    ->required()
                    ->label(__('settings.logo'))
                    ->image()
                    ->maxSize(2048)
                    ->validationMessages([
                        'maxSize' => 'حجم الملف يجب ألا يتجاوز 2 ميجابايت.',
                    ])
            ]);
    }
}
