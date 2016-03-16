<?php

namespace Utilities\Csv;

class Writer
{
	public function openFile($filename_path)
	{
		return fopen($filename_path, 'w');
	}
	public function write($arrayFile, $filename_path)
	{
		$filedata = $this->openFile($filename_path);
	  	foreach ($arrayFile as $line=>$value)
	 	{
	 	      fputcsv($filedata, $value);
	 	}
	 	$this->closeFile($filedata);
	}
	public function closeFile($filedata)
	{
		return fclose($filedata);
	}
}