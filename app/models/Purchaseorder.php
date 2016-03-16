<?php
class Purchaseorder extends Eloquent
{
	protected $table = 'purchaseorders';
	protected $primarykey = 'po_id';

	public function scopeSearchByDate($query, $date)
	{
		return $query->where('created_at','=',$date);
	}
	public function scopeSearchByVendor($query, $value)
	{
		return $query->where('vendor','LIKE','%'.$value.'%');
	}
}
