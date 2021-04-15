<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('first_name', 50);
            $table->string('last_name', 50)->nullable();

            $table->string('email_address')->nullable();
            $table->string('phone_number', 20)->nullable();

            $table->bigInteger('created_by');
            $table->timestamps();
            $table->bigInteger('updated_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
