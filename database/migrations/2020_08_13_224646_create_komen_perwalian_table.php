<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomenPerwalianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komen_perwalian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perwalian_id');
            $table->text('id_pengkomen');
            $table->text('pesan');
            $table->string('status',5);
            $table->timestamps();

            $table->foreign('perwalian_id')->references('id')->on('perwalian')
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
        Schema::dropIfExists('komen_perwalian');
    }
}
