<?php 

namespace Utilities\Csv;

class Reader
{

	public function openFile($filename_path)
	{
		return fopen($filename_path, 'r');
	}
	public function getHeader($filedata)
	{
		return fgetcsv($filedata, 1024, ',');
		
	}
	public function fetch($filename_path)
	{
		$csv = array();
		$filedata = $this->openFile($filename_path);
		$header = $this->getHeader($filedata);
		if($this->validateHeader($header))
		{
			return ['error'=>'error'];
		}
		else
		{
			array_push($header, 'type');
			array_push($header, 'principaltype');
		  	while ($row = fgetcsv($filedata, 1024, ","))
		 	{
		 			array_push($row, \Input::get('type'));
		 			array_push($row, \Input::get('principal'));
		 	      $csv[] = array_combine($header, $row);
		 	}
		 	$this->closeFile($filedata);
		 	return $csv;
		}
	}
	public function closeFile($filedata)
	{
		return fclose($filedata);
	}
	public function validateHeader($header) 
	{
		if(\Input::get('principal')=='procterandgamble') { 
			/** PROCTER AND GAMBLE **/

			if(\Input::get('type')=='invoice') $data = array('externalid','customer','date','terms','memo','principal','location','operation','external_invoice','amount','discount');

		} else if(\Input::get('principal')=='globe') { 
			/** GLOBE **/
			
			if(\Input::get('type')=='invoice') $data = array('externalid','customer','date','terms','memo','principal','location','operation','external_invoice','item','quantity','uom','discount_amount');
		
		} else { 
			/** MONDELEZ **/

			if(\Input::get('type')=='invoice') $data = array('externalid','customer','date','terms','memo','principal','location','operation','external_invoice','item','quantity','uom');
			if(\Input::get('type')=='purchaseorder') $data = array('externalid','vendor','terms','date','remarks','principal','location','paymenttype','receivinglocation','item','quantity','uom');
			if(\Input::get('type')=='returnauthorization') $data = array('externalid','customer','date','memo','principal','location','operation','external_invoice','item','quantity','reason','uom','bbd');
		
		}
		
		/**
		**	Check if both header data are correct and the same
		**/
		$result1 = array_diff($header, $data);
		$result2 = array_diff($data, $header);
		if(count($result1)==0 AND count($result2)==0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	public function readValidatedData($filename_path)
	{
		$data = [];
		$filedata = $this->openFile($filename_path);
		$header = $this->getHeader($filedata);
		while ($row = fgetcsv($filedata, 1024, ","))
	 	{
	 	      $data[] = array_combine($header, $row);
	 	}
	 	$this->closeFile($filedata);
	 	return $data;
	}
}