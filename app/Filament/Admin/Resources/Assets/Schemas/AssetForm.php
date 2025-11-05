<?php

namespace App\Filament\Admin\Resources\Assets\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class AssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                // kolom kiri-kanan diatur dengan columnSpan(1) dan columns(2) di bawah
                Forms\Components\TextInput::make('name')
                    ->label('Nama Aset')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(1),

                Forms\Components\Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')   // pastikan relasi 'category' ada di model Asset
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpan(1),

                Forms\Components\Select::make('unit_id')
                    ->label('Unit / Lokasi')
                    ->relationship('unit', 'name')       // pastikan relasi 'unit' ada di model Asset
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpan(1),

                Forms\Components\Select::make('vendor_id')
                    ->label('Vendor')
                    ->relationship('vendor', 'name')     // pastikan relasi 'vendor' ada di model Asset
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpan(1),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Baik',
                        'maintenance' => 'Dalam Perbaikan',
                        'broken' => 'Rusak',
                    ])
                    ->default('active')
                    ->required()
                    ->columnSpan(1),

                Forms\Components\TextInput::make('purchase_price')
                    ->label('Harga Beli')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->columnSpan(1),

                Forms\Components\DatePicker::make('purchase_date')
                    ->label('Tanggal Pembelian')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->required()
                    ->columnSpan(1),

                Forms\Components\DatePicker::make('warranty_expiry')
                    ->label('Masa Garansi')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->nullable()
                    ->columnSpan(1),
            ])
            ->columns(2); // ← bikin layout 2 kolom tanpa Section / Grid
    }
}
