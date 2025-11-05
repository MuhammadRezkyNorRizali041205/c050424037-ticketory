<?php

namespace App\Filament\Admin\Resources\Units\Pages;

use App\Filament\Admin\Resources\Units\UnitResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListUnits extends ListRecords
{
    protected static string $resource = UnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New unit')
                ->color('warning'),
        ];
    }
}
