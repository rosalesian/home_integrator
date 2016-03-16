<?php

class DownloadController extends BaseController
{	
	public function get_download()
	{
		$filename_path = public_path().'/csv/result-'.Session::get('principal').'-'.Auth::user()->id.'.csv';
		return Response::download($filename_path,'results.csv',['content-type'=>'text/csv']);
	}
	public function downloadInvoiceTemplate()
	{
		return Response::download(public_path().'/templates/invoice_template.csv','invoice.csv',['content-type'=>'text/csv']);
	}
	public function downloadPOTemplate()
	{
		return Response::download(public_path().'/templates/purchaseorder_template.csv','purchaseorder.csv',['content-type'=>'text/csv']);
	}
	public function downloadIRATemplate()
	{
		return Response::download(public_path().'/templates/returnauthorization_template.csv','returnauthorization.csv',['content-type'=>'text/csv']);
	}
}