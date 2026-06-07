<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'dosen_id',
        'matkul_id',
        'rating',
        'ulasan',
        'tags',
        'upvotes',
        'is_anonim',
        'is_visible',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_anonim' => 'boolean',
        'is_visible' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    public function upvotedByUsers()
    {
        return $this->belongsToMany(User::class, 'review_upvotes');
    }

    public function isUpvotedBy(User $user): bool
    {
        return $this->upvotedByUsers()->where('user_id', $user->id)->exists();
    }
}