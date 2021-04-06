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
            $table->string('name') ;
            $table->string('owned');
            $table->integer('cost')->nullable();
            $table->string('date_rented')->nullable();
            $table->string('date_returned')->nullable();
            $table->string('rented_from')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('Equipment');
    }
}
