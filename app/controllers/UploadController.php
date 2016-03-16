<?php

use Utilities\Repositories\Transaction\TransactionRepositoryInterface;

class UploadController extends \BaseController {

	protected $transaction;

	public function __construct(TransactionRepositoryInterface $transaction)
	{
		$this->transaction = $transaction;
	}


	/**
	 * Display a listing of the transaction.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->view('index')
			->with('transactions', $this->transaction->all());	
	}


	/**
	 * Show the form for creating a new transaction.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->view('create');			
	}


	/**
	 * Store a newly created transaction in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->transaction->save(Input::all());
	}


	/**
	 * Display the specified transaction.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$this->view('show')
			->with('transaction', $this->transaction->get($id));
	}


	/**
	 * Show the form for editing the specified transaction.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified transaction in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$this->transaction->update($id, Input::all());
	}


	/**
	 * Remove the specified transaction from storage.	
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->transaction->delete($id);
	}


}
