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
        Schema::table('fedresurs_tasks', function (Blueprint $table) {
            $table->string('ymq_message_id', 200)->nullable()->index();
            $table->timestamp('sent_at')->nullable()->index();
            $table->text('last_error')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fedresurs_tasks', function (Blueprint $table) {
            $table->dropColumn(['ymq_message_id', 'sent_at', 'last_error']);
        });
    }
};
