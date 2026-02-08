<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $fillable = [
        'user_id',
        'kelas_id',
        'nomor_sertifikat',
        'tanggal_terbit',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_terbit' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
