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
        Schema::create('surat', function (Blueprint $table) {
            $table->bigIncrements('no_surat');
            $table->unsignedBigInteger('id_po');
            $table->string('pengirim', 255);
            $table->string('penerima', 255);
            $table->string('status', 255);

            $table->foreign('id_po')->references('id_po')->on('purchasing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat');
    }
};
