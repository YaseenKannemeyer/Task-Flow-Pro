<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();

            // Status: enum for data integrity
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])
                  ->default('pending');

            // Priority: enum
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])
                  ->default('medium');

            // Foreign keys
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('categories')
                  ->onDelete('set null');

            $table->foreignId('created_by')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('assigned_to')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            // Dates
            $table->date('due_date')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            // Flags
            $table->boolean('reminder_sent')->default(false);
            $table->boolean('is_archived')->default(false);

            $table->timestamps();
            $table->softDeletes();

            // Indexes for frequent queries
            $table->index('status');
            $table->index('priority');
            $table->index('due_date');
            $table->index('assigned_to');
            $table->index('created_by');
            $table->index(['status', 'priority']);
            $table->index(['assigned_to', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
