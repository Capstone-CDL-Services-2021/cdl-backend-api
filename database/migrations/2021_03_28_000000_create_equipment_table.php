<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{

    public function up()
    {
        Schema::create('Equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('cost');
            $table->string('date rented');
            $table->string('date returned');
            $table->string('rented from');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('Equipment');
    }
}
