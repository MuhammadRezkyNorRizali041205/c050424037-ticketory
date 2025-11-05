<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitLocation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location_id', // Ini adalah 'parent_id'
    ];

    /**
     * --- INI PERBAIKANNYA ---
     * * Mendapatkan data INDUK (parent) dari lokasi ini.
     * Ini adalah metode 'location()' yang dicari oleh Filament
     * (dari file UnitLocationForm.php) untuk mengisi dropdown.
     */
    public function location(): BelongsTo
    {
        // Relasi ke model UnitLocation itu sendiri,
        // menggunakan foreign key 'location_id'.
        return $this->belongsTo(UnitLocation::class, 'location_id');
    }

    /**
     * Mendapatkan semua data ANAK (children) dari lokasi ini.
     * (Ini opsional, tapi sangat berguna)
     */
    public function childLocations(): HasMany
    {
        // Relasi ke model UnitLocation itu sendiri,
        // menggunakan foreign key 'location_id'.
        return $this->hasMany(UnitLocation::class, 'location_id');
    }

    /**
     * (Opsional) Relasi ke semua Unit yang ada di lokasi ini.
     */
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class, 'unit_location_id');
    }
}

