<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matkul extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'sks',
        'semester',
        'jurusan_id',
        'dosen_id', // Tambahkan ini agar bisa terhubung ke dosen
        'avg_rating',
        'total_review',
    ];

    protected $casts = [
        'avg_rating' => 'float',
    ];

    /**
     * Relasi ke Jurusan
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Relasi ke Dosen (Mata kuliah diampu oleh dosen)
     */
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }

    /**
     * Relasi ke Review
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Update rating dan jumlah review secara otomatis
     */
    public function updateRating(): void
    {
        $this->avg_rating = $this->reviews()->avg('rating') ?? 0;
        $this->total_review = $this->reviews()->count();
        $this->save();
    }
}