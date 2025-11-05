<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model
{
    use HasFactory;

    /**
     * Nama tabel (opsional, tapi baik ditulis agar eksplisit)
     *
     * @var string
     */
    protected $table = 'units';

    /**
     * Kolom yang dapat diisi secara mass-assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'unit_location_id',
    ];

    /**
     * Relasi ke model UnitLocation.
     * Ini digunakan di Filament ->relationship('unitLocation', 'name')
     */
    public function unitLocation(): BelongsTo
    {
        return $this->belongsTo(UnitLocation::class, 'unit_location_id');
    }

    /**
     * Optional: accessor agar nama lokasi unit bisa langsung dipanggil dari model.
     * Misal: $unit->location_name
     */
    public function getLocationNameAttribute(): ?string
    {
        return $this->unitLocation?->name;
    }
}
