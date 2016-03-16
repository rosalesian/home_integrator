<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddcolumnTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transactions', function(Blueprint $table)
		{
			
			$table->string('amount');
			$table->string('discount');
			$table->string('net');
			$table->string('gross');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Schema::drop('transactions');
		Schema::table('transactions', function($table)
		{
		    $table->dropColumn(array('amount', 'discount', 'net','gross'));
		});
	}

}
