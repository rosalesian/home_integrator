<?php

class fileTemplateController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('file_templates.index',array('templates'=>Filetemplate::all()))
					->with('title','File Templates')
					->with('activeLink','system_manager');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('file_templates.create')
					->with('title','Create New Template')
					->with('activeLink','system_manager');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(),['filename'=>'required']);
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else
		{
			if(Input::get('headerData'))
			{
				$headers = json_decode(Input::get('headerData'));
				$filename = Input::get('filename');

				$list = [];
				for ($j=0, $counter = count($headers); $j < $counter; $j++) { 
					array_push($list,$headers[$j]->headername);
				}
				
				$filedata = fopen(public_path().'/templates/'.$filename.'.csv','w');	
				fputcsv($filedata, $list);
				fclose($filedata);

				$files = new Filetemplate();
				$files->filename = $filename;
				$files->file_path = public_path().'/templates/'.$filename.'.csv';
				$files->inactive = 0;
				$files->save();
				return Redirect::to('filetemplate/'.$files->template_id);

			} else {
				return Redirect::back()->with('headersMessage','Input atleast one header');
			}
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
		$files = Filetemplate::find($id);
		$filedata = fopen($files->file_path,'r');
		$headers = fgetcsv($filedata, 1024, ',');
		fclose($filedata);

		return View::make('file_templates.show',array('files'=>$files, 'headers'=>$headers))
					->with('title','View Template')
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
		$files = Filetemplate::find($id);
		$filedata = fopen($files->file_path,'r');
		$headers = fgetcsv($filedata, 1024, ',');
		fclose($filedata);
		
		return View::make('file_templates.edit', array('files'=>$files, 'headers'=>$headers))
					->with('title','Create New Template')
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
		$validator = Validator::make(Input::all(),['filename'=>'required']);
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else
		{
			if(count(json_decode(Input::get('headerData')))>0)
			{
				$headers = json_decode(Input::get('headerData'));
				$filename = Input::get('filename');
				
				$files = Filetemplate::find($id);
				unlink($files->file_path);

				$filedata = fopen(public_path().'/templates/'.$filename.'.csv','w');	
				fputcsv($filedata, $headers);
				fclose($filedata);

				(Input::get('inactive_status')=='on') ? $status = 1 : $status = 0;
				$files->filename = $filename;
				$files->file_path = public_path().'/templates/'.$filename.'.csv';
				$files->inactive = $status;
				$files->save();

				return Redirect::to('filetemplate/'.$files->template_id);
			} else {
				return Redirect::back()->with('headersMessage','Input atleast one header');
			}
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
