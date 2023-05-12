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
        Schema::create('seo_templates', function (Blueprint $table): void {
            $table->id();
            $table->string('group')->unique();

            $table->timestamps();
        });
        Schema::create('seo_template_translations', function (Blueprint $table): void {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('seo_template_id');

            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->text('image_alt')->nullable();
            $table->text('image_title')->nullable();

            $table->unique(['locale', 'seo_template_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_template_translations');
        Schema::dropIfExists('seo_templates');
    }
};
