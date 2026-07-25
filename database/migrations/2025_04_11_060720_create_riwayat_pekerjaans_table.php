<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPekerjaansTable extends Migration
{
    public function up()
    {
    

    Schema::create('riwayat_pekerjaan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('pangkat');
        $table->string('jabatan');
        $table->string('unit_kerja');
        $table->string('sub_bagian')->nullable();
        $table->string('nip');
        $table->string('nomor_sk');
        $table->date('tanggal_sk');
        $table->date('tmt_sk');
        $table->string('mutasi')->nullable();
        $table->string('file_sk')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });

    }

    public function down()
    {
        Schema::dropIfExists('riwayat_pekerjaans');
    }
}
