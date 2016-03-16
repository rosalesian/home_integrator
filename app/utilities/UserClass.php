<?php

namespace Utilities;
use User;

class UserClass
{
	public function save($data)
	{
		$user = new User();
		$user->name = $data['name'];
		$user->username = $data['username'];
		$user->email = $data['email'];
		$user->password = $data['password'];
		$user->netsuite_password = $data['netsuite_password'];
		$user->netsuite_role = $data['netsuite_role'];
		$user->branch_id = $data['branch'];
		$user->role_id = $data['role'];
		$user->inactive = $data['inactive_status'];
		$user->save();
		return $user->id;
	}
	public function findUser($id)
	{
		return User::find($id);
	}
	public function getAll()
	{
		return User::all();
	}
	public function update($id, $data)
	{
		$user = $this->findUser($id);
		$user->name = $data['name'];
		$user->username = $data['username'];
		$user->email = $data['email'];
		$user->branch_id = $data['branch'];
		$user->role_id = $data['role'];
		$user->netsuite_role = $data['netsuite_role'];
		$user->inactive = $data['inactive_status'];
		$user->save();
		return $user->id;
	}
	public function reset_passord($id, $data)
	{
		$user = $this->findUser($id);
		$user->password = $data['newPass'];
		$user->netsuite_password = $data['netsuite_password'];
		$user->reset_request = 0;
		$user->save();
		return $user->id;
	}
}