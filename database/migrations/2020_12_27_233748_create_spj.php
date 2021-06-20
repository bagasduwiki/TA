<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spj', function (Blueprint $table) {
            $table->id();
            $table->string('id_agenda')->nullable();
            $table->integer('anggaran');
            $table->string('foto_kegiatan')->nullable();
            $table->string('foto_nota')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj');
    }
}
