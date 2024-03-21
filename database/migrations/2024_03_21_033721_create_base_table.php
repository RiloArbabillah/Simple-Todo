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
        Schema::create('klien', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('telp')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        Schema::create('project', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('klien_id')->index();
            $table->string('nama')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamp('due_at')->nullable();
            $table->timestamp('done_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
        Schema::dropIfExists('project');
    }
};
