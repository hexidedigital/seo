<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seo_template_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seo_template_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('model_name')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_template_models');
    }
};
