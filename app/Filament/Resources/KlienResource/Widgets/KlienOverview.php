<?php

namespace App\Filament\Resources\KlienResource\Widgets;

use App\Models\Klien;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KlienOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Klien', Klien::count())
                ->icon('heroicon-o-user-group'),
        ];
    }
}
