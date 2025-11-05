<?php

namespace App\Filament\Admin\Resources\Units\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Unit')
                ->placeholder('Masukkan nama unit')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('code')
                ->label('Kode Unit')
                ->placeholder('Contoh: UN-001')
                ->maxLength(50)
                ->unique(ignoreRecord: true) // agar kode tidak duplikat saat edit
                ->required(),

            Forms\Components\Select::make('unit_location_id')
                ->label('Lokasi Unit')
                ->relationship('unitLocation', 'name') // pastikan model Unit punya relasi ini
                ->searchable()
                ->preload()
                ->required(),
        ]);
    }
}
