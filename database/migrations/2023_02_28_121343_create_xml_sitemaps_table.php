<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('xml_sitemaps', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->index();
            $table->string('name');
            $table->string('generator');
            $table->string('changefreq')->nullable();
            $table->float('priority')->nullable();
            $table->string('frequency');
            $table->string('path');
            $table->dateTime('generated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xml_sitemaps');
    }
};
