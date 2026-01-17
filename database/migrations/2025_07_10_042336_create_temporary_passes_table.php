<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryPassesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('temporary_passes', function (Blueprint $table) {
            $table->id(); // Primary key

            $table->string('visitor_name');
            $table->string('visitor_email')->nullable();
            $table->string('visitor_phone')->nullable();
            $table->text('purpose');

            // Foreign key to locations table
            // $table->unsignedBigInteger('location_id');
            // $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

            // Foreign key to users table (issued_by)
            // $table->unsignedBigInteger('issued_by');
            // $table->foreign('issued_by')->references('id')->on('users')->onDelete('cascade');

            $table->dateTime('valid_from');
            $table->dateTime('valid_until');

             $table->string('qr_code_path')->nullable();
  $table->string('password');
    $table->string('profile_image')->nullable();
            // $table->enum('status', ['pending', 'approved', 'used', 'expired'])->default('pending');

            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_passes');
    }
}
