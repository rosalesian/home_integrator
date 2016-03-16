<?php
namespace Utilities\Repositories\Transaction;

use Illuminate\Support\ServiceProvider;

class TransactionServiceProvider extends ServiceProvider{

	public function register()
	{
		$this->app->bind(
			'Utilities\Repositories\Transaction\TransactionRepositoryInterface',
		
			'Utilities\Repositories\Transaction\TransactionRepository'
		);
	}
}