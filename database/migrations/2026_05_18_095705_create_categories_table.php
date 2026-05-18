<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 120)->unique();
            $table->string('color', 7)->default('#6366f1'); // hex color for UI
            $table->text('description')->nullable();
            $table->foreignId('created_by')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            $table->index('slug');
            $table->index('created_by');
           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};