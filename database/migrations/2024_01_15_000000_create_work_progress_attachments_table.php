<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_progress_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_progress_id')->constrained('work_progress')->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('mime_type');
            $table->bigInteger('file_size');
            $table->timestamps();

            $table->index('work_progress_id');
        });

        Schema::table('work_progress', function (Blueprint $table) {
            $table->dropColumn('attachment');
        });
    }

    public function down(): void
    {
        Schema::table('work_progress', function (Blueprint $table) {
            $table->string('attachment')->nullable();
        });

        Schema::dropIfExists('work_progress_attachments');
    }
};