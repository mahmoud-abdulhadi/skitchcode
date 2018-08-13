<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkitchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skitches', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title')->default('untitled');
            $table->text('description')->nullable();
            $table->json('code');
            $table->unsignedInteger('views')->default(0);
            $table->integer('user_id')->unsigned();
            $table->boolean('is_forked')->default(0);
            $table->unsignedInteger('forkable_id')->nullable();
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
        Schema::dropIfExists('skitches');
    }
}
