<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circular extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'text'
    ];

    public function getTextModAttribute()
    {
        $text = $this->text;

        preg_match_all('/(?<=src=")([^"]+)/', $text, $images);

        foreach ($images[0] as $image)
        {
            $imageName = explode("/", $image);
            if (count($imageName) == 2) {
                $imageName = $imageName[1];
                $text = str_replace($image, route('user.circular.file', $imageName), $text);
            }
        }

        return $text;
    }

    public function recipients()
    {
        return $this->belongsToMany(User::class);
    }

    public function archives()
    {
        return $this->hasMany(CircularArchive::class);
    }

}
