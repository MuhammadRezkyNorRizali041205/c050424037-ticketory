<?php

namespace App\Filament\Admin\Resources\Tickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->label('Title'),

                TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->badge()
                    ->colors([
                        'success' => 'resolved',
                        'warning' => 'pending',
                        'info' => 'in_progress',
                        'danger' => 'rejected',
                        'gray' => 'open',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'open' => 'Open',
                        'in_progress' => 'In Progress',
                        'pending' => 'Pending',
                        'resolved' => 'Resolved',
                        'rejected' => 'Rejected',
                        default => ucfirst($state),
                    }),

                TextColumn::make('priority')->label('Priority')->sortable(),
                TextColumn::make('category.name')->label('Category')->sortable()->searchable(),
                TextColumn::make('user.name')->label('Reporter')->sortable()->searchable(),
                TextColumn::make('technician.user.name')->label('Assigned Technician')->sortable()->searchable()->default('Unassigned'),

                TextColumn::make('created_at')->label('Created At')->dateTime()->sortable(),
                TextColumn::make('updated_at')->label('Updated At')->dateTime()->sortable(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
