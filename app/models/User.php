<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	public static $auth_rules = array(
			'username'=>'required',
			'password'=>'required'
		);
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
    protected $fillable = array('name', 'password', 'email','username','role','branch');
    
    public function role()
    {
    	return $this->hasMany('Role','role_id','role_id');
    }
     public function branch()
    {
    	return $this->hasMany('Branch','branch_id','branch_id');
    }

    static function getCredential($user) {
    	return User::where('username',$user)->get();
    }

    public function items() {
    	return $this->hasMany('Item','user_id', 'email');
    }

    public function customers() {
    	return $this->hasMany('Customer', 'user_id', 'email');
    }

    public function operations() {
    	return $this->hasMany('Operation', 'user_id', 'email');
    }

    public function locations() {
    	return $this->hasMany('Location', 'user_id', 'email');
    }

    public function pricelists() {
    	return $this->hasMany('Prcelist', 'user_id', 'email');
    }

    public function discounts() {
        return $this->hasMany('Discount', 'user_id', 'email');
    }
}
