<?php

namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;

class _api
{
	function __construct(ConnectionInterface &$db)
	{
		$this->db = &$db;
	}

	public function generateKey($data)
	{
		assert(strlen($data) == 16);
	
		$data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
		$data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
	
		return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
	}

	public function insertKey($key, $email)
	{
		$builder = $this->db->table('auth');
		$data = ['key'=> $key];
		$builder->where('email', $email);
		$builder->update($data);
	}
}
