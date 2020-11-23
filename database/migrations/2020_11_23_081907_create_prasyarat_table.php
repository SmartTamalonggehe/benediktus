<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrasyaratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prasyarat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('syarat_id');
            $table->unsignedBigInteger('matkul_id');
            $table->timestamps();

            $table->foreign('syarat')->references('id')->on('matkul')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            $table->foreign('matkul_id')->references('id')->on('matkul')
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
        Schema::dropIfExists('prasyarat');
    }
}
