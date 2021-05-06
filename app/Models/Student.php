<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;

    // Data di database tidak terhapus akan tetapi user tidak bisa melihat data yang telah dihapus.
    use SoftDeletes;

    // Field yang boleh diisi sisanya otomatis
    protected $fillable = ['nama', 'nim', 'email', 'jurusan'];
}
