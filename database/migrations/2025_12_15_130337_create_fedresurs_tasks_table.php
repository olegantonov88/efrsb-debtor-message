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
        Schema::create('fedresurs_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parse_job_id')->nullable()->index();
            $table->uuid('job_id')->unique();
            $table->string('task_type', 50)->index();
            $table->json('payload');
            $table->string('status', 30)->default('created')->index();
            $table->unsignedInteger('attempts')->default(0);
            $table->timestamp('reserved_at')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fedresurs_tasks');
    }
};
