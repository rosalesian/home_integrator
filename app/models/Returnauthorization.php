<?php
class Returnauthorization extends Eloquent
{
	protected $table = 'returnauthorizations';
	protected $primarykey = 'ira_id';
	public function scopeSearchByDate($query, $date)
	{
		return $query->where('created_at','=',$date);
	}
	public function scopeSearchByCustomer($query, $value)
	{
		return $query->where('customer','LIKE','%'.$value.'%');
	}
}
