<?php
namespace Utilities\Repositories\Transaction;

use Illuminate\Database\Eloquent\Model;
use Transaction;

class TransactionRepository implements TransactionRepositoryInterface{

	protected $transaction;

	public function __construct(Transaction $transaction)
	{
		$this->transaction = $transaction;
	}

	public function all()
	{
		return 'this is from repo';//$this->transaction->paginate(15)->get();
	}

	public function get($id)
	{
		return $this->transaction->findOrFail($id);
	}

	public function save($input)
	{
		return $this->transaction->save($input);
	}

	public function update($id, $input)
	{
		$data = $this->transaction->findOrFail($id);	
	}

	public function delete($id)
	{
		$this->transaction->delete($id);
	}
}