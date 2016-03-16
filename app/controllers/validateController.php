<?php

use Utilities\Csv\Reader;
use Utilities\Csv\Writer;
use Utilities\PoolRequest;
use Utilities\Builder;
use Utilities\OutputValidator;
use Utilities\ValidatedDataBuilder;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\ErrorEvent;

set_time_limit(1000);

class ValidateController extends BaseController
{	
	protected $reader;
	protected $pool;
	protected $outputValidator;
	protected $builder;
	protected $writer;
	protected $csv = [];

	public function __construct()
	{
		$this->builder = new Builder();
		$this->reader = new Reader();
		$this->pool = new PoolRequest();
		$this->outputValidator = new OutputValidator();
		$this->writer = new Writer();
		$this->validateddatabuilder = new ValidatedDataBuilder();
	}
	
	public function viewInvoice() {
		$invoices = Transaction::orderBy('transaction_id', 'DESC')->where('record_type','invoice')->paginate(15);
		return View::make('transactions.invoice', compact('invoices'))->with('title','Invoices')->with('activeLink','log');
	}

	public function viewPO() {
		$purchaseorders = Transaction::orderBy('transaction_id', 'DESC')->where('record_type','purchaseorder')->paginate(15);
		return View::make('transactions.purchaseorder', compact('purchaseorders'))->with('title','Purchase Orders')->with('activeLink','log');
	}
	
	public function viewIRA() {
		$returnauthorizations = Transaction::orderBy('transaction_id', 'DESC')->where('record_type','returnauthorization')->paginate(15);		
		return View::make('transactions.returnauthorization', compact('returnauthorizations'))->with('title','Return Authorizations')->with('activeLink','log');
	}
	
	public function deleteTransaction($id, $recordtype) {
		$record = Transaction::find($id);
		$record->delete();

		if($recordtype=='invoice') {
			return Redirect::to('validation/invoices');
		} else if($recordtype=='purchaseorder') {
			return Redirect::to('validation/purchaseorders');
		} else {
			return Redirect::to('validation/returnauthorizations');
		}

	}

