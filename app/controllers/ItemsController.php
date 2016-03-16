<?php

class ItemsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		if(Cache::has('email')) {
			$items = Item::with('users')->get();
			return View::make('discount.items.index', compact('items'));
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
		return View::make('discount.items.create');
	}

	public function addItems() 
	{
		//count the data to be insert
		$count;
		//result for insert bulk
		$items = false;	
		$response = [];

		$data = Input::get('items');
		$size = sizeof($data);
		//$actual_data = [];
		$result = [];
		
		$id = [];
		for($i = 0; $i<$size; $i++) {
			//check if the data is null
			if($data[$i][0] !== "") {
				$last_id = Item::addItem($data[$i][0], $data[$i][1]);	
				$id[]=$last_id;
			}
			
		}
		
		$result = array_filter($id);
		$size = sizeof($result);
		//check if array is empty
		if($size === 0) {

		}
		else {
			$count = count($result);
			//add data for bulk function
			$items = Item::bulkAddItem($result);
		}
		$response = [
				'error' => false,
				'status_code' => 200,
				'id' => $id,
				'count' => $count,
				'item_result' => $items
			];
		return Response::json($response);
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
		$item = Item::find($id);
        return View::make('discount.items.show', compact('item'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item = Item::find($id);
        return View::make('discount.items.edit', compact('item'));
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
        	$item = Item::find($id);
        	$item->update($request);
        	return Redirect::to('discounts/items')->with('update_flash','Items Successfully Updated');
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
            $item = Item::find($id);
            $item->delete();
        }
        return Redirect::to('discounts/items')->with('delete', 'Successfully Deleted!..');
	}

	 public function postSearch() {
      	
      	$name = Input::get('search');
        //$data = $request->all();
        $item = Item::getItemName($name);
        if($item) {
           return View::make('discount.items.search', compact('item'));
        	//return $item;
        }
        else {
            Session::flash('not_found', 'Item Not Exist!..');
            $items = Item::latest()->paginate(8);
			return View::make('discount.items.index', compact('items'));
        }
        
    }

    public function Dashboard() {

    	if(Cache::has('email')) {
    		
			return View::make('discount.dashboard.dashboard');
		}
		else {
			Session::flash('message', 'Session Expire!..');
			return View::make('login')->with('title','Login');
		}
    }

    //get the items for autosuggest in adding the item table
    public function getItems() {

    	$item = Item::getItemList();
    	return Response::json($item);
    }

    public function tableGetItems()
    {
        return Datatable::collection(Item::with('users')->get())
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
                return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href='items/".$model->id."/edit'><i class='glyphicon glyphicon-edit'></i> </a>
                &nbsp;&nbsp;<a href='items/delete/".$model->id."'><i class='glyphicon glyphicon-trash'></i> </a>
                &nbsp;&nbsp;<a href='items/".$model->id."'><i class='glyphicon glyphicon-fullscreen'></i> </a>";

            })
            ->make();
    }


}
