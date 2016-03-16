<?php
use Carbon\Carbon;

class Item extends Eloquent {
	
	 protected $fillable = [
        'user_id',
    	'name', 
    	'reference_id',
        'updated_at',
        'user_id'
    ];

    protected $dates = ['created_at'];

    public function users() {
        return $this->belongsTo('User','user_id');
    }

    public function discounts() {
       return $this->hasMany('Items', 'items_id', 'name');
    }


    static function apiAddItem($name, $reference_id) {

		$item = Item::create([
            'user_id' => Auth::user()->id,
			'name' => $name,
			'reference_id' => $reference_id
		]);
		return $item->id;
    }
    
    static function searchItem($name) {
        $id = DB::table('items')
                ->select('items.id')
                ->where('items.name', '=', $name)
                ->pluck('id');
        /*return $item = Item::updateItem($id, $name, $reference);*/
        return $id;
    }

    static function updateItem($id, $name, $reference) {
        
       return $item = DB::table('items')
                ->where('id', $id)
                ->update([
                    'name' => $name,
                    'user_id' => Auth::user()->id, 
                    'reference_id' => $reference,
                    'update_at' => date('Y-m-d h:i:s')
                ]);
    }

    //search funtion beside pagination
    static function getItemName($name) {

        return $item = DB::table('items')
                    ->select('*')
                    ->where('items.name', '=', $name)
                    ->get();
    }


    //search for api
    static function getItemByNameApi($name) {

        return $item = DB::table('items')
                    ->leftjoin('users', 'users.id', '=', 'items.user_id')
                    ->select(
                        'items.id'
                    )
                    ->where('items.name', '=', $name)
                    ->pluck('id');
    }

    static function searchByReference($reference) {
        return $item = DB::table('items')
                    ->select('items.id')
                    ->where('items.reference_id', '=', $reference)
                    ->pluck('id');
                   // ->get();
    }

   static function getIdByReferenceApi($reference, $user_id) {

    return $customer = DB::table('items')
                ->select(
                    'items.id'
                )
                ->where('items.reference_id', '=', $reference)
                ->where('items.user_id', '=', $user_id)
                ->pluck('id');
    }


    static function addItem($name, $reference_id) {

        $id = [];
        $now = Carbon::now();
        $items = [];
        $id = Item::searchByReference($reference_id);
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

    //add actual data to array
    static function addItemActual($name, $reference_id) {

        //$id = [];
        $now = Carbon::now();
       // $items = [];
        //$id = Item::searchByReference($reference_id);
       // if($id == 0 && $id == "") {
              $items = [
                    'user_id' => Auth::user()->id,
                    'name' => $name,
                    'reference_id' => $reference_id,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
        //} 
       return $items;
    }

    static function getItemInfo() {

        return $locations = DB::table('items')
                        ->leftjoin('users', 'users.id', '=', 'items.user_id')
                        ->select(
                            'items.id',
                            'items.name',
                            'items.reference_id',
                            'users.email',
                            'items.created_at'
                        )
                        ->orderBy('items.created_at', 'desc')
                        ->get();
    }

    static function getItemList() {

        return $item = DB::table('items')
                    ->select('items.name')
                    ->orderBy('items.name', 'ASC')
                    ->get();
    }

    static function bulkAddItem($data) {
        $response = Item::insert($data);
        return $response;
    }

}
