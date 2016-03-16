<?php
use Carbon\Carbon;
class Customer extends Eloquent {
	
	 protected $fillable = [
    	'user_id',
    	'name', 
    	'reference_id',
    	'updated_at'
    ];

    public function discounts() {
    	return $this->hasMany('Discounts', 'discount_id', 'name');
    }
    
    public function users() {
        return $this->belongsTo('User','user_id');
    }

    static function apiAddCustomer($name, $reference_id) {

		$item = Customer::create([
            'user_id' => Auth::user()->id,
			'name' => $name,
			'reference_id' => $reference_id
		]);
		return $item->id;
    }

    static function searchCustomer($name) {
        $id = DB::table('customers')
                ->select('customers.id')
                ->where('customers.name', '=', $name)
                ->pluck('id');
        /*return $item = Item::updateItem($id, $name, $reference);*/
        return $id;
    }

    static function updateCustomer($id, $name, $reference) {
        
       return $item = DB::table('customers')
                ->where('id', $id)
                ->update([
                    'name' => $name,
                    'user_id' => Auth::user()->id, 
                    'reference_id' => $reference,
                    'updated_at' => date('Y-m-d h:i:s')
                ]);
    }

    static function getCustomerName($name) {

        return $item = DB::table('customers')
                    ->select('*')
                    ->where('customers.name', '=', $name)
                    ->get();
    }

    static function getCustomerInfo() {

    	return $customer = DB::table('customers')
    					->leftjoin('users', 'users.id', '=', 'customers.user_id')
    					->select(
                            'customers.id',
                            'customers.name',
                            'customers.reference_id',
                            'users.email',
                            'customers.created_at'
                        )
                        ->orderBy('customers.created_at', 'desc')
                        ->get();
    }

    //search funtion beside pagination
    static function getCustomerByName($name) {

        return $item = DB::table('customers')
                    ->leftjoin('users', 'users.id', '=', 'customers.user_id')
                    ->select(
                        'customers.id',
                        'customers.name',
                        'customers.reference_id',
                        'customers.created_at',
                        'users.email'
                    )
                    ->where('customers.name', '=', $name)
                    ->get();
    }

    static function getCustomerByNameApi($name) {

        return $item = DB::table('customers')
                    ->leftjoin('users', 'users.id', '=', 'customers.user_id')
                    ->select(
                        'customers.id'
                    )
                    ->where('customers.name', '=', $name)
                    ->pluck('id');
    }

    static function getIdByReferenceApi($reference, $user_id) {

        return $customer = DB::table('customers')
                    ->select(
                        'customers.id'
                    )
                    ->where('customers.reference_id', '=', $reference)
                    ->where('customers.user_id', '=', $user_id)
                    ->pluck('id');
    }

    static function searchByReference($reference) {
        return $item = DB::table('customers')
                    ->select('customers.id')
                    ->where('customers.reference_id', '=', $reference)
                    ->pluck('id');
    }

    static function addCustomer($name, $reference_id) {
       /* $now = Carbon::now();        
        $items = [
            'user_id' => Auth::user()->id,
            'name' => $name,
            'reference_id' => $reference_id,
            'created_at' => $now,
            'updated_at' => $now
        ];
        return $items;  */
        $id = [];
        $now = Carbon::now();
        $items = [];
        $id = Customer::searchByReference($reference_id);
        if($id == 0 && $id == "") {
              $items = [
                    'user_id' => Auth::user()->id,
                    'name' => $name,
                    'reference_id' => $reference_id,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
        } 
       return $items;
    }

    //get the customers for dropdown list
    static function customers() {
        return $customers = DB::table('customers')
                            ->select('customers.name')
                            ->orderBy('customers.name', 'ASC')
                            ->get();
    }

    // add bulk function 
    static function bulkAddcustomer($data) {
        $response = Customer::insert($data);
        return $response;
    }
	
}