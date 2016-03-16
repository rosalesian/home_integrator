<?php

class BranchController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('branch.index',array('branches'=>Branch::all()))
					->with('title','BranchController')
					->with('activeLink','system_manager');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('branch.create')
					->with('title','Create New Branch')
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
			'branchname'=>'required|unique:roles,rolename'
			);
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else
		{
			$branch = new Branch();
			$branch->branchname = Input::get('branchname');
			$branch->inactive = 0;
			$branch->save();
			return Redirect::to('branch/'.$branch->branch_id);
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
		return View::make('branch.show',array('branch'=>Branch::find($id)))
					->with('title','View Branch')
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
		return View::make('branch.edit',array('branch'=>Branch::find($id)))
					->with('title','Edit Branch')
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
			'branchname'=>'required'
			);
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else
		{
			(Input::get('inactive_status')=='on') ? $status = 1 : $status = 0;
			$branch = Branch::find($id);
			$branch->branchname = Input::get('branchname');
			$branch->inactive = $status;
			$branch->save();
			return Redirect::to('branch/'.$id)->with('message','Branch Successfully Updated');
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
