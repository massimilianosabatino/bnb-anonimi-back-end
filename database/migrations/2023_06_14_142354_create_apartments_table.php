<?php

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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->unsignedTinyInteger('rooms')->default(1);
            $table->unsignedTinyInteger('bathrooms')->default(1);
            $table->unsignedTinyInteger('beds')->default(1);
            $table->unsignedSmallInteger('square_meters')->default(1);
            $table->text('cover_image');
            $table->string('address');
            $table->float('latitude',8,5);
            $table->float('longitude',8,5);
            $table->boolean('visible')->default(1);
            $table->decimal('price',6,2)->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('apartments');
    }
};
