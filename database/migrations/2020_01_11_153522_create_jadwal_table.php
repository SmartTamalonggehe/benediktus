<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('prodi_id');
            $table->unsignedBigInteger('matkul_id');
            $table->unsignedBigInteger('ruang_id');
            $table->unsignedBigInteger('dosen_id');
            $table->string('hari',10);
            $table->time('jam_mulai');
            $table->time('jam_seles');
            $table->string('semester_ak',7);
            $table->year('tahun_ak');
            $table->timestamps();

            $table->foreign('prodi_id')->references('id')->on('prodi')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            $table->foreign('matkul_id')->references('id')->on('matkul')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            $table->foreign('ruang_id')->references('id')->on('ruang')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            $table->foreign('dosen_id')->references('id')->on('dosen')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
}
