<?php
use Carbon\Carbon;
class Location extends  Eloquent{
	protected $fillable = [
    	'name', 
    	'reference_id',
        'user_id',
        'updated_at'
    ];

    public function discounts() {
    	return $this->hasMany('Locations', 'location_id', 'name');
    }

    public function users() {
        return $this->belongsTo('User', 'user_id');
    }

    static function searchByReference($reference) {
        return $item = DB::table('locations')
                    ->select('locations.id')
                    ->where('locations.reference_id', '=', $reference)
                    ->pluck('id');
    }


    static function getIdByReferenceApi($reference, $user_id) {

        return $customer = DB::table('locations')
                    ->select(
                        'locations.id'
                    )
                    ->where('locations.reference_id', '=', $reference)
                    ->where('locations.user_id', '=', $user_id)
                    ->pluck('id');
        }


    static function addLocation($name, $reference_id) {

        $id = [];
        $now = Carbon::now();
        $items = [];
        $id = Location::searchByReference($reference_id);
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

    static function getLocationInfo() {

        return $locations = DB::table('locations')
                        ->leftjoin('users', 'users.id', '=', 'locations.user_id')
                        ->select(
                            'locations.id',
                            'locations.name',
                            'locations.reference_id',
                            'users.email',
                            'locations.created_at'
                        )
                        ->orderBy('locations.created_at', 'desc')
                        ->get();
    }

    static function getLocationLists() {

        return $item = DB::table('locations')
                ->select('locations.name')
                ->orderBy('locations.name', 'ASC')
                ->get();
    }

    static function bulkAddItem($data) {
        $response = Location::insert($data);
        return $response;
    } 

}