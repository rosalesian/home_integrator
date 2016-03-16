<?php
use Carbon\Carbon;
class Pricelist extends Eloquent {
	protected $fillable = [
    	'user_id',
        'name', 
        'reference_id',
        'updated_at',
        'user_id'
    ];

    public function discounts() {
    	return $this->hasMany('Discounts', 'discount_id', 'name');
    }

    public function users() {
        return $this->belongsTo('User', 'user_id');
    }

    //search for api
    static function getPriceByNameApi($name) {

        return $item = DB::table('pricelists')
                    ->leftjoin('users', 'users.id', '=', 'pricelists.user_id')
                    ->select(
                        'pricelists.id'
                    )
                    ->where('pricelists.name', '=', $name)
                    ->pluck('id');
    }

    static function getIdByReferenceApi($reference, $user_id) {

        return $customer = DB::table('pricelists')
                    ->select(
                        'pricelists.id'
                    )
                    ->where('pricelists.reference_id', '=', $reference)
                    ->where('pricelists.user_id', '=', $user_id)
                    ->pluck('id');
        }

    static function getPriceListInfo() {

        return $customer = DB::table('pricelists')
                        ->leftjoin('users', 'users.id', '=', 'pricelists.user_id')
                        ->select(
                            'pricelists.id',
                            'pricelists.name',
                            'pricelists.reference_id',
                            'users.email',
                            'pricelists.created_at'
                        )
                        ->orderBy('pricelists.created_at', 'desc')
                        ->get();
    }

    static function searchByReference($reference) {
        
        return $pricelist = DB::table('pricelists')
                    ->select('pricelists.id')
                    ->where('pricelists.reference_id', '=', $reference)
                    ->pluck('id');
    }
    
    static function addPricelists($name, $reference_id) {

        $id = [];
        $now = Carbon::now();
        $items = [];
        $id = Pricelist::searchByReference($reference_id);
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

    static function getLists() {

        return $price = DB::table('pricelists')
                    ->select('pricelists.name')
                    ->orderBy('pricelists.name', 'ASC')
                    ->get();
    }

    static function bulkAddItem($data) {
        $response = Pricelist::insert($data);
        return $response;
    } 

}