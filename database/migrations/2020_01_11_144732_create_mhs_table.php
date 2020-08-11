<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mhs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NPM',15)->unique();
            $table->unsignedBigInteger('prodi_id');
            $table->string('nm_mhs',100);
            $table->string('password',30);
            $table->string('jenkel',11);
            $table->year('angkatan');
            $table->text('alamat');
            $table->timestamps();

            $table->foreign('prodi_id')->references('id')->on('prodi')
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
        Schema::dropIfExists('mhs');
    }
}
