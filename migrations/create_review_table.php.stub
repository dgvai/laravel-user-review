<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration
{
    public function up()
    {
        Schema::create('model_reviews',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('model_id');
            $table->string('model_type');
            $table->bigInteger('user_id');
            $table->text('review')->nullable();
            $table->integer('rating');
            $table->text('reply')->nullable();
            $table->integer('active')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('model_reviews');
    }
}