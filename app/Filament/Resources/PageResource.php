<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{TextInput, RichEditor};
use Filament\Tables\Columns\{TextColumn};
class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $modelLabel = 'صفحة';
    protected static ?string $pluralModelLabel = "الصفحات";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label(__('name'))->required()->maxLength(255),
                TextInput::make('slug')
                    ->label(__('slug'))
                    ->unique()
                    ->required()
                    ->maxLength(255)
                ->disabledOn('edit'),
                RichEditor::make('body')->label(__('body'))->required()->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('name'))->sortable()->searchable(),
                TextColumn::make('slug')->label(__('slug'))->sortable(),
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
            'index' => Pages\ListPages::route('/'),
//            'create' => Pages\CreatePage::route('/create'),
//            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
