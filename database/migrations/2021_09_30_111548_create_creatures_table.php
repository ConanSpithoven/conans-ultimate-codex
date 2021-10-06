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
            $table->integer('user_id')->default(0);
            $table->string('status')->default("review");
            $table->string('name')->default("");
            $table->string('size')->default("");
            $table->string('type')->default("");
            $table->string('alignment')->default("");
            $table->string('armor_class')->default("0");
            $table->string('hit_points')->default("0");
            $table->string('speed')->default("0ft");
            $table->string('stats')->default("");
            $table->string('saving_throws')->default("");
            $table->string('skills')->default("");
            $table->string('spells')->default("");
            $table->string('abilities')->default("");
            $table->string('actions')->default("");
            $table->string('reactions')->default("");
            $table->string('legendary_actions')->default("");
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
