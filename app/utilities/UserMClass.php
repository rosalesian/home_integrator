<?php

namespace Utilities;
use User;

class User
{
	function __construct()
	{
		$this->user = new User();
	}
	public function save($data)
	{
		$this->user->name = $data['name'];
		$this->user->username = $data['username'];
		$this->user->email = $data['email'];
		$this->user->password = $data['password'];
		$this->user->branch = $data['branch'];
		$this->user->role = $data['role'];
		$this->user->inactive = $data['inactive_status'];
		$userid = $this->user->save();
		return $userid;
	}
}