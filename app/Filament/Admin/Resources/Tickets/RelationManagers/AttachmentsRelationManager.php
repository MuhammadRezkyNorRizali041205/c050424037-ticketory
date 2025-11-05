<?php

namespace App\Filament\Admin\Resources\Tickets\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class AttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'attachments';

    protected static ?string $recordTitleAttribute = 'file_path';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),

            FileUpload::make('file_path')
                ->label('Image')
                ->image()
                ->directory('ticket-attachments')
                ->disk('public')
                ->visibility('public')
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('file_path')
            ->columns([
                TextColumn::make('user.name')
                    ->label('Uploaded By')
                    ->sortable(),

                ImageColumn::make('file_path')
                    ->label('Preview')
                    ->disk('public'),

                TextColumn::make('created_at')
                    ->label('Uploaded')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])

            // Aksi di bagian atas tabel
            ->headerActions([
                CreateAction::make(),
            ])

            // Aksi per baris (record)
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])

            // Aksi bulk (massal)
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
