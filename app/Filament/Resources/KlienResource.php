<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KlienResource\Pages;
use App\Filament\Resources\KlienResource\RelationManagers;
use App\Filament\Resources\KlienResource\Widgets\KlienOverview;
use App\Models\Klien;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KlienResource extends Resource
{
    protected static ?string $model = Klien::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $pluralLabel = 'Klien';

    protected static ?string $slug = 'klien';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('telp')
                    ->tel()
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('alamat')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama'),
                TextColumn::make('email'),
                TextColumn::make('telp'),
                TextColumn::make('alamat'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageKliens::route('/'),
        ];
    }
}
