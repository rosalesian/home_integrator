<?php
class Invoice extends Eloquent
{
	protected $table = 'invoices';
	protected $primarykey = 'invoice_id';

	public function scopeSearchByDate($query, $date)
	{
		return $query->where('created_at','=',$date);
	}
	public function scopeSearchByCustomer($query, $value)
	{
		return $query->where('customer','LIKE','%'.$value.'%')->where('principal','LIKE','%'.$value.'%');
	}	
	// public function batch()
	// {
	// 	return $this->belongsTo('Batch');
	// }
}
