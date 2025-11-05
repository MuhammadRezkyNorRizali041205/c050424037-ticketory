<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Vendor extends Model
{
    //
    use HasFactory;
    protected $fillable = ['name', 'address', 'phone', 'email', 'website', 'contact_person', 'notes'];

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
