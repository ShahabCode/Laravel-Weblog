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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->integer('views')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_published')->default(false);

            // کلید خارجی
            $table->foreign('user_id')->references('id') -> on('users')->onDelete('cascade');
            // indexes

            $table->index('slug');
            $table->index('is_published');
            $table->index('published_at');
            $table->index('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
