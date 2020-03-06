<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollateralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaterals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->string('material_name');
            $table->integer('quantity');
            $table->integer('kyat')->nullable();
            $table->integer('pel')->nullable();
            $table->integer('yway')->nullable();
            $table->integer('chan')->nullable();
            $table->integer('sate')->nullable();
            $table->boolean('gem_included');
            $table->integer('amount');
            $table->float('rate');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')->on('users')->onDelete('cascade');
            $table->integer('status')->default(0);
            $table->dateTime('expired_date')->nullable();
            $table->dateTime('withdrawn_date')->nullable();
            $table->integer('withdrawn_by')->nullable();
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
        Schema::dropIfExists('collaterals');
    }
}
