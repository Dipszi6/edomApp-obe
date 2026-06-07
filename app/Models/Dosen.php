<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = [
        'user_id',
        'nidn',
        'nama',
        'gelar',
        'jurusan_id',
        'foto',
        'avg_rating',
        'total_review',
    ];

    protected $casts = [
        'avg_rating' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getNamaLengkapAttribute(): string
    {
        return $this->gelar
            ? $this->nama . ', ' . $this->gelar
            : $this->nama;
    }

    public function updateRating(): void
    {
        $this->avg_rating = $this->reviews()->avg('rating') ?? 0;
        $this->total_review = $this->reviews()->count();
        $this->save();
    }
}