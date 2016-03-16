<?php

use Utilities\UserClass;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class UserController extends BaseController {

	function __construct()
	{
		$this->user = new UserClass();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->getAll();
		return View::make('user.index', array('users'=>$users))->with('title','Users')->with('activeLink','system_manager');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = Role::where('inactive',0)->get();
		$branches = Branch::where('inactive',0)->get();
		return View::make('user.create',array('roles'=>$roles,'branches'=>$branches))
					->with('title','Create New User')
					->with('activeLink','system_manager');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name'=>'required',
			'username'=>'required|unique:users,username',
			'password'=>'required',
			'email'=>'required|email'
			);
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else
		{
			
			(Input::get('inactive_status')=='on') ? $status = 1 : $status = 0;
			$data = array(
				'name'=>Input::get('name'),
				'username'=>Input::get('username'),
				'password'=>Hash::make(Input::get('password')),
				'netsuite_password'=>Input::get('password'),
				'email'=>Input::get('email'),
				'branch'=>Input::get('branchname'),
				'netsuite_role'=>Input::get('netsuite_role'),
				'role'=>Input::get('rolename'),
				'inactive_status'=>$status
				);
			$userid = $this->user->save($data);
			return Redirect::to('user/'.$userid);
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = $this->user->findUser($id);
		return View::make('user.show', array('user'=>$user))
					->with('title','View User')
					->with('activeLink','system_manager');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->user->findUser($id);
		$roles = Role::where('inactive',0)->get();
		$branches = Branch::where('inactive',0)->get();
		return View::make('user.edit', array('user'=>$user,'roles'=>$roles,'branches'=>$branches))
					->with('title','Edit User')
					->with('activeLink','system_manager');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{		
			(Input::get('inactive_status')=='on') ? $status = 1 : $status = 0;
			$data = array(
				'name'=>Input::get('name'),
				'username'=>Input::get('username'),
				'email'=>Input::get('email'),
				'branch'=>Input::get('branchname'),
				'netsuite_role'=>Input::get('netsuite_role'),
				'role'=>Input::get('rolename'),
				'inactive_status'=>$status
				);
			$userid = $this->user->update($id, $data);
			return Redirect::to('user/'.$userid)->with('message','User Successfully Updated');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function resetPassword()
	{
		$id = Input::get('userid');
		$data = ['newPass'=>Hash::make(Input::get('newPass')),'netsuite_password'=>Input::get('newPass')];
		$userid = $this->user->reset_passord($id, $data);
		return Redirect::to('user/'.$userid)->with('message','Password Reset Successfully');
	}

	public function fetch(Route $route,Request $request) {
		$key = $this->makeCacheKey($request->url());

		if(Cache::has($key)) return Cache::get($key);
	}

	public function put(Route $route,Request $request, $response) {
		$key = $this->makeCacheKey($request->url());

		//$expiresAt = Carbon::now()->addMinutes(5);

		if( ! Cache::has($key)) Cache::put($key, $response->getContent(), 5);
	}
	public function makeCacheKey($url) {

		return 'route_' . Str::slug($url);
	}
}
