<?php

class CustomersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          
        if(Cache::has('email')) {

            //$customers = Customer::with('users')->get();
            return View::make('discount.customers.index');
        }
        else {
            Session::flash('message', 'Session Expire!..');
            return View::make('login')->with('title','Login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('discount.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function addCustomers() 
    {
        //set_time_limit(0);
        //count the data to be insert
        $count;
        $response = [];
        $customers = [];
        $data = Input::get('customers');
        $size = sizeof($data);

        $result_add = false;
        
        $id = [];
        for($i = 0; $i<$size; $i++) {

            if($data[$i][0] !== "") {

                $customers = $data;
                $last_id = Customer::addCustomer($data[$i][0], $data[$i][1]);    
                //count the last inserted id 
                $id[]=$last_id;
            }
           
        }

        //$result = Customer::bulkAddcustomer($id);
        //remove empty array
        $result = array_filter($id);
        $size - sizeof($result);
        //check if array is empty
        if($size === 0 ) {

        }
        else {
            $count = count($result);
            $result_add = Customer::bulkAddcustomer($result);
        }
        $response = [
                'error' => false,
                'status_code' => 200,
                'count' => $count,
                'customers' => $customers,
                'result_add' => $result_add
            ];
        return Response::json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return View::make('discount.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return View::make('discount.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        /*$this->validate($request, ['name' => 'required|min:3']);
        $customer = Customer::find($id);
        $customer->update($request->all());
        Session::flash('update_flash', 'Successfully updated!..');
        return redirect('customers');*/
        $request = Input::all();
        $validator = Validator::make($request, ['name' => 'required|min:3']);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else {
            $customer = Customer::find($id);
            $customer->update($request);
            return Redirect::to('discounts/customers')->with('update_flash','Items Successfully Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(isset($id)) {
            $customer = Customer::find($id);
            $customer->delete();
        }
        return Redirect::to('discounts/customers')->with('delete', 'Successfully Deleted!..');
    }

    public function postSearch(Request $request) {
      
        $data = $request->all();
        $customers = Customer::getCustomerByName($data['search']);
        if($customers) {
            return view('customers.search', compact('customers'));
        }
        else {
            Session::flash('not_found', 'Item Not Exist!..');
            $customers = Customer::getCustomerInfo();
            return view('customers.index', compact('customers'));
        }
        
        
    }

    public function autoComplete() {
        $data = Request::all();
        $results = array();
        $discounts = DB::table('customers')
                    ->where('name', 'LIKE', '%'.$data['q'].'%')
                    ->take(5)->get();

        foreach ($discounts as $key) {
            $results[] = ['id' => $key->id, 'value' => $key->name];
        }

        return Response::json($results);
    }

    public function getCustomers() {
        return Response::json(Customer::customers());
    }

    public function tableCustomers()
    {
        return Datatable::collection(Customer::with('users')->get())
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
                return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href='customers/".$model->id."/edit'><i class='glyphicon glyphicon-edit'></i> </a>
                &nbsp;&nbsp;<a href='customers/delete/".$model->id."'><i class='glyphicon glyphicon-trash'></i> </a>
                &nbsp;&nbsp;<a href='customers/".$model->id."'><i class='glyphicon glyphicon-fullscreen'></i> </a>";
            })
            ->make();
    }
}
