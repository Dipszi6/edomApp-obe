<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'fakultas',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function dosens()
    {
        return $this->hasMany(Dosen::class);
    }

    public function matkuls()
    {
        return $this->hasMany(Matkul::class);
    }
}