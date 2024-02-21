<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->float('transaction_amount');
            $table->integer('installments');
            $table->string('token');
            $table->integer('payer_id');
            $table->string('payment_method_id');
            $table->string('notification_url');
            $table->string('status');
            $table->timestamps();

            $table->foreign('payer_id')->references('id')->on("payer");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
};
