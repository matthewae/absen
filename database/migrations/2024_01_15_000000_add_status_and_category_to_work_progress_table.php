<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('work_progress', function (Blueprint $table) {
            $table->enum('category', ['Perencanaan', 'Pengawasan', 'Kajian'])->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('work_progress', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};