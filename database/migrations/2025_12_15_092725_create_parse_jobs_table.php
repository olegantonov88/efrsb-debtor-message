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
        Schema::create('parse_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('debtor_id')->index();
            $table->string('type', 50)->index();
            $table->unsignedTinyInteger('latest_status')->nullable()->index();
            $table->json('statuses')->nullable();
            $table->json('payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parse_jobs');
    }
};
