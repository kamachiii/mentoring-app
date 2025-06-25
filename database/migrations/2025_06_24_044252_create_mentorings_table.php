<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentoringsTable extends Migration
{
    public function up()
    {
        Schema::create('mentorings', function (Blueprint $table) {
            $table->id();
            $table->string('tema_mentoring');
            $table->date('tanggal');
            $table->string('tempat');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('nama_mentor');
            $table->string('nomor'); // bisa untuk nomor HP
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mentorings');
    }
}
