<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasUuids;
    protected $table = 'pegawais';

    protected $fillable = [
        'name',
        'email',
        'division_id',
        'level_akses_id',
    ];

    public function levelAkses()
    {
        return $this->belongsTo(LevelAkses::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function validationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawais,email',
            'division_id' => 'required|exists:divisions,id',
            'level_akses_id' => 'required|exists:level_akses,id',
        ];
    }
    
    public function validationMessages()
    {
        return [
            'name.required' => 'Nama pegawai harus diisi.',
            'email.required' => 'Email pegawai harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'division.required' => 'Divisi pegawai harus diisi.',
            'division.exists' => 'Divisi tidak valid.',
            'level_akses.required' => 'Level akses pegawai harus diisi.',
            'level_akses.exists' => 'Level akses tidak valid.',
        ];
    }

    public function validationEditRules($id)
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawais,email,' . $id . ',id',
            'division_id' => 'required|exists:divisions,id',
        ];
    }
    
}
