<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFnBSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fn_b_s', function (Blueprint $table) {
            $table->id();
            $table->string('nib');
            $table->string('namaFnb');
            $table->string('resiko');
            $table->string('skalaUsaha');
            $table->text('alamat');
            $table->string('koordinat');
            $table->string('namaPj');
            $table->string('emailPj');
            $table->string('passwordPj');
            $table->string('nikPj');
            $table->string('pendidikanPj');
            $table->string('teleponPj');
            $table->string('wargaNegaraPj');
            $table->foreignId('surveyor_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pj_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('fn_b_s');
    }
}
