<?php

namespace App\Filament\Admin\Resources\UnitLocations\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class UnitLocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Lokasi')
                ->required()
                ->maxLength(255)
                ->placeholder('Masukkan nama lokasi unit'),
        ]);
    }
}
