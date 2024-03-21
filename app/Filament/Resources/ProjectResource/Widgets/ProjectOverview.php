<?php

namespace App\Filament\Resources\ProjectResource\Widgets;

use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProjectOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Project', Project::count())
                ->icon('heroicon-o-clipboard-document-list'),
            Stat::make('Project Selesai', Project::whereNotNull('done_at')->count())
                ->icon('heroicon-o-clipboard-document-check'),
            Stat::make('Project Belum Selesai', Project::whereNull('done_at')->count())
                ->icon('heroicon-o-clipboard-document-list'),
        ];
    }
}
