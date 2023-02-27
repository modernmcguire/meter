<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laravel_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('metric');
            $table->text('value');
            $table->timestamp('metric_date')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(['metric', 'metric_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laravel_metrics');
    }
};
