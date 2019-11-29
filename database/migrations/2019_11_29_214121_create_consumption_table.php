<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_consumption', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('model_id');
            $table->integer('part_id');
            $table->unique(['model_id', 'part_id']);
            $table->double('sqft', 8, 2);
            $table->double('sqm', 8, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumption');
    }
}
