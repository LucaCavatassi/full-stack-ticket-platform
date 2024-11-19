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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->date('date'); // Date column
            $table->unsignedBigInteger('status_id'); // Foreign key for status
            $table->string('title'); // Title (varchar)
            $table->text('description'); // Description (use text for potentially longer content)
            $table->unsignedBigInteger('agent_id'); // Foreign key for agent
            $table->unsignedBigInteger('category_id'); // Foreign key for category
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
