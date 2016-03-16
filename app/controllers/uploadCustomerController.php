<?php
	set_time_limit(600);
class UploadCustomerController extends BaseController
{

	public function viewCustomerUpload()
	{
		//DB::table('customers')->delete();
		return View::make('uploadCustomerView')->with('title','Upload Customer');
	}
	public function open($filename_path)
	{
   		  $target = $filename_path;
		  $handle = fopen($target, 'r');

		  $headers = fgetcsv($handle, 1024, ',');

		  $csv = array();

		  while ($row = fgetcsv($handle, 1024, ","))
		  {
		      $csv[] = array_combine($headers, $row);
		  }
		  return $csv;
		  fclose($handle);
	}
	public function post_upload()
	{
		if(Input::hasFile('uploadCustomerCSVFile'))
		{
			$file_extension = Input::file('uploadCustomerCSVFile')->getClientOriginalExtension();
			$validated_file_flag = 0; // 0 for No more error in the csv //
			if($file_extension=='csv')
			{
				$filename_path = Input::file('uploadCustomerCSVFile')->move(public_path().'/csv','customer.csv');
				$csv = $this->open($filename_path);
				//$this->insert_customers($csv);
				$remarks='';
				$tempCSV = array(
							array('remarks','internalid','companyname')
					);

					foreach ($csv as $key => $value) 
					{
						$query = Customer::where('netsuite_internal_id','=',$value['internalid']);
						$count = $query->count();
						
						if($count==0)
						{
							$remarks='';
							$tmp = array(
								$remarks,
								$value['internalid'],
								$value['companyname']
								);
							array_push($tempCSV, $tmp);
						}
						else
						{
							$validated_file_flag += 1;
							$remarks = $value['internalid'].' already exist';
							$tmp = array(
								$remarks,
								$value['internalid'],
								$value['companyname']
								);
							array_push($tempCSV, $tmp);
						}
					}
					if($validated_file_flag==0)
					{
						$this->insert_customers($csv);
					  	File::delete($filename_path);
					  	$validateUpload = 'success';
					  	$data = array('validateUpload'=>$validateUpload);
						return Response::json($data);					  	
						// return Redirect::to('validation/customers')->with('success','Customers Uploaded Successfully');
					}
					else
					{
						$this->write_file($tempCSV, $filename_path);
						$validateUpload = 'failed';
						$data = array('validateUpload'=>$validateUpload);
						return Response::json($data);
						//return Redirect::to('validation/customers')->with('fail','Error Customer Upload');
					}
			}
			else
			{
				return Redirect::to('validation/customers')->with('message','Invalid file');
			}
		}
		else
		{
			return Redirect::to('validation/customers')->with('message','No file selected');
		}
	}
	public function write_file($csvfile, $filename_path)
	{
		//$filename_path = $tempPath.'\\'.'result.csv';
		$size = File::size($filename_path);
		$file = fopen($filename_path,'w');
		foreach ($csvfile as $line=>$value)
		  {
		  	 fputcsv($file,$value);	
 		  }

		fclose($file);
	}
	public function insert_customers($csvData)
	{
		foreach ($csvData as $key => $value)
		{
			$insert_stmt = DB::getPdo()->prepare('INSERT INTO customers(netsuite_internal_id, customer_name) VALUES(?, ?)');
			$insert_stmt->execute([ $value['internalid'], $value['companyname'] ]);
		}
	}
		public function get_download()
	{
		$filename_path = public_path().'/csv/'.'customer.csv';
		return Response::download($filename_path,'customers.csv',['content-type'=>'text/csv']);
	}
}
?>