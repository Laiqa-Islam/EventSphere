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
        Schema::table('announcements', function (Blueprint $table) {
        $table->dropForeign(['event_id']);
        $table->dropForeign(['organizer_id']);

        $table->foreignId('event_id')->nullable()->change();
        $table->foreignId('organizer_id')->nullable()->change();

        $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('cascade');
        $table->string('target_role')->nullable(); // e.g., "student", "organizer", "all"
        $table->json('target_users')->nullable(); // specific user IDs
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            //
        });
    }
};