	public function searchLogByValuePO()
	{
		$val = Input::get('val');
		$htmlOutput ='';
		$transRecord = Transaction::where('record_type','purchaseorder')->searchTransaction($val)->get();
			if(count($transRecord)!=0)
			{
				foreach ($transRecord as $value)
				{
					$htmlOutput.= '<tr>';

					if(Auth::user()->role[0]->rolename=='Administrator'){
						$htmlOutput.= '<td style="text-align:center; width: 90px;"><a style="color:#c11313;" href="delete/'.$value->transaction_id.'/'.$value->record_type.'">Delete</a> | <a href="'.Config::get('netsuite.purchaseorder').$value->record_internal_id.'">view</a></td>';
					} else {
						$htmlOutput.= '<td style="text-align:center; width: 90px;"><a href="'.Config::get('netsuite.purchaseorder').$value->record_internal_id.'">view</a></td>';
					}

					$htmlOutput.= '<td style="text-align:center;">'.$value->external_id.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->record_internal_id.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->entity.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->department.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->principal.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->location.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.date('m-d-Y', strtotime($value->record_date)).'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->user->name.'</td>';
					$htmlOutput.= '</tr>';
				}
				$status='success';
			}
			else
			{
				$status='fail';
			}
		 $data = array('searchResult'=>$htmlOutput,'status'=>$status);
		 return Response::json($data);
	}
	public function searchLogByValueIRA()
	{
		$value = Input::get('val');
		$htmlOutput ='';
		$transRecord = Transaction::where('record_type','returnauthorization')->searchTransaction($val)->get();	

			if(count($transRecord)!=0)
			{
				foreach ($transRecord as $value)
				{
					$htmlOutput.= '<tr>';

					if(Auth::user()->role[0]->rolename=='Administrator'){
						$htmlOutput.= '<td style="text-align:center; width: 90px;"><a style="color:#c11313;" href="delete/'.$value->transaction_id.'/'.$value->record_type.'">Delete</a> | <a href="'.Config::get('netsuite.returnauthorization').$value->record_internal_id.'">view</a></td>';
					} else {
						$htmlOutput.= '<td style="text-align:center; width: 90px;"><a href="'.Config::get('netsuite.returnauthorization').$value->record_internal_id.'">view</a></td>';
					}

					$htmlOutput.= '<td style="text-align:center;">'.$value->external_id.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->record_internal_id.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->entity.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->department.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->principal.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->location.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.date('m-d-Y', strtotime($value->record_date)).'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->user->name.'</td>';
					$htmlOutput.= '</tr>';
				}
				$status='success';
			}
			else
			{
				$status='fail';
			}
		 $data = array('searchResult'=>$htmlOutput,'status'=>$status);
		 return Response::json($data);
	}
	public function searchLogByValueInvoice()
	{
		$val = Input::get('val');
		$htmlOutput ='';
		$transRecord = Transaction::where('record_type','invoice')->searchTransaction($val)->get();
			if(count($transRecord)!=0)
			{
				foreach ($transRecord as $value)
				{
					$htmlOutput.= '<tr>';
					
					if(Auth::user()->role[0]->rolename=='Administrator'){
						$htmlOutput.= '<td style="text-align:center; width: 90px;"><a style="color:#c11313;" href="delete/'.$value->transaction_id.'/'.$value->record_type.'">Delete</a> | <a href="'.Config::get('netsuite.invoice').$value->record_internal_id.'">view</a></td>';
					} else {
						$htmlOutput.= '<td style="text-align:center; width: 90px;"><a href="'.Config::get('netsuite.invoice').$value->record_internal_id.'">view</a></td>';
					}

					$htmlOutput.= '<td style="text-align:center;">'.$value->external_id.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->record_internal_id.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->entity.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->department.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->principal.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->location.'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.date('m-d-Y', strtotime($value->record_date)).'</td>';
					$htmlOutput.= '<td style="text-align:center;">'.$value->user->name.'</td>';
					$htmlOutput.= '</tr>';
				}
				$status='success';
			}
			else
			{
				$status='fail';
			}
		 $data = array('searchResult'=>$htmlOutput,'status'=>$status);
		 return Response::json($data);
	}
	public function get_index()
	{	
		return View::make('validateView')->with('title','Upload View')->with('activeLink','home');
	}
	public function post_validate()
	{
		$filename_path = Input::file('csvFile')->move(public_path().'/csv','rawData-'.\Input::get('principal').'-'.Auth::user()->id.'.csv');
		$data = $this->reader->fetch($filename_path);

		Session::put('principal', \Input::get('principal')); // use in concatinating error result to avoid error.

		if(isset($data['error']))
		{
			$error = ['status'=>$data['error']];
			return Response::json($error);
		}
		else
		{
			$postresponse=[];
			$counter=0;
			$output=[];
			
			/** VALIDATE DATA **/
			$responses = $this->pool->get($data);

			// dd($responses);

			/** CHECKING GET RESPONSE FOR ERRORS **/
			if($responses[0]['type']=='invoice') $output = $this->outputValidator->errorCheckerForInvoice($responses,$data);
			if($responses[0]['type']=='purchaseorder') $output = $this->outputValidator->errorCheckerForPO($responses,$data);
			if($responses[0]['type']=='returnauthorization') $output = $this->outputValidator->errorCheckerForIRA($responses,$data);
			
			if($output['errorIndicator']==0)
			{
				/** STRUCTURE VALIDATED DATA**/
				if($responses[0]['type']=='invoice') $validated_data = $this->validateddatabuilder->buildInvoiceArray($responses);
				if($responses[0]['type']=='purchaseorder') $validated_data = $this->validateddatabuilder->buildPOArray($responses);
				if($responses[0]['type']=='returnauthorization') $validated_data = $this->validateddatabuilder->buildIRAArray($responses);

				// dd($validated_data);

				$counter = Validateddata::all()->max('id')+1;
				$validateddata = new Validateddata();
				$validateddata->id = $counter;
				$validateddata->filename = 'validated_data_'.$counter.'.csv';
				$validateddata->save();

				/** REMOVE CSV FILE **/
				// File::delete(public_path().'/csv/validated_data.csv');
				$filename = 'validated_data_'.$validateddata->id;
				/** WRITE VALIDATED DATA IN THE CSV **/
				$this->writer->write($validated_data,public_path().'/csv/'.$filename.'.csv');
				return Response::json(['validateRecord'=>'pass','validated_data'=>$responses,'filename'=>$filename]);
			} else {
				/** REMOVE CSV FILE **/
			  	File::delete(public_path().'/csv/result-'.\Input::get('principal').'-'.Auth::user()->id.'.csv');

			  	/** WRITE CSV FILE  **/
			  	$this->writer->write($output['arrayResult'],public_path().'/csv/result-'.\Input::get('principal').'-'.Auth::user()->id.'.csv');
			  	return Response::json(['validateRecord'=>'fail']);
			}  
		}
	}
	public function post_upload()
	{
		$filename = Input::get('filename');
		$filename_path = public_path().'/csv/'.$filename.'.csv';
		$data = $this->reader->readValidatedData($filename_path);
		
		/** RESTRUCTURING VALIDATED DATA FOR POSTING **/
		if($data[0]['type']=='invoice') $this->csv = $this->builder->buildInvoice($data);
		if($data[0]['type']=='purchaseorder') $this->csv = $this->builder->buildPO($data);
		if($data[0]['type']=='returnauthorization') $this->csv = $this->builder->buildIRA($data);
		/***************************************/

		// dd($this->csv);

		/** POSTING DATA **/
		$postresponse = $this->pool->post($this->csv);
		/******************/

		// dd($postresponse);
		
		if($postresponse!=NULL)
		{	
			/** STORING DATA RETURNED AFTER POSTING **/
			$result = $this->builder->saveTransaction($postresponse, $data[0]['type'], Auth::user()->id);
			if($result)
			{
				/** REMOVE CSV FILE **/
				File::delete(public_path().'/csv/rawData-'.Session::get('principal').'-'.Auth::user()->id.'.csv');

				/** REMOVE VALIDATED DATA STORED IN THE DATABASE **/
				$fileid = explode('_',$filename);
				Validateddata::find($fileid[2])->delete();

				/** REMOVE TEMPORARY STORAGE OF VALIDATED DATA **/
				File::delete(public_path().'/csv/'.$filename.'.csv');
				return Response::json(['status'=>'success']);

			}	
		}
	}	
}