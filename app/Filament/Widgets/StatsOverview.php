<?php

namespace App\Filament\Widgets;

use App\Models\Author;
use App\Models\Donation;
use App\Models\Speech;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('عدد الشيوخ', Author::count())
                ->description('إجمالي عدد الشيوخ')
                ->color('warning')
                ->icon('heroicon-o-user'),
            Stat::make('عدد الخطب', Speech::count())
                ->description('إجمالي عدد الخطب')
                ->color('success')
                ->icon('heroicon-o-microphone'),
            Stat::make('عدد المتبرعين', Donation::count())
                ->description('إجمالي عدد المتبرعين')
                ->color('primary')
                ->icon('heroicon-o-rectangle-stack'),
        ];
    }
}
