<?php

use Utilities\UserClass;
use Carbon\Carbon;

class LoginController extends BaseController
{
	function __construct()
	{
		$this->user = new UserClass();
	}
	public function viewResetRequests()
	{
		$requests = User::where('reset_request',1)->get();
		return View::make('request_view',compact('requests'))->with('title','Reset Requests View')->with('activeLink','');
	}
	public function resetRequest()
	{
		$userinfo = User::where('username',Input::get('username_request'))->get();
		if(count($userinfo)<=0)
		{
			$data = array('status'=>'failed');
		}
		else
		{
			$user = User::find($userinfo[0]->id);
			$user->reset_request = 1;
			$user->save();
			$data = array('status'=>'success');
		}
		return Response::json($data);
	}
	public function resetPassword()
	{
		$id = Input::get('userid');
		$data = ['newPass'=>Hash::make(Input::get('newPass'))];
		$this->user->reset_passord($id, $data);
		return Redirect::to('reset_requests_view')->with('message','Password Reset Successfully');
	}
	public function postLogin()
	{
		//flash all cache
		Cache::flush();
		$data = Input::all();
		$validator = Validator::make($data, User::$auth_rules);
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else
		{
			if(Auth::attempt(array('username'=>Input::get('username'),'password'=>Input::get('password'))))
			{
				if(Auth::user()['inactive']==1)
				{
					return Redirect::to('/')->with('message','User Account is Inactive. Please contact the administrator.')->with('activeLink','');
				}
				else
				{
					//dd(Auth::user()->role[0]->rolename);
					if(Auth::user()->role[0]->rolename === 'Discount-Data Admin') {
						//add email to cached
						$expiresAt = Carbon::now()->addMinutes(40);
						Cache::put('email', Auth::user()->email, $expiresAt);
						
						return Redirect::intended('discounts');
					}
					elseif(Auth::user()->role[0]->rolename === 'Discount-Data User') {
						//add email to cached
						$expiresAt = Carbon::now()->addMinutes(40);
						Cache::put('email', Auth::user()->email, $expiresAt);

						return Redirect::intended('discounts');

					}
					else {
						return Redirect::intended('validation');
					}
					
				}
			}
			else
			{
				
					return Redirect::to('/')->with('message','Invalid Username or Password.');
			}
		}
	}
	public function postUpdatePassword()
	{
		$id = Auth::user()['id'];
		if(Auth::attempt(array('password'=>Input::get('newPass'))))
			{
				$message = 'Current Password and New Password should not be the same';
				$status = 'fail';
			}
			else
			{
				$user = User::find($id);
				$user->password = Hash::make(Input::get('newPass'));
				$user->netsuite_password = Input::get('newPass');
				$user->save();
				$status = 'success';
				$message = 'Password Updated Successfully';
			}
			$data = array(
					  'status'=>$status,
					  'message'=>$message
				  );
			return Response::json($data);		
	}
	public function getLogout()
	{
		Cache::flush();
		Auth::logout();
		return Redirect::to('/');
	}
}
?>