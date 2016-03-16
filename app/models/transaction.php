<?php
class Transaction extends Eloquent
{
	protected $table = 'transactions';
	protected $primaryKey = 'transaction_id';

	public function scopeSearchByDate($query, $date)
	{
		return $query->where('record_date','=',$date);
	}
	public function scopeSearchTransaction($query, $value)
	{
		return $query->where(function($q) use($value){
		$q->where('entity','LIKE','%'.$value.'%')
		  ->orWhere('location','LIKE','%'.$value.'%')
		  ->orWhere('department','LIKE','%'.$value.'%')
		  ->orWhere('principal','LIKE','%'.$value.'%')
		  ->orWhere('external_id','LIKE','%'.$value.'%');
		});
	}
	public function user()
	{
		return $this->belongsTo('User','user_id','id');
	}

	static function searchTranactionExternal($id)
	{
		return DB::table('transactions')
				->select('transactions.amount', 'transactions.discount', 'transactions.gross', 'transactions.net', 'transactions.record_internal_id AS internal_id')
				->where('transactions.record_internal_id', '=', $id)
				->get();
	}
}
?>