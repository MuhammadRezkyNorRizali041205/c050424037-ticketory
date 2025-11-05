<?php

namespace App\Filament\Admin\Resources\Tickets\Schemas;

use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Support\Facades\Storage;

class TicketInfolist
{
    public static function configure(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Section::make('Ticket Info')
                ->columns(3)
                ->schema([
                    TextEntry::make('title')
                        ->label('Ticket Title')
                        ->placeholder('-'),

                    TextEntry::make('status')
                        ->label('Status')
                        ->badge()
                        ->color(fn (string $state): string => match (strtolower($state)) {
                            'open' => 'gray',
                            'pending' => 'warning',
                            'in_progress' => 'info',
                            'resolved' => 'success',
                            'rejected' => 'danger',
                            default => 'secondary',
                        })
                        ->placeholder('Unknown'),

                    TextEntry::make('priority')
                        ->label('Priority')
                        ->badge()
                        ->color(fn (string $state): string => match (strtolower($state)) {
                            'low' => 'primary',
                            'medium' => 'warning',
                            'high' => 'danger',
                            'critical' => 'danger',
                            default => 'gray',
                        })
                        ->placeholder('Not Set'),

                    TextEntry::make('description')
                        ->label('Description')
                        ->placeholder('-')
                        ->columnSpanFull(), // <-- DIPERBAIKI: Agar deskripsi mengambil lebar penuh
                ]),

            Section::make('Attachments')
                // ->columns(3) // <-- DIHAPUS: Tidak perlu, biarkan ImageEntry mengatur gridnya sendiri
                ->schema([
                    ImageEntry::make('attachments')
                        ->label('Attachments') // <-- DIPERBAIKI: Diubah ke jamak
                        ->square()
                        ->size(150)
                        ->columnSpanFull() // <-- DIPERBAIKI: Agar galeri mengambil lebar penuh
                        ->getStateUsing(function ($record) {
                            // --- LOGIKA DIPERBAIKI ---
                            // Mengambil *semua* lampiran, bukan hanya yang pertama
                            $attachments = $record->attachments()->oldest()->get();

                            // Jika tidak ada lampiran, tampilkan gambar default
                            if ($attachments->isEmpty()) {
                                return [url('storage/default.jpg')];
                            }

                            // Ubah koleksi lampiran menjadi array URL
                            return $attachments->map(function ($attachment) {
                                return $attachment->file_path
                                    ? Storage::disk('public')->url($attachment->file_path)
                                    : null; // atau gambar placeholder lain jika satu file rusak
                            })
                            ->filter() // Hapus nilai null
                            ->all();
                            // --- AKHIR LOGIKA DIPERBAIKI ---
                        }),
                ]),
        ]);
    }
}
