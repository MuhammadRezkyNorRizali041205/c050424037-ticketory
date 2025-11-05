<?php

namespace App\Filament\Admin\Resources\Units\Pages;

use App\Filament\Admin\Resources\Units\UnitResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class EditUnit extends EditRecord
{
    protected static string $resource = UnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Delete')
                ->requiresConfirmation()
                ->modalHeading('Delete Unit')
                ->modalDescription('Apakah kamu yakin ingin menghapus unit ini?')
                ->modalButton('Hapus')
                ->color('danger'),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Saved changes';
    }
}
