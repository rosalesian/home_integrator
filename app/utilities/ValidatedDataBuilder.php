<?php
namespace Utilities;
class ValidatedDataBuilder
{
	protected $csv = [];
	public function buildInvoiceArray($validated_data)
	{
		if($validated_data[0]['principaltype']=='procterandgamble') {
		 	$this->csv = array(
				array(
						'type',
						'principaltype',
						'externalid',
						'customer',
						'date',
						'terms',
						'memo',
						'principal',
						// 'salesrep',
						'location',
						'operation',
						'external_invoice',
						// 'item',
						// 'itemString',
						'amount',
						'discount'
						 )
					);
	 		for($i=0, $counter = count($validated_data); $i<$counter; $i++)
	 		{ 			
				$tmp =array(
				$validated_data[$i]['type'],
				$validated_data[$i]['principaltype'],
		 		$validated_data[$i]['externalid'],
		 		$validated_data[$i]['customer'],
		 		$validated_data[$i]['date'],
		 		$validated_data[$i]['terms'],
		 		$validated_data[$i]['memo'],
		 		$validated_data[$i]['principal'],
		 		// $validated_data[$i]['salesrep'],
		 		$validated_data[$i]['location'],
		 		$validated_data[$i]['operation'],
		 		$validated_data[$i]['external_invoice'],
		 		// $validated_data[$i]['item'],
		 		// $validated_data[$i]['itemString'],
		 		$validated_data[$i]['amount'],
		 		$validated_data[$i]['discount']
		 		);
		 		array_push($this->csv, $tmp);
			}
		} else if($validated_data[0]['principaltype']=='globe') {
			$this->csv = array(
				array(
						'type',
						'principaltype',
						'externalid',
						'customer',
						'date',
						'terms',
						'memo',
						'principal',
						'salesrep',
						'location',
						'operation',
						'external_invoice',
						'item',
						'itemString',
						'qty',
						'uom',
						'unit_price',
						'discount_amount'
						 )
					);
	 		for($i=0, $counter = count($validated_data); $i<$counter; $i++)
	 		{ 			
				$tmp =array(
				$validated_data[$i]['type'],
				$validated_data[$i]['principaltype'],
		 		$validated_data[$i]['externalid'],
		 		$validated_data[$i]['customer'],
		 		$validated_data[$i]['date'],
		 		$validated_data[$i]['terms'],
		 		$validated_data[$i]['memo'],
		 		$validated_data[$i]['principal'],
		 		$validated_data[$i]['salesrep'],
		 		$validated_data[$i]['location'],
		 		$validated_data[$i]['operation'],
		 		$validated_data[$i]['external_invoice'],
		 		$validated_data[$i]['item'],
		 		$validated_data[$i]['itemString'], 		
		 		$validated_data[$i]['qty'],
		 		$validated_data[$i]['uom'],
		 		$validated_data[$i]['unit_price'],
		 		$validated_data[$i]['discount_amount']
		 		);
		 		array_push($this->csv, $tmp);
			}
		} else { //OTHER PRINCIPAL
			$this->csv = array(
				array(
						'type',
						'principaltype',
						'externalid',
						'customer',
						'date',
						'terms',
						'memo',
						'principal',
						'salesrep',
						'location',
						'operation',
						'external_invoice',
						'item',
						'itemString',
						'qty',
						'uom',
						'unit_price'
						 )
					);
	 		for($i=0, $counter = count($validated_data); $i<$counter; $i++)
	 		{ 			
				$tmp =array(
				$validated_data[$i]['type'],
				$validated_data[$i]['principaltype'],
		 		$validated_data[$i]['externalid'],
		 		$validated_data[$i]['customer'],
		 		$validated_data[$i]['date'],
		 		$validated_data[$i]['terms'],
		 		$validated_data[$i]['memo'],
		 		$validated_data[$i]['principal'],
		 		$validated_data[$i]['salesrep'],
		 		$validated_data[$i]['location'],
		 		$validated_data[$i]['operation'],
		 		$validated_data[$i]['external_invoice'],
		 		$validated_data[$i]['item'],
		 		$validated_data[$i]['itemString'], 		
		 		$validated_data[$i]['qty'],
		 		$validated_data[$i]['uom'],
		 		$validated_data[$i]['unit_price']
		 		);
		 		array_push($this->csv, $tmp);
			}
		} //end else
	 	return $this->csv;
	}
	public function buildIRAArray($validated_data)
	{
		if($validated_data[0]['principaltype']=='procterandgamble') {
		 	$this->csv = array(
				array(
						'type',
						'principaltype',
						'externalid',
						'customer',
						'date',
						'memo',
						'principal',
						'salesrep',
						'location',
						'operation',
						'external_invoice',
						'item',
						'itemString',
						'amount',
						'discount',
						'reason'
						// 'qty',
						// 'uom'

						 )
					);
	 		for($i=0, $counter = count($validated_data); $i<$counter; $i++)
	 		{ 			
				$tmp =array(
				$validated_data[$i]['type'],
		 		$validated_data[$i]['principaltype'],
		 		$validated_data[$i]['externalid'],
		 		$validated_data[$i]['customer'],
		 		$validated_data[$i]['date'],
		 		$validated_data[$i]['memo'],
		 		$validated_data[$i]['principal'],
		 		$validated_data[$i]['salesrep'],
		 		$validated_data[$i]['location'],
		 		$validated_data[$i]['operation'],
		 		$validated_data[$i]['external_invoice'],
		 		$validated_data[$i]['item'],
		 		$validated_data[$i]['itemString'],
		 		$validated_data[$i]['amount'],
		 		$validated_data[$i]['discount'],
		 		$validated_data[$i]['reason']
		 		// $validated_data[$i]['qty'],
		 		// $validated_data[$i]['uom']
		 		);
		 		array_push($this->csv, $tmp);
			}
		} else { //OTHER PRINCIPAL
			$this->csv = array(
				array(
						'type',
						'principaltype',
						'externalid',
						'customer',
						'date',
						'memo',
						'principal',
						'salesrep',
						'location',
						'operation',
						'external_invoice',
						'item',
						'itemString',
						'qty',
						'reason',
						'uom',
						'unit_price',
						'bbd'
						 )
					);
	 		for($i=0, $counter = count($validated_data); $i<$counter; $i++)
	 		{ 			
				$tmp =array(
				$validated_data[$i]['type'],
		 		$validated_data[$i]['principaltype'],
		 		$validated_data[$i]['externalid'],
		 		$validated_data[$i]['customer'],
		 		$validated_data[$i]['date'],
		 		$validated_data[$i]['memo'],
		 		$validated_data[$i]['principal'],
		 		$validated_data[$i]['salesrep'],
		 		$validated_data[$i]['location'],
		 		$validated_data[$i]['operation'],
		 		$validated_data[$i]['external_invoice'],
		 		$validated_data[$i]['item'],
		 		$validated_data[$i]['itemString'],
		 		$validated_data[$i]['qty'],
		 		$validated_data[$i]['reason'],
		 		$validated_data[$i]['uom'],
		 		$validated_data[$i]['unit_price'],
		 		$validated_data[$i]['bbd']
		 		);
		 		array_push($this->csv, $tmp);
			}
		}

	 	return $this->csv;
	
	}
	public function buildPOArray($validated_data)
	{
		if($validated_data[0]['principaltype']=='procterandgamble') {
			$this->csv = array(
				array(
						'type',
						'principaltype',
						'externalid',
						'vendor',
						'terms',
						'date',
						'remarks',
						'principal',
						'location',
						'paymenttype',
						'item',
						'itemString',
						'receivinglocation',
						'amount',
						'discount',
						 )
					);
	 		for($i=0, $counter = count($validated_data); $i<$counter; $i++)
	 		{ 			
				$tmp =array(
				$validated_data[$i]['type'],
		 		$validated_data[$i]['principaltype'],
		 		$validated_data[$i]['externalid'],
		 		$validated_data[$i]['vendor'],
		 		$validated_data[$i]['terms'],
		 		$validated_data[$i]['date'],
		 		$validated_data[$i]['remarks'],
		 		$validated_data[$i]['principal'],
		 		$validated_data[$i]['location'],
		 		$validated_data[$i]['paymenttype'],
		 		$validated_data[$i]['item'],
		 		$validated_data[$i]['itemString'],
		 		$validated_data[$i]['receivinglocation'],
		 		$validated_data[$i]['amount'],
		 		$validated_data[$i]['discount'],
		 		);
		 		array_push($this->csv, $tmp);
			}
		} else { // OTHER PRINCIPAL
			$this->csv = array(
				array(
						'type',
						'principaltype',
						'externalid',
						'vendor',
						'terms',
						'date',
						'remarks',
						'principal',
						'location',
						'paymenttype',
						'item',
						'itemString',
						'qty',
						'uom',
						'receivinglocation'
						 )
					);
	 		for($i=0, $counter = count($validated_data); $i<$counter; $i++)
	 		{ 			
				$tmp =array(
				$validated_data[$i]['type'],
		 		$validated_data[$i]['principaltype'],
		 		$validated_data[$i]['externalid'],
		 		$validated_data[$i]['vendor'],
		 		$validated_data[$i]['terms'],
		 		$validated_data[$i]['date'],
		 		$validated_data[$i]['remarks'],
		 		$validated_data[$i]['principal'],
		 		$validated_data[$i]['location'],
		 		$validated_data[$i]['paymenttype'],
		 		$validated_data[$i]['item'],
		 		$validated_data[$i]['itemString'],
		 		$validated_data[$i]['qty'],
		 		$validated_data[$i]['uom'],
		 		$validated_data[$i]['receivinglocation']
		 		);
		 		array_push($this->csv, $tmp);
			}
		}
	 	return $this->csv;
	}
}
