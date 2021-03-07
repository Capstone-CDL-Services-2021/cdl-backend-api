<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCardsTable extends Migration
{

    public function up()
    {
        Schema::create('ServiceCards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('imageUrl');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::drop('ServiceCards');
    }
}
