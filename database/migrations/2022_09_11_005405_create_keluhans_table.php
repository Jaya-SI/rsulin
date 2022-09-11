<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluhans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_ruangan');
            $table->unsignedBigInteger('id_user');
            $table->string('tanggal');
            $table->string('judul_kendala');
            $table->text('kendala');
            $table->string('image');
            $table->enum('done', ['0', '1'])->default('0');

            $table->timestamps();

            //relasi id ruangan ke table ruangan
            $table->foreign('id_ruangan')->references('id')->on('ruangans');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keluhans');
    }
};
