<?php

    namespace App\Models;
    use CodeIgniter\Database\ConnectionInterface;

    class paste_new
    {
        function __construct(ConnectionInterface &$db)
        {
            helper('filesystem');
            $this->db = &$db;
            // $db = \Config\Database::connect();
        }

        //CHECK IF GENERATED LINK EXISTS IN DB
        function isNameInDB($link)
        {
            // $sql = "SELECT 1 FROM `pastes` WHERE `link`=`$link`";
            // if ($builder) {
            //     return true;
            // }
            // $query = $this->builder->getWhere('link', $link);
            // $res = $query->getResult();
            $query = $this->db->table('pastes')
                ->where('link = ', $link)
                ->get();
            $res = $query->getResult();
            if (empty($res))
                return false;
            return true;
        }

        //FUNCTION THAT GENERATES A RANDOM STRING (LINK)
        function generateLink()
        {
            $arr = array(
                "assets/adjectives.txt" => 1347,
                "assets/verbs.txt" => 1042,
                "assets/animals.txt" => 520
            );
            //adjective+verb+animal
            $link = "";
            foreach ($arr as $file => $lines)
            {
                // echo "$file " . "$lines" . "\n";
                $line = mt_rand(0, $lines);
                $file = new \SplFileObject("$file");
                $file->seek($line);
                $link .= ucfirst($file->current());
                $link = trim($link);
            }
            $link = str_replace(' ', '', $link);
            // $link = str_replace('\n', '', $link);
            $arr = null;
            $file = null;
            if ($this->isNameInDB($link))
            {
                $this->generateLink();
            }
            return strtolower($link);
        }

        function getLanguage($lang)
        {
            if($lang == 122)
                return false;
            $query = $this->db->query("SELECT `id` FROM `langcodes` WHERE `language`='$lang'");
            $result = $query->getResultArray();
			return intval($result[0]['id']);
        }

        //FUNCTION TO GENERATE SQL QUERY FOR RESPECTIVE DATE
        function getExpiry($expiry)
        {

            switch ($expiry)
            {
                case "m10":
                    $query = $this->db->query("SELECT NOW() + INTERVAL 10 MINUTE");
                    break;
                case "d1":
                    $query = $this->db->query("SELECT NOW() + INTERVAL 1 DAY");
                    break;
                case "w1":
                    $query = $this->db->query("SELECT NOW() + INTERVAL 1 WEEK");
                    break;
                case "w2":
                    $query = $this->db->query("SELECT NOW() + INTERVAL 2 WEEK");
                    break;
                case "m1":
                    $query = $this->db->query("SELECT NOW() + INTERVAL 1 MONTH");
                    break;
                case "m6":
                    $query = $this->db->query("SELECT NOW() + INTERVAL 6 MONTH");
                    break;
                case "1y":
                    $query = $this->db->query("SELECT NOW() + INTERVAL 1 YEAR");
                    break;
                default:
                    return NULL;
                    break;
            }
            return $query->getRow();
        }

        //FUNCTION TO PARSE THE PASTE ON THE SERVER SIDE
        function parsePaste(array $attributes)
        {
            $paste = $attributes['paste_content'];
            $expiry = $attributes['expiry'];
            $language = $attributes['language'];
            $title = empty($attributes['title']) ? NULL : $attributes['title'];
            $password = empty($attributes['password']) ? NULL : password_hash($attributes['password'],  PASSWORD_ARGON2ID);
            $uid = is_null(session()->get('uid')) ? 0 : session()->get('uid');
            $burn = false;
            if($expiry == "bar")
                $burn = true;
            $language = $this->getLanguage($language);
            // $paste = $this->db->real_escape_string($_POST['paste']);
            // $paste = $this->db->real_escape_string($this->input->post);
            if (empty($paste))
                //IF PASTE IS EMPTY
                return view('error');

            else
            {
                $expiry = $this->getExpiry($expiry);
                $link = $this->generateLink();
                //IF PASTE IS NOT EMPTY
                if (strlen($paste) >= 1024)
                {
                    //IF PASTE IS MORE THAN 1KB
                    $paste_ = substr($paste, 1024, strlen($paste));
                    $this->storePaste($uid, $link, substr($paste, 0, 1024), $language, $expiry, $burn, $title, $password, $paste_);
                } 
                else
                    $this->storePaste($uid, $link, substr($paste, 0, 1024), $language, $expiry, $burn, $title, $password, "");
            }
            return $link;
        }

        //SERVER SIDE - WRITING PASTE TO DB
        function storePaste($uid, $link, $paste, $language, $expiry, $burn, $title, $password, $paste_)
        {
            //CHECK IF PASTE IS MORE THAN 1KB, IF SO WRITE EXTRA TO txt FILE
            if (trim($paste_) != "")
            {
                $large = 1;
                if (!write_file(WRITEPATH . '/' . $link . '.txt', $paste_))
                {
                    return view('error');
                }
            }
            $language = false ? 122 : $language;
            $large = isset($large) ? $large : 0;
            //IF EXPIRY IS NULL, $ex BECOMES NULL.
            $ex =  is_null($expiry) ? NULL : $expiry;
            if (!is_null($ex))
            {
                //  CONVERTING stdClass OBJECT TO JSON TO CONVERT TO STRING (HACKY??)
                $ex = json_decode(json_encode($ex), true);
                foreach ($ex as $key => $value)
                {
                    $ex = $value;
                }
            }
            $data = [
                'uid' => $uid,
                'link' => $link,
                'paste' => $paste,
                'langcode' => $language,
                'burn' => $burn,
                'expiry' => $ex,
                'title' => $title,
                'password' => $password,
                'large' => $large
            ];
            $this->db->table('pastes')
                ->insert($data);
        }
    }
