<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LevelAkses extends Model
{
    use HasUuids;
    protected $table = 'level_akses';

    protected $fillable = [
        'name',
    ];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
