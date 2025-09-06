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
        Schema::table('financial_assistance', function (Blueprint $table) {
            $table->uuid('submission_id')->nullable()->after('id');
            $table->integer('current_step')->default(1)->after('submission_id');
            $table->json('form_data')->nullable()->after('current_step');

            // Add index for better performance
            $table->index('submission_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financial_assistance', function (Blueprint $table) {
            $table->dropIndex(['submission_id']);
            $table->dropColumn(['submission_id', 'current_step', 'form_data']);
        });
    }
};
