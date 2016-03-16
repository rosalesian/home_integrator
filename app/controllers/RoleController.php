<?php

class RoleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('role.index',array('roles'=>Role::all()))
					->with('title','Roles')
					->with('activeLink','system_manager');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('role.create')
				->with('title','Create New Role')
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
			'rolename'=>'required|unique:roles,rolename'
			);
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else
		{
			$role = new Role();
			$role->rolename = Input::get('rolename');
			$role->inactive = 0;
			$role->save();

			return Redirect::to('role/'.$role->role_id);
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
		return View::make('role.show',array('role'=>Role::find($id)))
					->with('title','View Role')
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
		return View::make('role.edit',array('role'=>Role::find($id)))
					->with('title','Edit Role')
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
		$rules = array(
			'rolename'=>'required'
			);
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else
		{
			(Input::get('inactive_status')=='on') ? $status = 1 : $status = 0;
			$role = Role::find($id);
			$role->rolename = Input::get('rolename');
			$role->inactive = $status;
			$role->save();
			return Redirect::to('role/'.$id)->with('message','Role Successfully Updated');
		}
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


}
