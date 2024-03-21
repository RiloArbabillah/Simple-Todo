<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Klien;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $pluralLabel = 'Project';

    protected static ?string $slug = 'project';

    public static function form(Form $form): Form
    {
        // asdasd
        return $form
            ->schema([
                Hidden::make('user_id')
                    ->default(Auth::user()->id),
                Select::make('klien_id')
                    // ->relationship('klien', 'nama')
                    ->options(Klien::all()->pluck('nama', 'id'))
                    ->required()
                    ->columnSpanFull()
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $search): array => 
                        Klien::where('nama', 'like', "%{$search}%")->pluck('nama', 'id')->toArray()
                    )
                    ->preload(),
                TextInput::make('nama')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('keterangan')
                    ->required()
                    ->columnSpanFull(),
                DateTimePicker::make('due_at')
                    ->native(false)
                    ->required(),
                DateTimePicker::make('done_at')
                    ->native(false)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('klien.nama'),
                TextColumn::make('nama'),
                TextColumn::make('keterangan'),
                TextColumn::make('due_at'),
                TextColumn::make('done_at')
                    ->default('-'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('done')
                        ->label('Done')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->hidden(fn (Project $record) => $record->done_at)
                        ->action(fn(Project $record) => $record->update([
                            'done_at' => now()
                        ])),
                    Tables\Actions\Action::make('undone')
                        ->label('Undone')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->hidden(fn (Project $record) => !$record->done_at)
                        ->action(fn(Project $record) => $record->update([
                            'done_at' => null
                        ])),
                ])
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
            'index' => Pages\ManageProjects::route('/'),
        ];
    }
}
