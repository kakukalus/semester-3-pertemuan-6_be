<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = [
        'nama',
        'nim',
        'email',
        'jurusan',
        'no_telepon',
        'umur',
        'is_active',
    ];
}
