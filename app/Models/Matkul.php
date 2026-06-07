<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'sks',
        'semester',
        'jurusan_id',
        'avg_rating',
        'total_review',
    ];

    protected $casts = [
        'avg_rating' => 'float',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function updateRating(): void
    {
        $this->avg_rating = $this->reviews()->avg('rating') ?? 0;
        $this->total_review = $this->reviews()->count();
        $this->save();
    }
}