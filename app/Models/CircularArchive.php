<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CircularArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'archive'
    ];

    public function circular()
    {
        return $this->belongsTo(Circular::class);
    }

}
