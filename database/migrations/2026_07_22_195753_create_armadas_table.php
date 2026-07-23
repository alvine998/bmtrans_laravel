<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('armadas', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. Pickup Bak, Tronton Wingbox
            $table->string('type')->nullable(); // grouping: pickup, colt_diesel, fusso, tronton
            $table->unsignedBigInteger('price_start')->default(0); // in rupiah, e.g. 200000
            $table->string('price_label')->nullable(); // display label e.g. "200rb", "1,2jt", overrides auto-format if filled
            $table->string('price_note')->nullable()->default('Mulai dari'); // e.g. Mulai dari, Start from
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index('order');
            $table->index('is_active');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('armadas');
    }
};
