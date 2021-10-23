<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['TO_DEPOSIT','TO_EXTRACT']);
            $table->bigInteger('bank_account_id')->unsigned();
            $table->foreign('bank_account_id')->references('id')->on('bank_accounts');
            $table->bigInteger('current_money')->default(0);
            $table->bigInteger('old_money')->default(0);
            $table->bigInteger('amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movements');
    }
}
