<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IntegratorTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function($table){
				$table->increments('transaction_id');
				$table->integer('record_internal_id');
				$table->string('entity');
				$table->date('record_date');
				$table->string('department');
				$table->string('principal');
				$table->string('location');				
				$table->string('external_id');
				$table->string('record_type');
				$table->date('created_at');
				$table->date('updated_at');
		});
		// Schema::create('invoices', function($table){
		// 		$table->increments('invoice_id');
		// 		$table->integer('record_internal_id');
		// 		$table->string('customer');
		// 		$table->string('account');
		// 		$table->date('record_date');
		// 		$table->string('department');
		// 		$table->string('principal');
		// 		$table->string('operation');
		// 		$table->string('location');				
		// 		$table->string('external_id');
		// 		$table->date('created_at');
		// 		$table->date('updated_at');
		// });
		// Schema::create('purchaseorders', function($table){
		// 		$table->increments('po_id');
		// 		$table->integer('record_internal_id');
		// 		$table->string('vendor');
		// 		$table->string('terms');
		// 		$table->date('record_date');
		// 		$table->string('department');
		// 		$table->string('principal');
		// 		$table->string('location');	
		// 		$table->string('paymenttype');				
		// 		$table->string('external_id');
		// 		$table->date('created_at');
		// 		$table->date('updated_at');
		// });
		// Schema::create('returnauthorizations', function($table){
		// 		$table->increments('ira_id');
		// 		$table->integer('record_internal_id');
		// 		$table->string('customer');
		// 		$table->date('record_date');
		// 		$table->string('memo');
		// 		$table->string('department');
		// 		$table->string('principal');
		// 		$table->string('location');	
		// 		$table->string('operation');				
		// 		$table->string('external_id');
		// 		$table->date('created_at');
		// 		$table->date('updated_at');
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transactions');
		// Schema::drop('invoices');
		// Schema::drop('purchaseorders');
		// Schema::drop('returnauthorizations');
	
	}

}
