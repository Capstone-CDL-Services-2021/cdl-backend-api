<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{

    public function up()
    {
        Schema::create('Projects', function (Blueprint $table) {
            $table->id();
            $table->string('Type_Of_Service') ;
            $table->string('Customer_Name');
            $table->string('Customer_Email') ;
            $table->string('Customer_Address');
            $table->date('Date_Requested') ;
            $table->string('Completed');
            $table->decimal('total_cost')->nullable();
            $table->date('date_completed')->nullable();
            $table->string('invoice_paid')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('Projects');
    }
}
