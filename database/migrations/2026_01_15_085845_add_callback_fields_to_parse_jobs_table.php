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
        Schema::table('parse_jobs', function (Blueprint $table) {
            $table->string('callback_url')->nullable()->after('payload');
            $table->unsignedBigInteger('meeting_application_id')->nullable()->index()->after('callback_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parse_jobs', function (Blueprint $table) {
            $table->dropIndex(['meeting_application_id']);
            $table->dropColumn(['callback_url', 'meeting_application_id']);
        });
    }
};
