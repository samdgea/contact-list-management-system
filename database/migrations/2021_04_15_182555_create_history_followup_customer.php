<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryFollowupCustomer extends Migration
{
    public function up()
    {
        Schema::create('history_followup', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id');
            $table->enum('old_status', [
                'uncontacted',
                'pending',
                'qualified',
                'lost'
            ]);
            $table->enum('new_status', [
                'uncontacted',
                'pending',
                'qualified',
                'lost'
            ]);
            $table->text('remarks');
            $table->bigInteger('modified_by');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('history_followup');
    }
}
