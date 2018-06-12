<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('skills', function(Blueprint $table) {

        $table->increments('id');
        $table->string('name');
        $table->string('url')->nullable();
        $table->integer('skill_category_id')->unsigned();
        $table->foreign('skill_category_id')->references('id')->on('skill_categories');
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
        Schema::dropIfExists('skills');
    }
}
