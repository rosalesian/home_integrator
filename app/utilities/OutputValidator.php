<?php

namespace Utilities;
use Invoice;
use Purchaseorder;
use Returnauthorization;
use Transaction;

class OutputValidator
{
	public function countTransaction($externalid)
	{
		$queryRecord = Transaction::where('external_id','=',$externalid)->get();
		return $queryRecord->count();
	}
	public function countInvoice($externalid)
	{
		$queryRecord = Invoice::where('external_id','=',$externalid)->get();
		return $queryRecord->count();
	}
	public function countPO($externalid)
	{
		$queryRecord = Purchaseorder::where('external_id','=',$externalid)->get();
		return $queryRecord->count();
	}
	public function countIRA($externalid)
	{
		$queryRecord = Returnauthorization::where('external_id','=',$externalid)->get();
		return $queryRecord->count();
	}
	public function errorCheckerForIRA($responses, $csv)
	{
		$errorIndicator = 0;
	 	//storage of data with error//
	 	$wcsv = array(
						array(
		   						'remarks',
		   						'externalid',
		  						'customer',
		   						'date',
		   						'memo',
		  						'principal',
		  						'location',
		   						'operation',
		   						'external_invoice',
		   						'item',
		   						'quantity',
		   						'reason',
		   						'uom',
		   						'bbd'
		   					 )
		   				);
	 		for($i=0, $counter = count($responses); $i<$counter; $i++)
	 		{
	 			$countRecord=$this->countTransaction($responses[$i]['externalid']);

	 			for ($j=0, $count = count($csv); $j <$count; $j++)
	 			{ 
		 			if($responses[$i]['externalid']==$csv[$j]['externalid'] AND $responses[$i]['itemString']==$csv[$j]['item'])
		 			{
		 				if($countRecord==0 AND !isset($responses[$i]['error']))
						{
							$tmp =array(
					 		'',
					 		$csv[$j]['externalid'],
					 		$csv[$j]['customer'],
					 		$csv[$j]['date'],
					 		$csv[$j]['memo'],
					 		$csv[$j]['principal'],
					 		$csv[$j]['location'],
					 		$csv[$j]['operation'],
					 		$csv[$j]['external_invoice'],
					 		$csv[$j]['item'],
					 		$csv[$j]['quantity'],
					 		$csv[$j]['reason'],
					 		$csv[$j]['uom'],
					 		$csv[$j]['bbd']
					 		);
					 		array_push($wcsv, $tmp);
					 		break;
						}
						else
							{
								$errorIndicator+=1;
								$errorText = '';
								$errorExternalid = '';

								($countRecord==0) ? $errorExternalid ='' : $errorExternalid = $responses[$i]['externalid'].' '.'already used'.'.'; 
								(isset($responses[$i]['error'])) ? $errorText = $responses[$i]['error'] : $errorText = '';

								$tmp =array(
						 		$errorExternalid.' '.$errorText,
						 		$csv[$j]['externalid'],
						 		$csv[$j]['customer'],
						 		$csv[$j]['date'],
						 		$csv[$j]['memo'],
						 		$csv[$j]['principal'],
						 		$csv[$j]['location'],
						 		$csv[$j]['operation'],
						 		$csv[$j]['external_invoice'],
						 		$csv[$j]['item'],
						 		$csv[$j]['quantity'],
						 		$csv[$j]['reason'],
						 		$csv[$j]['uom'],
						 		$csv[$j]['bbd']
						 		);
						 		array_push($wcsv, $tmp);
							}
		 			}
	 			}
	 		}
			return [
				'arrayResult'=>$wcsv,
				'errorIndicator'=>$errorIndicator
			];
	 }
	public function errorCheckerForPO($responses, $csv)
	{
		$errorIndicator = 0;
		if($responses[0]['principaltype']=='procterandgamble'){
			//storage of data with error//
		 	$wcsv = array(
							array(
			   						'remarks',
			   						'externalid',
			  						'vendor',
			   						'terms',
			   						'date',
			   						'remarks',
			  						'principal',
			  						'location',
			   						'paymenttype',
			   						'item',
			   						// 'quantity',
			   						'receivinglocation'
			   						// 'uom'
			   					 )
			   				);
	 		for($i=0, $counter = count($responses); $i<$counter; $i++)
	 		{
	 			$countRecord=$this->countTransaction($responses[$i]['externalid']);

	 			for ($j=0, $count = count($csv); $j <$count; $j++)
	 			{ 
		 			if($responses[$i]['externalid']==$csv[$j]['externalid'] AND $responses[$i]['itemString']==$csv[$j]['item'])
		 			{
		 				if($countRecord==0 AND !isset($responses[$i]['error']))
						{
							$tmp =array(
					 		'',
					 		$csv[$j]['externalid'],
					 		$csv[$j]['vendor'],
					 		$csv[$j]['terms'],
					 		$csv[$j]['date'],
					 		$csv[$j]['remarks'],
					 		$csv[$j]['principal'],
					 		$csv[$j]['location'],
					 		$csv[$j]['paymenttype'],
					 		$csv[$j]['item'],
					 		// $csv[$j]['quantity'],
					 		$csv[$j]['receivinglocation']
					 		// $csv[$j]['uom']
					 		);
					 		array_push($wcsv, $tmp);
					 		break;
						}
						else
							{
								$errorIndicator+=1;
								$errorText = '';
								$errorExternalid = '';

								($countRecord==0) ? $errorExternalid ='' : $errorExternalid = $responses[$i]['externalid'].' '.'already used'.'.'; 
								(isset($responses[$i]['error'])) ? $errorText = $responses[$i]['error'] : $errorText = '';

								$tmp =array(
						 		$errorExternalid.' '.$errorText,
						 		$csv[$j]['externalid'],
						 		$csv[$j]['vendor'],
						 		$csv[$j]['terms'],
						 		$csv[$j]['date'],
					 			$csv[$j]['remarks'],
						 		$csv[$j]['principal'],
						 		$csv[$j]['location'],
						 		$csv[$j]['paymenttype'],
						 		$csv[$j]['item'],
						 		// $csv[$j]['quantity'],
						 		$csv[$j]['receivinglocation']
						 		// $csv[$j]['uom']
						 		);
						 		array_push($wcsv, $tmp);
							}
		 			}
	 			}
	 		}
		} else { // ELSE
		 	//storage of data with error//
		 	$wcsv = array(
							array(
			   						'remarks',
			   						'externalid',
			  						'vendor',
			   						'terms',
			   						'date',
			   						'remarks',
			  						'principal',
			  						'location',
			   						'paymenttype',
			   						'item',
			   						'quantity',
			   						'receivinglocation',
			   						'uom'
			   					 )
			   				);
		 		for($i=0, $counter = count($responses); $i<$counter; $i++)
		 		{
		 			$countRecord=$this->countTransaction($responses[$i]['externalid']);

		 			for ($j=0, $count = count($csv); $j <$count; $j++)
		 			{ 
			 			if($responses[$i]['externalid']==$csv[$j]['externalid'] AND $responses[$i]['itemString']==$csv[$j]['item'])
			 			{
			 				if($countRecord==0 AND !isset($responses[$i]['error']))
							{
								$tmp =array(
						 		'',
						 		$csv[$j]['externalid'],
						 		$csv[$j]['vendor'],
						 		$csv[$j]['terms'],
						 		$csv[$j]['date'],
						 		$csv[$j]['remarks'],
						 		$csv[$j]['principal'],
						 		$csv[$j]['location'],
						 		$csv[$j]['paymenttype'],
						 		$csv[$j]['item'],
						 		$csv[$j]['quantity'],
						 		$csv[$j]['receivinglocation'],
						 		$csv[$j]['uom']
						 		);
						 		array_push($wcsv, $tmp);
						 		break;
							}
							else
								{
									$errorIndicator+=1;
									$errorText = '';
									$errorExternalid = '';

									($countRecord==0) ? $errorExternalid ='' : $errorExternalid = $responses[$i]['externalid'].' '.'already used'.'.'; 
									(isset($responses[$i]['error'])) ? $errorText = $responses[$i]['error'] : $errorText = '';

									$tmp =array(
							 		$errorExternalid.' '.$errorText,
							 		$csv[$j]['externalid'],
							 		$csv[$j]['vendor'],
							 		$csv[$j]['terms'],
							 		$csv[$j]['date'],
						 			$csv[$j]['remarks'],
							 		$csv[$j]['principal'],
							 		$csv[$j]['location'],
							 		$csv[$j]['paymenttype'],
							 		$csv[$j]['item'],
							 		$csv[$j]['quantity'],
							 		$csv[$j]['receivinglocation'],
							 		$csv[$j]['uom']
							 		);
							 		array_push($wcsv, $tmp);
								}
			 			}
		 			}
		 		}

		}// end else
		return [
			'arrayResult'=>$wcsv,
			'errorIndicator'=>$errorIndicator
		];
	 }
	 public function errorCheckerForInvoice($responses, $csv)
	 {
	 	$errorIndicator = 0;
	 	//storage of data with error//
	 	if($responses[0]['principaltype']=='procterandgamble'){
	 		$wcsv = array(
						array(
		   						'remarks',
		   						'externalid',
		  						'customer',
		   						'date',
		   						'terms',
		   						'memo',
		  						'principal',
		  						'location',
		   						'operation',
		   						'external_invoice',
		   						// 'item',
		   						'amount',
		   						'discount'
		   					 )
		   				);
	 		for($i=0, $counter = count($responses); $i<$counter; $i++)
	 		{
	 			$countRecord=$this->countTransaction($responses[$i]['externalid']);
	 			
	 			for ($j=0, $count = count($csv); $j <$count; $j++)
	 			{ 
		 			if($responses[$i]['externalid']==$csv[$j]['externalid']) //AND $responses[$i]['itemString']==$csv[$j]['item'])
		 			{
		 				if($countRecord==0 AND !isset($responses[$i]['error']))
						{
							$tmp =array(
					 		'',
					 		$csv[$j]['externalid'],
					 		$csv[$j]['customer'],
					 		$csv[$j]['date'],
					 		$csv[$j]['terms'],
					 		$csv[$j]['memo'],
					 		$csv[$j]['principal'],
					 		$csv[$j]['location'],
					 		$csv[$j]['operation'],
					 		$csv[$j]['external_invoice'],
					 		// $csv[$j]['item'],
					 		$csv[$j]['amount'],
					 		$csv[$j]['discount']
					 		);
					 		array_push($wcsv, $tmp);
					 		break;
						} else {
							$errorIndicator+=1;
							$errorText = '';
							$errorExternalid = '';

							($countRecord==0) ? $errorExternalid ='' : $errorExternalid = $responses[$i]['externalid'].' '.'already used'.'.'; 
							(isset($responses[$i]['error'])) ? $errorText = $responses[$i]['error'] : $errorText = '';

							$tmp =array(
					 		$errorExternalid.' '.$errorText,
					 		$csv[$j]['externalid'],
					 		$csv[$j]['customer'],
					 		$csv[$j]['date'],
					 		$csv[$j]['terms'],
					 		$csv[$j]['memo'],
					 		$csv[$j]['principal'],
					 		$csv[$j]['location'],
					 		$csv[$j]['operation'],
					 		$csv[$j]['external_invoice'],
					 		// $csv[$j]['item'],
				 			$csv[$j]['amount'],
				 			$csv[$j]['discount']
					 		);
					 		array_push($wcsv, $tmp);
						}
		 			}
	 			}
	 		}
	 	} else if($responses[0]['principaltype']=='globe') {
	 			$wcsv = array(
						array(
		   						'remarks',
		   						'externalid',
		  						'customer',
		   						'date',
		   						'terms',
		   						'memo',
		  						'principal',
		  						'location',
		   						'operation',
		   						'external_invoice',
		   						'item',
		   						'quantity',
		   						'uom',
		   						'discount_amount'
		   					 )
		   				);
	 		for($i=0, $counter = count($responses); $i<$counter; $i++)
	 		{
	 			//$countRecord=$this->countInvoice($responses[$i]['externalid']);
	 			$countRecord=$this->countTransaction($responses[$i]['externalid']);
	 			
	 			for ($j=0, $count = count($csv); $j <$count; $j++)
	 			{ 
		 			if($responses[$i]['externalid']==$csv[$j]['externalid'] AND $responses[$i]['itemString']==$csv[$j]['item'])
		 			{
		 				if($countRecord==0 AND !isset($responses[$i]['error']))
						{
							$tmp =array(
					 		'',
					 		$csv[$j]['externalid'],
					 		$csv[$j]['customer'],
					 		$csv[$j]['date'],
					 		$csv[$j]['terms'],
					 		$csv[$j]['memo'],
					 		$csv[$j]['principal'],
					 		$csv[$j]['location'],
					 		$csv[$j]['operation'],
					 		$csv[$j]['external_invoice'],
					 		$csv[$j]['item'],
					 		$csv[$j]['quantity'],
					 		$csv[$j]['uom'],
					 		$csv[$j]['discount_amount']
					 		);
					 		array_push($wcsv, $tmp);
					 		break;
						}
						else {
								$errorIndicator+=1;
								$errorText = '';
								$errorExternalid = '';

								($countRecord==0) ? $errorExternalid ='' : $errorExternalid = $responses[$i]['externalid'].' '.'already used'.'.'; 
								(isset($responses[$i]['error'])) ? $errorText = $responses[$i]['error'] : $errorText = '';

								$tmp =array(
						 		$errorExternalid.' '.$errorText,
						 		$csv[$j]['externalid'],
						 		$csv[$j]['customer'],
						 		$csv[$j]['date'],
						 		$csv[$j]['terms'],
					 			$csv[$j]['memo'],
						 		$csv[$j]['principal'],
						 		$csv[$j]['location'],
						 		$csv[$j]['operation'],
						 		$csv[$j]['external_invoice'],
						 		$csv[$j]['item'],
						 		$csv[$j]['quantity'],
					 			$csv[$j]['uom'],
					 			$csv[$j]['discount_amount']
						 		);
						 		array_push($wcsv, $tmp);
							}
		 			}
	 			}
	 		}
	 	} else {
	 		$wcsv = array(
						array(
		   						'remarks',
		   						'externalid',
		  						'customer',
		   						'date',
		   						'terms',
		   						'memo',
		  						'principal',
		  						'location',
		   						'operation',
		   						'external_invoice',
		   						'item',
		   						'quantity',
		   						'uom'
		   					 )
		   				);
	 		for($i=0, $counter = count($responses); $i<$counter; $i++)
	 		{
	 			//$countRecord=$this->countInvoice($responses[$i]['externalid']);
	 			$countRecord=$this->countTransaction($responses[$i]['externalid']);
	 			
	 			for ($j=0, $count = count($csv); $j <$count; $j++)
	 			{ 
		 			if($responses[$i]['externalid']==$csv[$j]['externalid'] AND $responses[$i]['itemString']==$csv[$j]['item'])
		 			{
		 				if($countRecord==0 AND !isset($responses[$i]['error']))
						{
							$tmp =array(
					 		'',
					 		$csv[$j]['externalid'],
					 		$csv[$j]['customer'],
					 		$csv[$j]['date'],
					 		$csv[$j]['terms'],
					 		$csv[$j]['memo'],
					 		$csv[$j]['principal'],
					 		$csv[$j]['location'],
					 		$csv[$j]['operation'],
					 		$csv[$j]['external_invoice'],
					 		$csv[$j]['item'],
					 		$csv[$j]['quantity'],
					 		$csv[$j]['uom']
					 		);
					 		array_push($wcsv, $tmp);
					 		break;
						}
						else
							{
								$errorIndicator+=1;
								$errorText = '';
								$errorExternalid = '';

								($countRecord==0) ? $errorExternalid ='' : $errorExternalid = $responses[$i]['externalid'].' '.'already used'.'.'; 
								(isset($responses[$i]['error'])) ? $errorText = $responses[$i]['error'] : $errorText = '';

								$tmp =array(
						 		$errorExternalid.' '.$errorText,
						 		$csv[$j]['externalid'],
						 		$csv[$j]['customer'],
						 		$csv[$j]['date'],
						 		$csv[$j]['terms'],
					 			$csv[$j]['memo'],
						 		$csv[$j]['principal'],
						 		$csv[$j]['location'],
						 		$csv[$j]['operation'],
						 		$csv[$j]['external_invoice'],
						 		$csv[$j]['item'],
						 		$csv[$j]['quantity'],
					 			$csv[$j]['uom']
						 		);
						 		array_push($wcsv, $tmp);
							}
		 			}
	 			}
	 		}
	 	}//end else
			return [
				'arrayResult'=>$wcsv,
				'errorIndicator'=>$errorIndicator
			];
	 }
}