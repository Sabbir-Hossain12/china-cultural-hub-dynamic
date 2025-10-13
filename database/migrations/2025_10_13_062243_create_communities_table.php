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
        Schema::create('communities', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->string('slug');
            $table->longText('content_1');
            $table->text('image_1');

            $table->longText('content_2');
            $table->text('image_2');

            $table->longText('content_3');
            $table->text('image_3');

            $table->longText('long_desc');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communities');
    }
};
