<?php
class Batch extends Eloquent
{
	protected $table = 'batches';
	protected $primarykey = 'batch_id';

	public function user()
	{
		return $this->belongsTo('User');
	}
	public function invoice()
	{
		return $this->hasMany('Invoice');
	}
}
