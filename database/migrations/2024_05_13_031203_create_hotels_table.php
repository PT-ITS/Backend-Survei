<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('namaHotel');
            $table->string('bintangHotel');
            $table->string('kamarVip');
            $table->string('kamarStandart');
            $table->string('alamat');
            $table->string('koordinat');
            $table->string('namaPj');
            $table->string('nikPj');
            $table->string('pendidikanPj');
            $table->string('teleponPj');
            $table->string('wargaNegaraPj');
            $table->foreignId('surveyor_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('hotels');
    }
}
