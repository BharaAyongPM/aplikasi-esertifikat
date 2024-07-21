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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');  // Asumsi Anda sudah memiliki tabel users
            $table->string('name');
            $table->string('certificate_number')->unique();  // Nomor sertifikat dengan asumsi setiap nomor unik
            $table->string('file');  // Path ke file sertifikat yang disimpan
            $table->string('phone_number');
            $table->string('qrcode')->nullable(); // Nomor telepon
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
        Schema::dropIfExists('certificates');
    }
};
