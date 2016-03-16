<?php
use Carbon\Carbon;
class Operation extends Eloquent {
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
        return $this->belongsTo('User','user_id');
    }


    static function getOperationByNameApi($name) {

        return $item = DB::table('operations')
                    ->leftjoin('users', 'users.id', '=', 'operations.user_id')
                    ->select(
                        'operations.id'
                    )
                    ->where('operations.name', '=', $name)
                    ->pluck('id');
    }

    static function getIdByReferenceApi($reference, $user_id) {

        return $customer = DB::table('operations')
                    ->select(
                        'operations.id'
                    )
                    ->where('operations.reference_id', '=', $reference)
                    ->where('operations.user_id', '=', $user_id)
                    ->pluck('id');
        }

    static function getCustomerInfo() {

        return $operations = DB::table('operations')
                            ->leftjoin('users', 'users.id', '=', 'operations.user_id')
                            ->select(
                                'operations.id',
                                'operations.name',
                                'operations.reference_id',
                                'users.email',
                                'operations.created_at'
                            )
                            ->orderBy('operations.created_at', 'desc')
                            ->get();
    }

    static function searchNameReference($name, $reference) {

        return $operations = DB::table('operations')
                            ->select('operations.id')
                            ->where('operations.name', '=', $name)
                            ->where('operations.reference_id', '=', $reference)
                            ->pluck('operations.id');
    }

    static function searchByReference($reference) {
        
        return $item = DB::table('operations')
                    ->select('operations.id')
                    ->where('operations.reference_id', '=', $reference)
                    ->pluck('id');
    }

     static function addOperation($name, $reference_id) {

        $id = [];
        $now = Carbon::now();
        $items = [];
        $id = Operation::searchByReference($reference_id);
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

    static function operationList() {
        return $price = DB::table('operations')
                ->select('operations.name')
                ->orderBy('operations.name', 'ASC')
                ->get();
    }

    static function bulkAddItem($data) {
        $response = Operation::insert($data);
        return $response;
    } 

}