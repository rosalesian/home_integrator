<?php

class PricelistsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		/*$pricelists = Pricelist::getPriceListInfo();
		return View::make('discount.pricelists.index', compact('pricelists'));*/

		if(Cache::has('email')) {

           $pricelists = Pricelist::with('users')->get();
           return View::make('discount.pricelists.index', compact('pricelists'));
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
		return View::make('discount.pricelists.create');
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

	public function addPrice() 
	{
		$response = [];
		$count;
		$data = Input::get('locations');
		$size = sizeof($data);
		
		$id = [];
		for($i = 0; $i<$size; $i++) {
			if($data[$i][0] !== "") {
				$last_id = Pricelist::addPricelists( $data[$i][0], $data[$i][1]);	
				$id[]=$last_id;
			}
		}
		$result = array_filter($id);
		$result_size = sizeof($result);
		//check if array is empty
		if($result_size === 0 ){
			
		}
		else {
			$count = count($result);
			//add data for bulk function
			$discounts = Pricelist::bulkAddItem($result);;
		}
		/*$result = Pricelist::bulkAddItem($id);*/
		$response = [
				'error' => false,
				'status_code' => 200,
				'result' => $result,
				'id' => $id,
				'count' => $count
			];
		return Response::json($response);
	}



	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$pricelist = Pricelist::find($id);
        return View::make('discount.pricelists.show', compact('pricelist'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$price = Pricelist::find($id);
        return View::make('discount.pricelists.edit', compact('price'));
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
        $validator = Validator::make($request, ['name' => 'required|min:3']);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else {
            $price = Pricelist::find($id);
            $price->update($request);
            return Redirect::to('discounts/pricelists')->with('update_flash','Items Successfully Updated');
        }
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
            $price = Pricelist::find($id);
            $price->delete();
        }
        Session::flash('delete', 'Successfully Deleted!..');
		 $pricelists = Pricelist::with('users')->get();
           return View::make('discount.pricelists.index', compact('pricelists'));
	}

	// get the pricelist for autusuggest
	public function getPricelists() {
		$price = Pricelist::getLists();
		return Response::json($price);
	}

    public function tablePricelists()
    {
        return Datatable::collection(Pricelist::with('users')->get())
            ->searchColumns('name', 'reference_id')
            ->addColumn('name', function($model){
                return $model->name;
            })
            ->addColumn('reference_id', function($model){
                return $model->reference_id;
            })
            ->addColumn('created on', function($model){
                return $model->created_at->diffForHumans();
            })
            ->addColumn('Created by', function($model){
                return $model->users->email;
            })
            ->addColumn('Options', function($model){
                return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href='pricelists/".$model->id."/edit'><i class='glyphicon glyphicon-edit'></i> </a>
                &nbsp;&nbsp;<a href='pricelists/delete/".$model->id."'><i class='glyphicon glyphicon-trash'></i> </a>
                &nbsp;&nbsp;<a href='pricelists/".$model->id."'><i class='glyphicon glyphicon-fullscreen'></i> </a>";

            })
            ->make();
    }
     //mobile get customers
    public function getPricelistsMobile() {
        return Pricelist::all();
    }
    public function addPricelistsMobile()
    {
        $result=Pricelist::searchByReference(Input::get('reference'));
        if($result != null && $result != "")
        {
            $response = [
                'name' => Input::get('name'),
                'reference' => Input::get('reference'),
                'result' => $result,
                'message' => 'Already Exist'
            ];
        }
        else
        {
            $data = [
                'name' => Input::get('name'),
                'reference_id' => Input::get('reference'),
                'user_id' => Auth::user()->id,
            ];

            $pricelist = Pricelist::create($data);

            $response = [
                'status_code' => 22,
                'error' => false,
                'message' => 'Successfully Added',
                'id' => $pricelist->id,
            ];
        }
        return Response::json($response);
    }

    public function updatePricelistsMobile()
    {
        $id = Input::get('id');
        $pricelist = Pricelist::find($id);
        if($pricelist)
        {
            $data = [
                'name' => Input::get('name'),
                'reference' => Input::get('reference'),
                'id' => Input::get('id'),
                'user_id' => Auth::user()->id,
                'updated_at' => date('Y-m-d h:i:s')
            ];
            $pricelist->update($data);
            $response = [
                'message' => 'Successfully Updated',
                'status_code' => 202,
                'error' => true,
                'found' => false,
                'id' => $pricelist->id
            ];
        }
        else
        {
            $response = [
                'message' => 'Not Found',
                'status_code' => 302,
                'id' => Input::get('id'),
                'error' => true,
                'found' => true
            ];
        }
        return Response::json($response);
    }
    public function deletePricelistsMobile()
    {
        $id = Input::get('id');
        $pricelist = Pricelist::find($id);
        if($pricelist != null && $pricelist != "")
        {
            $pricelist->delete();
            $response = [
                'message' => 'Successfully Deleted',
                'status_code' => 302,
                'id' => Input::get('id'),
                'error' => false,
                'found' => false,
                'data' => $pricelist->id
            ];
        }
        else
        {
            $response = [
                'message' => 'Not Found',
                'status_code' => 302,
                'id' => Input::get('id'),
                'error' => false,
                'found' => true,
                'data' => $pricelist
            ];
        }
        return Response::json($response);
    }
}
