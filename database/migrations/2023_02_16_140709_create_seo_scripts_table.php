<?php

declare(strict_types=1);

use Hexide\Seo\Models\SeoScript;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_scripts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default(SeoScript::TYPE_HEAD);
            $table->longText('text');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_scripts');
    }
};
