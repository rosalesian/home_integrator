<?php

class OperationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        if(Cache::has('email')) {

           $operations = Operation::with('users')->get();
           return View::make('discount.operations.index', compact('operations'));
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
		return View::make('discount.operations.create');
	}

	public function addOperations() 
	{
		$response = [];
		$count;
		$data = Input::get('operations');
		$size = sizeof($data);
		
		$id = [];
		for($i = 0; $i<$size; $i++) {
			if($data[$i][0] !== "") {
				$last_id = Operation::addOperation($data[$i][0], $data[$i][1]);	
				$id[]=$last_id;
			}
		}
		//need to customize
		//$result = Operation::bulkAddItem($id);
		$result = array_filter($id);
		$result_size = sizeof($result);
		//check if array is empty
		if($result_size === 0 ){
			
		}
		else {
			$count = count($result);
			//add data for bulk function
			$discounts = Operation::bulkAddItem($result);;
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
		$operation = Operation::find($id);
        return View::make('discount.operations.show', compact('operation'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$operation = Operation::find($id);
        return View::make('discount.operations.edit', compact('operation'));
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
            $operation= Operation::find($id);
            $operation->update($request);
            return Redirect::to('discounts/operations')->with('update_flash','Operation Successfully Updated');
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
            $operation = Operation::find($id);
            $operation->delete();
        }
        Session::flash('delete', 'Successfully Deleted!..');
		$operations = Operation::with('users')->get();
        return View::make('discount.operations.index', compact('operations'));
	}

	public function getOperations() 
	{
		$operation = Operation::operationList();
		return Response::json($operation);
	}

    public function tableOperations()
    {
        return Datatable::collection(Operation::with('users')->get())
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
                return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href='operations/".$model->id."/edit'><i class='glyphicon glyphicon-edit'></i> </a>
                &nbsp;&nbsp;<a href='operations/delete/".$model->id."'><i class='glyphicon glyphicon-trash'></i> </a>
                &nbsp;&nbsp;<a href='operations/".$model->id."'><i class='glyphicon glyphicon-fullscreen'></i> </a>";

            })
            ->make();
    }
      //mobile get customers
    public function getOperationsMobile() {
        return Operation::all();
    }
    public function addOperationsMobile()
    {
        $result=Operation::searchByReference(Input::get('reference'));
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
            $operation = Operation::create($data);
            $response = [
                'status_code' => 22,
                'error' => false,
                'message' => 'Successfully Added',
                'id' => $operation->id,
            ];
        }
        return Response::json($response);
    }

    public function updateOperationsMobile()
    {
        $id = Input::get('id');
        $operation = Operation::find($id);
        if($operation)
        {
            $data = [
                'name' => Input::get('name'),
                'reference' => Input::get('reference'),
                'id' => Input::get('id'),
                'user_id' => Auth::user()->id,
                'updated_at' => date('Y-m-d h:i:s')
            ];
            $operation->update($data);
            $response = [
                'message' => 'Successfully Updated',
                'status_code' => 202,
                'error' => true,
                'id' => $operation->id
            ];
        }
        else
        {
            $response = [
                'message' => 'Not Found',
                'status_code' => 302,
                'id' => Input::get('id'),
                'error' => true,
                'data' => $operation
            ];
        }
        return Response::json($response);
    }
    public function deleteOperationsMobile()
    {
        $id = Input::get('id');
        $operation = Operation::find($id);
        if($operation != null && $operation != "")
        {
            $operation->delete();
            $response = [
                'message' => 'Successfully Deleted',
                'status_code' => 302,
                'id' => Input::get('id'),
                'error' => false,
                'found' => false,
                'data' => $operation->id
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
                'data' => $operation
            ];
        }
        return Response::json($response);
    }
}
