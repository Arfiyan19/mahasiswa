<?php

use App\Models\Mahasiswa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelasiKelasMahasiswaTable extends Migration
{
    
    public function up()
    {
        Schema::table('mahasiswa',function(Blueprint $table){
            $table-> dropColumn('kelas'); //menghapus kolom kelas_id
            $table-> unsignedBigInteger('kelas_id')->nullable(); //menambahkan kolom kelas_id
            $table-> foreign('kelas_id')->references('id')->on('kelas'); //menambahkan foreign key kelas_id

        });
    }

    public function down()
    {
         Schema::table('mahasiswa',function(Blueprint $table) {
            $table-> string('kelas'); //
            $table-> dropForeign(['kelas_id']);
        });
    }
}
