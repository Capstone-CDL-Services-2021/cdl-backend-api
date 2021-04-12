<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{

    public function up()
    {
        Schema::create('Testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('testimonial');
            $table->integer('rating');
            $table->string('name');
            $table->tinyInteger('toggle')->default('0')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('Testimonials');
    }
}
