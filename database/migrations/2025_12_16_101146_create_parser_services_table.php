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
        Schema::create('parser_services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('base_url', 500);
            $table->boolean('is_active')->default(true)->index();

            $table->boolean('is_available')->default(false)->index();
            $table->string('current_state', 30)->default('unknown')->index();

            $table->boolean('http_enabled')->nullable();
            $table->boolean('ymq_enabled')->nullable();

            $table->timestamp('last_ping_at')->nullable()->index();
            $table->text('last_ping_error')->nullable();

            $table->timestamp('last_state_at')->nullable()->index();
            $table->uuid('last_job_id')->nullable()->index();
            $table->string('last_task_type', 30)->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parser_services');
    }
};
