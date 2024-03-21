<?php

namespace App\Filament\Resources\KlienResource\Pages;

use App\Filament\Resources\KlienResource;
use App\Filament\Resources\KlienResource\Widgets\KlienOverview;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKliens extends ManageRecords
{
    protected static string $resource = KlienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            KlienOverview::class,
        ];
    }
}
