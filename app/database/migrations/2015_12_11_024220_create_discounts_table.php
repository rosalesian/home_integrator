<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discounts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('reference_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->integer('price_id')->unsigned();
            $table->integer('operation_id')->unsigned();
            $table->string('disc1');
            $table->string('disc2');
            $table->string('disc3');
            $table->string('disc4');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('item_id')
                  ->references('id')
                  ->on('items')
                  ->onDelete('cascade');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('cascade');
            $table->foreign('location_id')
                  ->references('id')
                  ->on('locations')
                  ->onDelete('cascade');
            $table->foreign('operation_id')
                  ->references('id')
                  ->on('operations')
                  ->onDelete('cascade');
            $table->foreign('price_id')
                  ->references('id')
                  ->on('pricelists')
                  ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('discounts');
	}

}
