<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pendidikans', function (Blueprint $table) {
            $table->string('institusi')->nullable();
            $table->enum('lulusan', ['Dalam Negeri', 'Luar Negeri'])->nullable();
            $table->string('gelar')->nullable();
            $table->string('bidang_ilmu')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('alamat_institusi')->nullable();
            $table->string('no_ijazah')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_lulus')->nullable();
            $table->string('file_pendamping')->nullable();
            $table->string('transkrip')->nullable();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendidikans', function (Blueprint $table) {
            //
        });
    }
};
