<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawaban extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('id_tes');
            $table->string('jawaban1');
            $table->string('jawaban2');
            $table->string('jawaban3');
            $table->string('jawaban4');
            $table->string('jawaban5');
            $table->string('jawaban6');
            $table->string('jawaban7');
            $table->string('jawaban8');
            $table->string('jawaban9');
            $table->string('jawaban10');
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
        Schema::dropIfExists('jawaban');
    }
}
