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
    protected static ?string $modelLabel = 'خطبة'; // سيظهر "خطاب" في الواجهة
    protected static ?string $pluralModelLabel = "الخطب"; // سيظهر "الخطابات" في الواجهة

    public static function getBreadcrumb(): string
    {
        return 'الخطب';
    }

    public static function getBreadcrumbs(): array
    {
        return [
            url()->current() => 'الخطب',
            route('filament.admin.pages.dashboard') => 'القائمة الرئيسية',
        ];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('name'))
                    ->required()
                    ->maxLength(255),
                Select::make('author_id')
                    ->label(__('author'))
                    ->relationship('author', 'name')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->createOptionForm([
                        TextInput::make('name')->label(__('name'))->required(),
                    ])
                    ->createOptionUsing(function (array $data) {
                        $author = Author::create($data);
                        return $author->id;
                    }),
                DatePicker::make('date')->label(__('date'))->required(),
                TextInput::make('link')->label(__('link'))->required()->url()->maxLength(255),
                Toggle::make('status')->label(__('status'))->default(true),
                Toggle::make('featured')->label(__('featured')),
                FileUpload::make('image')
                    ->label(__('image'))
                    ->image()
                    ->maxSize(2048)
                    ->validationMessages([
                        'maxSize' => 'حجم الملف يجب ألا يتجاوز 2 ميجابايت.',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                TextColumn::make('name')->sortable()->searchable(),
//                TextColumn::make('author.name')->sortable()->searchable(),
//                TextColumn::make('date')->sortable(),
//                ImageColumn::make('image'),
//                IconColumn::make('status')->boolean(),
//                TextColumn::make('link')->limit(50),
                TextColumn::make('name')->label(__('name'))->sortable()->searchable(), // سيظهر "الاسم"
                TextColumn::make('author.name')->label(__('author'))->sortable()->searchable(), // سيظهر "المؤلف"
                TextColumn::make('date')->label(__('date'))->date(), // سيظهر "التاريخ"
                ImageColumn::make('image')->label(__('image')), // سيظهر "الصورة"
                Tables\Columns\BooleanColumn::make('status')->label(__('status')), // سيظهر "الحالة"
                Tables\Columns\BooleanColumn::make('featured')->label(__('featured')), // سيظهر "مميز"
                TextColumn::make('link')->limit(50)->label(__('link')), // سيظهر "الرابط"
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
