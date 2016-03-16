<?php

class ApiController extends \BaseController {

	private $name;
	private $reference;
	private $type;
	private $response = [];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function itemAdd()
	{

	
		$reference = Input::get('reference');
		$name = Input::get('name');
		$type = Input::get('type');
		$response = [];
		if($type === 'create') {
				$item = Item::create([
		        'user_id' => Auth::user()->id,
				'name' => $name,
				'reference_id' => $reference
			]);

			$response = [
					'error' => false,
					'status_code' => 200,
					'id' => $item->id
				];
		
		}
		elseif($type === 'edit') {
			$reference_id = Item::searchByReference($reference);
			if($reference_id !== 0) {
				$request_data = ['name' => $name, 'reference' => $reference];
				$item = Item::find($reference_id);
				$item->update($request_data);

				$response = [
						'error' => false,
						'status_code' => 200,
						'id' => $item->id
					];
			}
		}
		return Response::json($response);
	}

	public function locationsAdd() {

		$this->name = Input::get('name');
		$this->reference = Input::get('reference');
		$this->type = Input::get('type');

		if($this->type === 'create') {

			$location = Location::create([
		        'user_id' => Auth::user()->id,
				'name' => $this->name,
				'reference_id' => $this->reference
			]);

			$this->response = [
					'error' => false,
					'status_code' => 200,
					'id' => $location->id
				];
		}
		elseif($this->type === 'edit') {
			$id = Location::searchByReference($this->reference);
			if($id !== 0) {

				$data = ['name' => $this->name, 'reference' => $this->reference];
				$location = Location::find($id);
				$location->update($data);

				$this->response = [
						'error' => false,
						'status_code' => 200,
						'id' => $location->id
					];
			}
		}
		return Response::json($this->response);

	}

	public function operationsAdd() {

		$name = Input::get('name');
		$reference = Input::get('reference');
		$type = Input::get('type');

		$response = [];
		if($type === 'create') {

			$operation = Operation::create([
		        'user_id' => Auth::user()->id,
				'name' => $name,
				'reference_id' => $reference
			]);

			$response = [
					'error' => false,
					'status_code' => 200,
					'id' => $operation->id
				];
		}
		elseif($type === 'edit') {

			$reference_id = Operation::searchByReference($reference);
			if($reference_id !== 0) {
				$request_data = ['name' => $name, 'reference' => $reference];
				$operation = Operation::find($reference_id);
				$operation->update($request_data);

				$response = [
						'error' => false,
						'status_code' => 200,
						'id' => $operation->id
					];
			}
		}

		return Response::json($response); 
	}

	public function pricelistsAdd() {

		$name = Input::get('name');
		$reference = Input::get('reference');
		$type = Input::get('type');

		$response = [];

		if($type === 'create') {

			$price = Pricelist::create([
		        'user_id' => Auth::user()->id,
				'name' => $name,
				'reference_id' => $reference
			]);

			$response = [
					'error' => false,
					'status_code' => 200,
					'id' => $price->id
				];
		}
		elseif($type === 'edit') {

			$reference_id = Pricelist::searchByReference($reference);
			if($reference_id !== 0) {
				$request_data = ['name' => $name, 'reference' => $reference];
				$pricelist = Pricelist::find($reference_id);
				$pricelist->update($request_data);

				$response = [
						'error' => false,
						'status_code' => 200,
						'id' => $pricelist->id
					];
			}
		}

		return Response::json($response);
	}

