<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->string('thn_lulus');
            $table->enum('sts_karir', ['Bekerja', 'Belum', 'Kuliah']);
            $table->string('telp');
            $table->string('universitas')->nullable();
            $table->string('penghasilan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('avatar')->default('default.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
