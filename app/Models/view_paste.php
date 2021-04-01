<?php

    namespace App\Models;
    use CodeIgniter\Database\ConnectionInterface;

	class view_paste
	{
		function __construct(ConnectionInterface &$db)
        {
            $this->db = &$db;
        }

		public function getPaste($link)
		{
			$query = $this->db->query("SELECT `paste` FROM `pastes` WHERE `link`='$link'");
			if($query->getNumRows() <= 0)
				return false;
			$result = $query->getResultArray();
			return $result[0]['paste'];
		}

		public function isLarge($link)
		{
			$query = $this->db->query("SELECT `large` FROM `pastes` WHERE `link`='$link'");
			$result = $query->getResultArray();
			if($result[0]['large'] === 1)
				return true;
			return false;
		}
	}
