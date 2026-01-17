<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id(); // Primary key (id)
            $table->string('name'); // e.g., Library, Canteen, Room 101
            $table->enum('type', ['classroom', 'office', 'facility', 'canteen', 'library', 'other'])->default('other');
 // location type
            $table->text('description')->nullable(); // optional description
            $table->string('access_level_required')->nullable(); // optional field
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
}
