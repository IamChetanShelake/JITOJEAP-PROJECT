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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            
            // Foreign key relationship
            $table->uuid('submission_id');
            $table->foreign('submission_id')->references('submission_id')->on('financial_assistance')->onDelete('cascade');
            
            // Document details
            $table->string('document_type');
            $table->string('file_path');
            $table->timestamp('uploaded_at')->nullable();
            
            // Form metadata
            $table->enum('form_status', ['draft', 'completed', 'submitted'])->default('draft');
            
            $table->timestamps();
            
            // Indexes
            $table->index('submission_id');
            $table->index('form_status');
            $table->index('document_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};