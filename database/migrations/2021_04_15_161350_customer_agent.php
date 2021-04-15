<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerAgent extends Migration
{
    public function up()
    {
        Schema::create('agent_has_customers', function (Blueprint $table) {
            $table->bigInteger('agent_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('agent_id')
                  ->references('id')
                  ->on('users');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('agent_has_customers');
    }
}
