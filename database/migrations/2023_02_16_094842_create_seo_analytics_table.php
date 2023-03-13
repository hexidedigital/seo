<?php

use Hexide\Seo\Models\SeoAnalytic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_analytics', function (Blueprint $table) {
            $table->id();
            $table->string('gtm_id')->nullable();
            $table->string('ga_tracking_id')->nullable();
            $table->string('fb_pixel_id')->nullable();
            $table->string('hjar_id')->nullable();
            $table->timestamps();
        });

        SeoAnalytic::create([]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_analytics');
    }
};
