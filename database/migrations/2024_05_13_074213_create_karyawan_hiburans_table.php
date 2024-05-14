<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanHiburansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_hiburans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idKaryawan')->constrained('karyawans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('idHiburan')->constrained('hiburans')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('karyawan_hiburans');
    }
}
