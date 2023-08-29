<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_role_id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->json('address')->nullable();
            $table->json('company')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_role_id')->references('id')->on('user_roles');

            $table->index('user_role_id');
            $table->fullText('username');
            $table->fullText('email');
            $table->fullText('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_user_role_id_foreign');
        });
        Schema::dropIfExists('users');
    }
};
