<?php

namespace App\Filament\Admin\Resources\Tickets\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),

            Select::make('category_id')
                ->label('Category')
                ->relationship('category', 'name')
                ->searchable()
                ->required(),
        ]);
    }
}
