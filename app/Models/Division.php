<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasUuids;
    protected $table = 'divisions';
    protected $fillable = [
        'name',
    ];
    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
