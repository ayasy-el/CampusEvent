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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('excerpt')->nullable();

            $table->string('organizer');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('benefits')->nullable();

            $table->jsonb('agenda')->nullable();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time')->nullable();

            $table->integer('quota')->default(0);
            $table->enum('location_type', ['offline', 'online', 'hybrid'])->default('hybrid');
            $table->string('location_address')->nullable();
            $table->integer('price')->default(0);

            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();

            $table->enum('status', ['draft', 'published', 'closed'])->default('published');
            $table->timestamps();
        });

        Schema::create('events_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unique(['event_id', 'user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('events_user');
    }
};
