<?php

declare(strict_types=1);

use Hexide\Seo\Models\GeneralMeta;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('general_metas', function (Blueprint $table): void {
            $table->id();
            $table->timestamps();
        });
        Schema::create('general_meta_translations', function (Blueprint $table): void {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('general_meta_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();

            $table->unique(['locale', 'general_meta_id']);
        });

        GeneralMeta::create([]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_meta_translations');
        Schema::dropIfExists('general_metas');
    }
};
