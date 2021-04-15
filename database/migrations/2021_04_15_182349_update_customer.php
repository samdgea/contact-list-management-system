<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCustomer extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->enum('status', [
                'uncontacted',
                'pending',
                'qualified',
                'lost'
            ])->default('uncontacted');
            $table->text('remarks');
        });

    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('remarks');
        });
    }
}
