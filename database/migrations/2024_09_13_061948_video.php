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
        //
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('video_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            // $table->timestamp('waktu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign('videos_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