	public function discountList() {

		$response = [];

		$customer = Input::get('customer');
		$item = Input::get('item');
		$location = Input::get('location');
		$operation = Input::get('operation');
		$user_id = Auth::user()->id;

		$customers = Customer::getIdByReferenceApi($customer, $user_id);
		$items = Item::getIdByReferenceApi($item, $user_id);
		$locations = Location::getIdByReferenceApi($location, $user_id);
		$operations = Operation::getIdByReferenceApi($operation, $user_id);

		if (($customers === null) || ($customers === 'undefined') || (strlen($customers) === 0) || ($customers === "")) {
				$response = [
					'error' => true,
					'message' => 'Customer not found.',
					'status_code' => 204,
					'discount' => null
				];
		}
		elseif(($locations === null) || ($locations === 'undefined') || (strlen($locations) === 0) || ($locations === "")) {
			$response = [
				'error' => true,
				'message' => 'Location not found.',
				'status_code' => 204,
				'discount' => null
			];
		}
		elseif(($operations === null) || ($operations === 'undefined') || (strlen($operations) === 0) || ($operations === "")) {
			$response = [
				'error' => true,
				'message' => 'Operation not found.',
				'status_code' => 204,
				'discount' => null
			];
		}
		elseif(($items === null) || ($items === 'undefined') || (strlen($items) === 0) || ($items === "")) {
			$response = [
				'error' => true,
				'message' => 'Item not found.',
				'status_code' => 204,
				'discount' => null
			];
		}
		
		//sample data
		else {
			//remove the pricelists					
			$discount = Discount::searchDiscountApi($user_id, $customers, $items, $locations, $operations);
			if($discount == null) {
					$response = [
					'error' => true,
					'message' => 'Discount not found.',
					'status_code' => 204,
					'discount' => null
				];
			}
			else {
				$response = $discount;
			}
		}

		return Response::json($response);
	}


	public function report() {

		$discount = DB::table('discounts')->count();
		$customer = DB::table('customers')->count();
		$item = DB::table('items')->count();
		$operation = DB::table('operations')->count();
		$location = DB::table('locations')->count();
		$price = DB::table('pricelists')->count();
		$resport = [
				'discount' => $discount,
				'customer' => $customer,
				'item' => $item,
				'operation' => $operation,
				'location' => $location,
				'price' => $price
			];

		return Response::json($resport);
	}

	public function customersAdd() {

		$response = [];

		$name = Input::get('name');
		$reference = Input::get('reference');
		$type = Input::get('type');

		if($type === 'create') {

			$customer = Customer::create([
		        'user_id' => Auth::user()->id,
				'name' => $name,
				'reference_id' => $reference
			]);

			$response = [
					'error' => false,
					'status_code' => 200,
					'id' => $customer->id
				];
		}
		elseif($type === 'edit') {

			$reference_id = Customer::searchByReference($reference);
			if($reference_id !== 0) {
				$request_data = ['name' => $name, 'reference' => $reference];
				$customer = Customer::find($reference_id);
				$customer->update($request_data);

				$response = [
						'error' => false,
						'status_code' => 200,
						'id' => $customer->id
					];
			}
		}

		return Response::json($response);
	}

	public function searchSi()
	{
		$transaction;
		$result_r;
		$response = [];
		$data = Input::get('internal_id');
		$result = json_decode($data, true);

		foreach ($result as $key) {
			$response[] = Transaction::searchTranactionExternal($key['internal_id']);
		}

		$result_r = array_filter($response);
		if(empty($result_r))
		{
			$result_r = [
				'error' => true,
				'message' => 'Customer not found.',
				'status_code' => 204,
				'discount' => 0,
				'gross' => 0,
				'net' => 0
			];
		}
		return Response::json($result_r);
	}

	public function getAmount()
	{
		$data = Input::get('internal_id');
		$result = json_decode($data, true);

		foreach ($result as $key) {
			$response[] = Transaction::searchTranactionExternal($key['internal_id']);
		}
		//REMOVE EMPTY VALUES
		$result_r = array_filter($response);
		if(empty($result_r))
		{
			$result_r = [
				'amount' => 0,
			    'discount' => 0,
			    'gross' => 0,
			    'net' => 0,
			    'internal_id' => 0
			];
			return Response::json($result_r);
		}
		//REMOVE BLANK 
		$result_merge = array_reduce($result_r, 'array_merge', array());
		return Response::json($result_merge);
		//return dd($me);
	}

	
}
