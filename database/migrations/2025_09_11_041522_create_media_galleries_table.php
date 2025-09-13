<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media_gallery', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->enum('file_type', ['image', 'video']);
            $table->string('file_url', 255);
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->string('caption', 150)->nullable();
            $table->timestamp('uploaded_on')->useCurrent();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_galleries');
    }
};
