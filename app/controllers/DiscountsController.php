<?php

class DiscountsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Cache::has('email')) {
			/*$discounts = Discount::getDiscount(Auth::user()->id);*/
			//$discounts = Discount::getDiscount();
			return View::make('discount.discounts.index');
		}
		else {
			Session::flash('message', 'Session Expire!..');
			return View::make('login')->with('title','Login');
		}
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$customers = customer::lists('name', 'id');
        $items = Item::lists('name', 'id');
        $operations = Operation::lists('name', 'id');
        $locations = Location::lists('name', 'id');
        $prices = Pricelist::lists('name', 'id');
        return View::make('discount.discounts.create', compact('customers','items', 'operations','locations', 'prices'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(),[
											'user_id'=>'required',
											'customer_id'=>'required',
											'item_id' => 'required',
											'location_id'=>'required',
											'price_id'=>'required',
											'operation_id'=>'required',
											'disc1'=>'numeric',
											'disc2'=>'numeric',
											'disc3'=>'numeric',
											'disc4'=>'numeric'
										]);
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else {

			$disc1 = (Input::get('disc1') === "") ? "0.0" : Input::get('disc1');
			$disc2 = (Input::get('disc2') === "") ? "0.0" : Input::get('disc2');
			$disc3 = (Input::get('disc3') === "") ? "0.0" : Input::get('disc3');
			$disc4 = (Input::get('disc4') === "") ? "0.0" : Input::get('disc4');

			$data = [
					'user_id' => Input::get('user_id'),
					'customer_id' => Input::get('customer_id'),
					'item_id' => Input::get('item_id'),
					'location_id' => Input::get('location_id'),
					'price_id' => Input::get('price_id'),
					'operation_id' => Input::get('operation_id'),
					'disc1' => $disc1,
					'disc2' => $disc2,
					'disc3' => $disc3,
					'disc4' => $disc4
				];
			Discount::create($data);
        	return Redirect::to('discounts/discounts')->with('update_flash','Discount Successfully Added');
		}
       
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$discount = Discount::with('users','items', 'customers', 'locations', 'operations', 'pricelists')->find($id);
        return View::make('discount.discounts.show', compact('discount'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$discount = Discount::find($id);
       	$customers = customer::lists('name', 'id');
        $items = Item::lists('name', 'id');
        $operations = Operation::lists('name', 'id');
        $locations = Location::lists('name', 'id');
        $prices = Pricelist::lists('name', 'id');
        return View::make('discount.discounts.edit', compact('discount','customers','items', 'operations','locations', 'prices'));

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$request = Input::all();
		$disc1 = ($request['disc1'] == "") ? "0.0" : $request['disc1'];
		$disc2 = ($request['disc2'] == "") ? "0.0" : $request['disc2'];
		$disc3 = ($request['disc3'] == "") ? "0.0" : $request['disc3'];
		$disc4 = ($request['disc4'] == "") ? "0.0" : $request['disc4'];

		$data = [
			'user_id' => $request['user_id'],
			'customer_id' => $request['customer_id'],
			'item_id' => $request['item_id'],
			'operation_id' => $request['operation_id'],
			'location_id' => $request['location_id'],
			'price_id' => $request['price_id'],
			'disc1' => $disc1,
			'disc2' => $disc2,
			'disc3' => $disc3,
			'disc4' => $disc4
		];

		$discount = Discount::find($id);
		$discount->update($data);
		return Redirect::to('discounts/discounts')->with('update_flash','Items Successfully Updated');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		 if(isset($id)) {
            $discount = Discount::find($id);
            $discount->delete();
        }
        return Redirect::to('discounts/discounts')->with('delete', 'Successfully Deleted!..');
	}

	public function upload() 
	{
		return View::make('discount.discounts.upload');
	}

	public function addDiscount()
	{
		//count the data to be insert
		$count=0;
		//array or response
		$response = [];
		//hold the lastinsert id
		$id = [];
		//temporay hold the data
		$discounts = false;
		$data = Input::get('discounts');
		$size = sizeof($data);
		//add data to temporary array
		for($i = 0; $i<$size; $i++) 
		{
			if($data[$i][0] !== "") {
				$discount_id = Discount::addDiscount($data[$i][0], $data[$i][1], $data[$i][2], $data[$i][3],  $data[$i][4], $data[$i][5], $data[$i][6], $data[$i][7], $data[$i][8]);
				$id[]=$discount_id;
			}

		}
		//remove empty array
		$result = array_filter($id);
		$result_size = sizeof($result);
		//check if array is empty
		if($result_size === 0 ){
			
		}
		else {
			$count = count($result);
			//add data for bulk function
			$discounts = Discount::bulkAddDiscount($result);
		}
		$response = [
			'error' => false,
			'status_code' => 200,
			'data' => $data,
			'id' => $id,
			'count' => $count,
			'result_size' => $result_size,
			'result' => $result,
			'discount' => $discounts
		];
		return Response::json($response);
	}

    public function tableDiscounts()
    {
        return Datatable::collection(Discount::with('items','customers','locations', 'operations', 'pricelists', 'users')->get())
            ->searchColumns('customer_name', 'items', 'location_name', 'operation_name', 'price_name')
            ->addColumn('customer_name', function($model){
                return $model->customers->name;
            })
            ->addColumn('items', function($model){
                return $model->items->name;
            })
            ->addColumn('location_name', function($model){
                return $model->locations->name;
            })
            ->addColumn('operation_name', function($model){
                return $model->operations->name;
            })
            ->addColumn('price_name', function($model){
                return $model->pricelists->name;
            })
            ->addColumn('disc1', function($model){
                return $model->disc1;
            })
            ->addColumn('disc2', function($model){
                return $model->disc2;
            })
            ->addColumn('disc3', function($model){
                return $model->disc3;
            })
            ->addColumn('disc4', function($model){
                return $model->disc4;
            })
            ->addColumn('Options', function($model){
                return "<a href='discounts/".$model->id."/edit'><i class='glyphicon glyphicon-edit'></i> </a>
                <a href='discounts/delete/".$model->id."'><i class='glyphicon glyphicon-trash'></i> </a>
                <a href='discounts/".$model->id."'><i class='glyphicon glyphicon-fullscreen'></i> </a>";
            })
            ->make();
    }
}
