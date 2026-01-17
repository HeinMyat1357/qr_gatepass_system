<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatePassLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gate_pass_logs', function (Blueprint $table) {
            $table->id(); // Primary key

            // For permanent user (nullable)
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            // For guest/visitor (nullable)
            $table->unsignedBigInteger('temporary_pass_id')->nullable();
            $table->foreign('temporary_pass_id')->references('id')->on('temporary_passes')->onDelete('set null');
 $table->unsignedBigInteger('user_type_id')->nullable();
            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('set null');
            // Accessed location
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

            //Entry or Exit
            $table->enum('scan_type', ['entry', 'exit']);

            // // Who scanned it (guard/moderator)
            // $table->unsignedBigInteger('scanned_by');
            // $table->foreign('scanned_by')->references('id')->on('users')->onDelete('cascade');

            $table->dateTime('scanned_at'); // Timestamp of scan

            // $table->string('device_info')->nullable(); // Optional device information (scanner, IP, etc.)

            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gate_pass_logs');
    }
}
