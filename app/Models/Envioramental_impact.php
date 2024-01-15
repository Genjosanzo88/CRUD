<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envioramental_impact extends Model
{
    use HasFactory;

    protected $table = 'envioramental_impact';
    protected $fillable = [
        'name'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
