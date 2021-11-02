<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
 use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
 use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Model
{
    protected $table="mahasiswa"; // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswas
    public $timestamps= false; 
    protected  $primaryKey = 'Nim'; // Memanggil isi DB Dengan primarykey
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nim',
        'Nama',
        'kelas_id',
        'Jurusan',
    ];
    public function kelas(){
        return $this->belongsTo(Kelas::class);

    }
}
