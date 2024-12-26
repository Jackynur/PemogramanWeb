<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    protected $fillable = [
        'nama', 
        'berat', 
        'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    
    public function getBeratFormattedAttribute()
    {
    return number_format($this->berat, 2) . ' kg';
    }


}

