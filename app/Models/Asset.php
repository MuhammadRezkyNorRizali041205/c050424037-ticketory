<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'category_id',
        'unit_id',
        'vendor_id',
        'status',
        'purchase_date',
        'purchase_price',
        'warranty_expiry',
    ];

    protected static function booted()
    {
        static::creating(function ($asset) {
            if (empty($asset->code)) {
                $month = now()->format('m');
                $year = now()->format('y');

                $lastCode = self::whereYear('created_at', '20' . $year) // karena format tahun 2 digit
                    ->whereMonth('created_at', $month)
                    ->orderByDesc('id')
                    ->value('code');

                if ($lastCode) {
                    $parts = explode('/', $lastCode);
                    $lastNumber = isset($parts[3]) ? (int) $parts[3] : 0;
                    $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $newNumber = '0001';
                }

                $asset->code = "INV/{$year}/{$month}/{$newNumber}";
            }
        });
    }

    /**
     * Relasi ke kategori aset.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke unit atau lokasi penyimpanan aset.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Relasi ke vendor atau pemasok aset.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
