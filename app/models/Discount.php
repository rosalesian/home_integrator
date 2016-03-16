<?php

use Carbon\Carbon;
class Discount extends Eloquent {

	protected $dates = ['deleted_at'];
	protected $fillable = [
	        'reference_id',
	        'user_id',
	        'customer_id',
	        'item_id',
	        'location_id',
	        'price_id',
	        'operation_id',
	        'disc1',
	        'disc2',
	        'disc3',
	        'disc4'
	    ];

    public function items() {
    	return $this->belongsTo('Item', 'item_id', 'id');
    }

    public function customers() {
    	return $this->belongsTo('Customer', 'customer_id', 'id');
    }

    public function locations() {
    	return $this->belongsTo('Location', 'location_id', 'id');
    }

    public function operations() {
    	return $this->belongsTo('Operation', 'operation_id', 'id');
    }

    public function pricelists() {
    	return $this->belongsTo('Pricelist', 'price_id', 'id');
    }

    public function users() {
    	return $this->belongsTo('User', 'user_id', 'id');
    }

    //api discount search return

    static function searchDiscountApi($user_id, $customer, $item, $location, $operation) {

    	return $discount = DB::table('discounts')
                        ->leftjoin(
                                'pricelists', 'pricelists.id', '=', 'discounts.price_id'
                        )
    					->select(
    							'disc1',  
    							'disc2',
    							'disc3',
    							'disc4',
                                'pricelists.reference_id as price_id'
    						)
    					->where('discounts.customer_id','=', $customer)
    					->where('discounts.user_id', '=', $user_id)
                        ->where('discounts.location_id', '=', $location)
    					->where('discounts.operation_id', '=', $operation)
    					->where('discounts.item_id', '=', $item)
    					->get();

    }


     //static function getDiscount($user_id) {
    static function getDiscount() {

        return $discounts = DB::table('discounts')
                            ->leftjoin(
                                'customers', 'discounts.customer_id', '=', 'customers.id'
                            )
                            ->leftjoin(
                                'items', 'discounts.item_id', '=', 'items.id'
                            )
                            ->leftjoin(
                                'locations', 'discounts.location_id', '=', 'locations.id'
                            )
                            ->leftjoin(
                                'operations', 'discounts.operation_id', '=', 'operations.id'
                            )
                            ->leftjoin(
                                'pricelists', 'discounts.price_id', '=', 'pricelists.id'
                            )
                            ->select(
                                'discounts.id',
                                'customers.name as customer_name',
                                'items.name as item_name', 
                                'locations.name as location_name',
                                'operations.name as operation_name',
                                'pricelists.name as price_name',
                                'discounts.disc1', 
                                'discounts.disc2', 
                                'discounts.disc3', 
                                'discounts.disc4'
                            )
                            /*->where('discounts.user_id', '=', $user_id)*/
                            ->orderBy('discounts.created_at', 'desc')
                            ->get();
    }

    static function addDiscount($customer, $item, $location, $price,  $operation, $disc1, $disc2, $disc3, $disc4) 
    {
        //get the date now
        //$now = Carbon::now();
        $now = date('Y-m-d H:i:s'); 

        //temporary array
        $discounts = [];

        $customers = Discount::search('customers', $customer);
        $items = Discount::search('items', $item);
        $locations = Discount::search('locations', $location);
        $pricelists = Discount::search('pricelists', $price);
        $operations = Discount::search('operations', $operation);

        //search discount
        $id = Discount::searchDiscount($customers, $items);
        if($id == 0 && $id == "") {
               $discounts = [
                'user_id' => Auth::user()->id,
                'customer_id' => $customers,
                'item_id' => $items,
                'location_id' => $locations,
                'price_id' => $pricelists,
                'operation_id' => $operations,
                'disc1' => $disc1,
                'disc2' => $disc2,
                'disc3' => $disc3,
                'disc4' => $disc4,
                'created_at' => $now,
                'updated_at' => $now
            ];
        } 
        return $discounts;
    }


    static function search($table , $value) {

        return $data = DB::table($table)
                ->select($table.'.id')
                ->where($table.'.name', '=', $value)
                ->pluck('id');
    }

    static function searchDiscount($customer, $item) {
        return $data = DB::table('discounts')
                    ->select('discounts.id')
                    ->where('discounts.customer_id', '=', $customer)
                    ->where('discounts.item_id', '=', $item)
                    ->pluck('id');
    }

    static function bulkAddDiscount($data) {
        $response = Discount::insert($data);
        return $response;
    }

}