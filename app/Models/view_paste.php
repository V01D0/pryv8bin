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
			/*CHECK IF A PASTE IS LARGER THAN 1KB*/
			$query = $this->db->query("SELECT `large` FROM `pastes` WHERE `link`='$link'");
			$result = $query->getResultArray();
			if($result[0]['large'] == 1)
				return true;
			return false;
		}

		public function isBurn($link)
		{
			/*CHECK IF A LINK HAS BURN AFTER READ*/
			$query = $this->db->query("SELECT `burn` FROM `pastes` WHERE `link`='$link'");
			$result = $query->getResultArray();
			if($result[0]['burn'] == 1)
				return true;
			return false;
		}

		public function hasPassword($link)
		{
			/*CHECK IF A CERTAIN LINK HAS PASSWORD*/
			$query = $this->db->query("SELECT `password` FROM `pastes` WHERE `link`='$link' AND `password` IS NOT NULL");
			if($query->getNumRows() <= 0)
				return false;
			return true;
		}

		public function verifyPassword($link, $password)
		{
			/*CHECK IF PASSWORD MATCHES FOR A GIVEN LINK*/
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
			/*GET PASTE CONTENT (FIRST 1024 CHARS) FOR A CERTAIN PASTE*/
			$query = $this->db->query("SELECT `paste` FROM `pastes` WHERE `link`='$link'");
			if($query->getNumRows() <= 0)
				return false;
			$result = $query->getResultArray();
			return $result[0]['paste'];
		}

		public function getTitle($link)
		{
			/*GET THE TITLE FOR A CERTAIN PASTE*/
			$query = $this->db->query("SELECT `title` FROM `pastes` WHERE `link`='$link'");
			if($query->getNumRows() <= 0)
				return false;
			$result = $query->getResultArray();
			return $result[0]['title'];
		}

		public function getViews($link)
		{
			/*GET NUMBER OF VIEWS FOR A CERTAIN PASTE*/
			$query = $this->db->query("SELECT `views` FROM `pastes` WHERE `link`='$link'");
			$result = $query->getResultArray();
			return $result[0]['views'];
		}

		public function updateViews($link)
		{
			/*INCREMENT THE VIEWS OF A PASTE BY 1*/
			$sql = "UPDATE `pastes` SET `views`=views+1 WHERE link='$link'";
			if($this->db->query($sql))
				return true;
			return false;
		}

		public function getAuthor($link)
		{
			/*GET THE AUTHOR OF THE PASTE*/
			$query = $this->db->query("SELECT `uid` FROM `pastes` WHERE `link`='$link'");
			$result = $query->getResultArray();
			if($result[0]['uid'] == 0)
				return "Anonymous";
			$query = $this->db->query("SELECT `username` FROM `auth` WHERE `uid`=$result[0]['uid']");
			$result = $query->getResultArray();
			return $result[0]['username'];
		}

		public function burnLink($link)
		{
			/*NUKE THE PASTE*/
			if($this->isBurn($link))
			{
				if($this->isLarge($link))
					unlink(WRITEPATH . '/' . $link . '.txt');
				$query = $this->db->query("DELETE FROM `pastes` WHERE `link`='$link'");
				return true;
			}
			return false;
		}

		public function getLang($link)
		{
			$query = $this->db->query("SELECT `langcode` FROM `pastes` WHERE `link`='$link'");
			$result = $query->getResultArray();
			if($result[0]['langcode'] == 122)
				return false;
			$langcode = intval($result[0]['langcode']);
			$query = $this->db->query("SELECT `language` FROM `langcodes` WHERE `id`=$langcode");
			$result = $query->getResultArray();
			return $result[0]['language'];
		} 
	}
