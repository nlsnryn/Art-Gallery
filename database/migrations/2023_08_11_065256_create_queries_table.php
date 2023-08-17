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
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artwork_id')->constrained()->onDelete('cascade');
            $table->string('client_name', 50);
            $table->string('client_email', 50);
            $table->string('contact_number', 15);
            $table->string('location', 50);
            $table->text('message');
            $table->string('status', 50)->default('pending');
            $table->foreignId('status_changed_by_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamp('status_changed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queries');
    }
};
