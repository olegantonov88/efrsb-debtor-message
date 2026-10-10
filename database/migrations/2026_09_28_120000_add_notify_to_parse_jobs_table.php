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
            // false - тихий запуск из CRM: странице событие отправляем, всплывающее уведомление нет
            $table->boolean('notify')->default(true)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parse_jobs', function (Blueprint $table) {
            $table->dropColumn('notify');
        });
    }
};
