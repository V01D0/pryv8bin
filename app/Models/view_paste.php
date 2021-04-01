<?php

    namespace App\Models;
    use CodeIgniter\Database\ConnectionInterface;

	class view_paste
	{
		function __construct(ConnectionInterface &$db)
        {
            $this->db = &$db;
        }

		public function isLarge($link)
		{
			$query = $this->db->query("SELECT `large` FROM `pastes` WHERE `link`='$link'");
			$result = $query->getResultArray();
			if($result[0]['large'] == 1)
				return true;
			return false;
		}

		public function hasPassword($link)
		{
			$query = $this->db->query("SELECT `password` FROM `pastes` WHERE `link`='$link' AND `password` IS NOT NULL");
			if($query->getNumRows() <= 0)
				return false;
			return true;
		}

		public function verifyPassword($link, $password)
		{
			$query = $this->db->query("SELECT `password` FROM `pastes` WHERE `link`='$link'");
			if($query->getNumRows() <= 0)
				return false;
			$result = $query->getResultArray();
			if(password_verify($password, $result[0]['password']))
				return true;
			return false;
		}

		public function getPaste($link)
		{
			$query = $this->db->query("SELECT `paste` FROM `pastes` WHERE `link`='$link'");
			if($query->getNumRows() <= 0)
				return false;
			$result = $query->getResultArray();
			return $result[0]['paste'];
		}

		public function getTitle($link)
		{
			$query = $this->db->query("SELECT `title` FROM `pastes` WHERE `link`='$link'");
			if($query->getNumRows() <= 0)
				return false;
			$result = $query->getResultArray();
			return $result[0]['title'];
		}


	}
