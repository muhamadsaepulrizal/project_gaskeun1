<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilAgen extends Model
{
    protected $fillable = ['user_id', 'nama_agen', 'no_registrasi', 'alamat', 'kontak'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
