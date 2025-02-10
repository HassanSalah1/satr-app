<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpeechResource\Pages;
use App\Filament\Resources\SpeechResource\RelationManagers;
use App\Models\Author;
use App\Models\Speech;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{TextInput, Select, DatePicker, FileUpload, Toggle};
use Filament\Tables\Columns\{TextColumn, ImageColumn, IconColumn};
use Alkoumi\LaravelHijriDate\Hijri;

class SpeechResource extends Resource
{
    protected static ?string $model = Speech::class;

    protected static ?string $navigationIcon = 'heroicon-o-microphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(255),
                Select::make('author_id')
                    ->label('Author')
                    ->relationship('author', 'name')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->createOptionForm([
                        TextInput::make('name')->required(),
                    ])
                    ->createOptionUsing(function (array $data) {
                        $author = Author::create($data);
                        return $author->id;
                    }),
                DatePicker::make('date')->required(),
                TextInput::make('link')->required()->url()->maxLength(255),
                Toggle::make('status')->default(true),
                Toggle::make('featured'),
                FileUpload::make('image')->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('author.name')->sortable()->searchable(),
                TextColumn::make('date')->sortable(),
                ImageColumn::make('image'),
                IconColumn::make('status')->boolean(),
                TextColumn::make('link')->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpeeches::route('/'),
            'create' => Pages\CreateSpeech::route('/create'),
            'edit' => Pages\EditSpeech::route('/{record}/edit'),
        ];
    }
}
