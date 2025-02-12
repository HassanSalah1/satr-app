<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class AppSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';
    protected static string $settings = GeneralSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('site_name')->required(),
                Forms\Components\Textarea::make('site_description')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('phone')->required(),
                Forms\Components\Toggle::make('status')->required(),
                Forms\Components\TextInput::make('instagram')->url(),
                Forms\Components\TextInput::make('site_url')->url()->required(),
                Forms\Components\TextInput::make('facebook')->url(),
                Forms\Components\FileUpload::make('logo')->image(),
            ]);
    }
}
