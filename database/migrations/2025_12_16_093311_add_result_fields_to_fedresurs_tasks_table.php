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
            $table->boolean('ok')->nullable()->index();
            $table->string('callback_task_type', 30)->nullable()->index();
            $table->unsignedBigInteger('callback_debtor_id')->nullable()->index();
            $table->string('start_ip', 45)->nullable();
            $table->string('end_ip', 45)->nullable();
            $table->text('callback_error')->nullable();
            $table->json('stats')->nullable();
            $table->timestamp('finished_at')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fedresurs_tasks', function (Blueprint $table) {
            $table->dropColumn([
                'ok',
                'callback_task_type',
                'callback_debtor_id',
                'start_ip',
                'end_ip',
                'callback_error',
                'stats',
                'finished_at',
            ]);
        });
    }
};
