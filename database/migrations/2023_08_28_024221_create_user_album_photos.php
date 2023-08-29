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
        Schema::create('user_album_photos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_album_id');
            $table->string('title');
            $table->text('full');
            $table->text('thumbnail');
            $table->boolean('external')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_album_id')->references('id')->on('user_albums');

            $table->index('user_album_id');
            $table->fullText('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_album_photos', function (Blueprint $table) {
            $table->dropForeign('user_album_photos_user_album_id_foreign');
        });
        Schema::dropIfExists('user_album_photos');
    }
};
