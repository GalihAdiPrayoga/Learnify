<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'nama',
        'thumnail',
    ];

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'kelas_user')
            ->withPivot(['completed_materials', 'progress', 'status', 'completed_at'])
            ->withTimestamps();
    }

    public function sertifikats()
    {
        return $this->hasMany(Sertifikat::class);
    }
}
