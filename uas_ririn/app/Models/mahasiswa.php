<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\MahasiswaController;

class mahasiswa extends Model
{
    
    use HasFactory;
    protected $table = 'mahasiswa_tabel';
    protected $fillable =  [
        'npm',
        'nama', 
        'prodi'];
}
