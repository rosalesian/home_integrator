<?php
namespace Utilities\Repositories\Transaction;

interface TransactionRepositoryInterface{

	public function all();

	public function get($id);

	public function save($input);

	public function update($id, $input);
}