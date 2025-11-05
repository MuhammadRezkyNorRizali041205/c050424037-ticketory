<?php

namespace App\Filament\Admin\Resources\Units\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions; // ✅ gunakan namespace Actions, bukan Tables\Actions

class UnitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom Nama Unit
                TextColumn::make('name')
                    ->label('Nama Unit')
                    ->searchable()
                    ->sortable(),

                // Kolom Lokasi Unit (Relasi)
                TextColumn::make('unitLocation.name')
                    ->label('Lokasi Unit')
                    ->sortable()
                    ->toggleable(),

                // Kolom Tanggal Dibuat
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Kolom Terakhir Diperbarui
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([])

            // ✅ Aksi per record
            ->actions([
                Actions\EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->color('warning'),

                Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Unit')
                    ->modalDescription('Apakah kamu yakin ingin menghapus unit ini?')
                    ->modalButton('Ya, Hapus'),
            ])

            // ✅ Aksi bulk (hapus banyak sekaligus)
            ->bulkActions([
                Actions\DeleteBulkAction::make()
                    ->label('Hapus yang dipilih')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation(),
            ]);
    }
}
