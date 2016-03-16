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



}
