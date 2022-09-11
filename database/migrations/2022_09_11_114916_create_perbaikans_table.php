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
        Schema::create('perbaikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ruangan_id');
            $table->unsignedBigInteger('keluhan_id');
            $table->integer('total_perbaikan')->nullable();
            $table->integer('reward')->nullable();
            $table->enum('response', ['0', '1'])->default('0');
            $table->timestamps();

            //relasi user
            $table->foreign('user_id')->references('id')->on('users');
            //relasi table ruangan
            $table->foreign('ruangan_id')->references('id')->on('ruangans');
            //relasi keluhan
            $table->foreign('keluhan_id')->references('id')->on('keluhans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perbaikans');
    }
};
