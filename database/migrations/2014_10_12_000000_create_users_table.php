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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id')->require();
            $table->string('supervisor_id')->nullable();
            $table->string('name')->require();
            $table->string('email')->unique();
            $table->string('role')->default('staff');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->longblob('photo')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->require();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
