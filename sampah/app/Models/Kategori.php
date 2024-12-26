<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'nama_kategori'
    ];

    public function sampahs()
    {
        return $this->hasMany(Sampah::class);
    }
}
