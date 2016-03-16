<?php

class LocationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		if(Cache::has('email')) {
           return View::make('discount.locations.index');
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
		return View::make('discount.locations.create');
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
	public function addLocations() 
	{
		$response = [];

		$count;
		$data = Input::get('locations');
		$size = sizeof($data);
		
		$id = [];
		for($i = 0; $i<$size; $i++) {
			if($data[$i][0] !== "") {
				$last_id = Location::addLocation($data[$i][0], $data[$i][1]);	
				$id[]=$last_id;
			}
		}

		//$result = Location::bulkAddItem($id);
		$result = array_filter($id);
		$result_size = sizeof($result);
		//check if array is empty
		if($result_size === 0 ){
			
		}
		else {
			$count = count($result);
			//add data for bulk function
			$discounts = Location::bulkAddItem($result);
		}

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
		$location = Location::find($id);
        return View::make('discount.locations.show', compact('location'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$location = Location::find($id);
        return View::make('discount.locations.edit', compact('location'));
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
            $location = location::find($id);
            $location->update($request);
            return Redirect::to('discounts/locations')->with('update_flash','Items Successfully Updated');
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
            $location = Location::find($id);
            $location->delete();
        }
        return Redirect::to('discounts/locations')->with('delete', 'Successfully Deleted!..');
	}

	//get the locations lists for autosuggest in table
	public function getLocations() {

		$locations = Location::getLocationLists();
		return Response::json($locations);
	}

    public function tableLocations()
    {
        return Datatable::collection(Location::with('users')->get())
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
                return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href='locations/".$model->id."/edit'><i class='glyphicon glyphicon-edit'></i> </a>
                &nbsp;&nbsp;<a href='locations/delete/".$model->id."'><i class='glyphicon glyphicon-trash'></i> </a>
                &nbsp;&nbsp;<a href='locations/".$model->id."'><i class='glyphicon glyphicon-fullscreen'></i> </a>";

            })
            ->make();
    }


}
