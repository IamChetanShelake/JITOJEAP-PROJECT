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
            $table->string('signature_type')->nullable();
            $table->string('signature_image_path')->nullable();
            $table->text('signature_drawn_data')->nullable();  // Changed from string to text
            $table->string('signature_typed_name')->nullable();
            $table->timestamp('signature_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financial_assistance', function (Blueprint $table) {
            $table->dropColumn(['signature_type', 'signature_image_path', 'signature_drawn_data', 'signature_typed_name', 'signature_date']);
        });
    }
};