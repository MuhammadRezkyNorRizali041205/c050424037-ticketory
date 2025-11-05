<?php

namespace App\Filament\Admin\Resources\UnitLocations\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;               // ✅ actions v4 ada di namespace ini
use Illuminate\Support\Collection;  // untuk bulk action

class UnitLocationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Lokasi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            // ✅ FILAMENT v4: pakai recordActions (bukan actions)
            ->recordActions([
                Actions\EditAction::make()
                    ->label('Edit')
                    ->color('warning'),

                Actions\DeleteAction::make()
                    ->label('Delete')
                    ->requiresConfirmation()
                    ->modalHeading('Delete Unit Location')
                    ->modalDescription('Apakah kamu yakin ingin menghapus lokasi ini?')
                    ->modalSubmitActionLabel('Hapus')
                    ->color('danger'),
            ])

            // ✅ FILAMENT v4: bulk di toolbar/header actions
            ->toolbarActions([
                Actions\BulkAction::make('delete')
                    ->label('Hapus yang dipilih')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (Collection $records) => $records->each->delete()),
            ])

            ->emptyStateHeading('Tidak ada data lokasi unit')
            ->emptyStateDescription('Belum ada data lokasi unit yang tersimpan. Tambahkan sekarang.');
    }
}
