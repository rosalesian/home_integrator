<?php

namespace Utilities;
use Invoice;
use Purchaseorder;
use Returnauthorization;
use Transaction;

class Builder
{
	protected $csv = [];


	/**
	**	BUILD ARRAY FOR POSTING
	**/
	public function buildInvoice($arrayData)
	{
		foreach ($arrayData as $key => $value)
		{
			if($value['principaltype']=='procterandgamble') { //PROCTER AND GAMBLE
				if(! isset($this->csv[$value['externalid']]))	
				{
					$this->csv[$value['externalid']] = $value;
					
					$this->csv[$value['externalid']]['items'][]=[
						// 'item'=>$value['item'],
						'amount'=>$value['amount'],
						'discount'=>$value['discount']
					];
				}
				else
				{
					$this->csv[$value['externalid']]['items'][]=[
						// 'item'=>$value['item'],
						'amount'=>$value['amount'],
						'discount'=>$value['discount']
					];
				}
			} else if($value['principaltype']=='globe') { //GLOBE
				if(! isset($this->csv[$value['externalid']]))	
				{
					$this->csv[$value['externalid']] = $value;
					
					$this->csv[$value['externalid']]['items'][]=[
						'item'=>$value['item'],
						'qty'=>$value['qty'],
						'uom'=>$value['uom'],
						'unit_price'=>$value['unit_price'],
						'discount_amount'=>$value['discount_amount']
					];
				}
				else
				{
					$this->csv[$value['externalid']]['items'][]=[
						'item'=>$value['item'],
						'qty'=>$value['qty'],
						'uom'=>$value['uom'],
						'unit_price'=>$value['unit_price'],
						'discount_amount'=>$value['discount_amount']
					];
				}

			} else { //OTHER PRINCIPALS
				if(! isset($this->csv[$value['externalid']]))	
				{
					$this->csv[$value['externalid']] = $value;
					
					$this->csv[$value['externalid']]['items'][]=[
						'item'=>$value['item'],
						'qty'=>$value['qty'],
						'uom'=>$value['uom'],
						'unit_price'=>$value['unit_price']
						// 'itemString'=>$value['itemString'],
						// 'item_name'=>$value['item_name']
					];
				}
				else
				{
					$this->csv[$value['externalid']]['items'][]=[
						'item'=>$value['item'],
						'qty'=>$value['qty'],
						'uom'=>$value['uom'],
						'unit_price'=>$value['unit_price']
						
						// 'itemString'=>$value['itemString'],
						// 'item_name'=>$value['item_name']
					];
				}
			}	
		}
		return $this->csv;
	}
	public function buildPO($arrayData)
	{
		foreach ($arrayData as $key => $value)
		{
			if($value['principaltype']=='procterandgamble') { //PROCTER AND GAMBLE
				if(! isset($this->csv[$value['externalid']]))	
				{
					$this->csv[$value['externalid']] = $value;
					
					$this->csv[$value['externalid']]['items'][]=[
						'item'=>$value['item'],
						// 'qty'=>$value['qty'],
						'receivinglocation'=>$value['receivinglocation'],
						// 'uom'=>$value['uom'],
						'itemString'=>$value['itemString'],
						'amount'=>$value['amount'],
						'discount'=>$value['discount']
					];
				}
				else
				{
					$this->csv[$value['externalid']]['items'][]=[
						'item'=>$value['item'],
						// 'qty'=>$value['qty'],
						'receivinglocation'=>$value['receivinglocation'],
						// 'uom'=>$value['uom'],
						'itemString'=>$value['itemString'],
						'amount'=>$value['amount'],
						'discount'=>$value['discount']
					];
				}
			} else { //OTHER PRINCIPAL
				
				if(! isset($this->csv[$value['externalid']]))	
				{
					$this->csv[$value['externalid']] = $value;
					
					$this->csv[$value['externalid']]['items'][]=[
						'item'=>$value['item'],
						'itemString'=>$value['itemString'],
						'qty'=>$value['qty'],
						'uom'=>$value['uom'],
						'receivinglocation'=>$value['receivinglocation']
					];
				}
				else
				{
					$this->csv[$value['externalid']]['items'][]=[
						'item'=>$value['item'],
						'itemString'=>$value['itemString'],
						'qty'=>$value['qty'],
						'uom'=>$value['uom'],
						'receivinglocation'=>$value['receivinglocation']
					];
				}

			}

		}
		return $this->csv;
	}
	public function buildIRA($arrayData)
	{
		foreach ($arrayData as $key => $value)
		{
			if($value['principaltype']=='procterandgamble') { //PROCTER AND GAMBLE
				if(! isset($this->csv[$value['externalid']]))	
				{
					$this->csv[$value['externalid']] = $value;
					
					$this->csv[$value['externalid']]['items'][]=[
						'item'=>$value['item'],
						'amount'=>$value['amount'],
						'discount'=>$value['discount'],
						'reason'=>$value['reason']
					];
				}
				else
				{
					$this->csv[$value['externalid']]['items'][]=[
						'item'=>$value['item'],
						'amount'=>$value['amount'],
						'discount'=>$value['discount'],
						'reason'=>$value['reason']
					];
				}
			} else { //OTHER PRINCIPALS
				if(! isset($this->csv[$value['externalid']]))	
				{
					$this->csv[$value['externalid']] = $value;
					
					$this->csv[$value['externalid']]['items'][]=[
						'item'=>$value['item'],
						'qty'=>$value['qty'],
						'uom'=>$value['uom'],
						'unit_price'=>$value['unit_price'],
						'reason'=>$value['reason'],
						'bbd'=>$value['bbd']				
					];
				} else {
					$this->csv[$value['externalid']]['items'][]=[
						'item'=>$value['item'],
						'qty'=>$value['qty'],
						'uom'=>$value['uom'],
						'unit_price'=>$value['unit_price'],
						'reason'=>$value['reason'],
						'bbd'=>$value['bbd']
					];
				}
			}	

		}
		return $this->csv;
	}

	/**
	**	STORE DATA RETURNED AFTER POSTING 
	**/
	public function saveTransaction($responseData, $record_type, $user_id)
	{
		foreach ($responseData as $key => $value)
		{
			$trans = new Transaction();
			$trans->record_internal_id =$value['internalid'];
			$trans->entity = ($record_type=='invoice' OR $record_type=='returnauthorization') ? $value['customer'] : $value['vendor'];
			$trans->record_date = date('Y-m-d', strtotime($value['date']));
			$trans->department = $value['department'];
			$trans->principal = $value['principal'];
			$trans->location = $value['location'];
			$trans->external_id = $value['externalid'];
			$trans->record_type = $record_type;
			$trans->user_id = $user_id;
			$result = $trans->save();
		}
		return $result;
	}
}