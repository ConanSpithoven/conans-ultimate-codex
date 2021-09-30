<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creatures', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('status');
            $table->string('name');
            $table->string('size');
            $table->string('type');
            $table->string('alignment');
            $table->string('armor_class');
            $table->string('hit_points');
            $table->string('speed');
            $table->string('stats');
            $table->string('saving_throws');
            $table->string('skills');
            $table->string('Abilities');
            $table->string('actions');
            $table->string('reactions');
            $table->string('legendary_actions');
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
        Schema::dropIfExists('creatures');
    }
}
