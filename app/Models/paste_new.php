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
        protected function isNameInDB($link)
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
        protected function generateLink()
        {
            $arr = array(
                "assets/adjectives.txt" => 1347,
                "assets/verbs.txt" => 1042,
                "assets/animals.txt" => 520
            );
            //adjective+verb+animal
            $link = "";
            foreach ($arr as $file => $lines) {
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
            if ($this->isNameInDB($link)) {
                $this->generateLink();
            }
            return $link;
        }

        //FUNCTION TO GENERATE SQL QUERY FOR RESPECTIVE DATE
        public function getExpiry($expiry)
        {

            switch ($expiry) {
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
        public function parsePaste(array $attributes)
        {
            $paste = $attributes['paste_content'];
            $expiry = $attributes['expiry'];
            $title = empty($attributes['title']) ? NULL : $attributes['title'];
            $password = empty($attributes['password']) ? NULL : password_hash($attributes['password'],  PASSWORD_ARGON2ID);
            // $paste = $this->db->real_escape_string($_POST['paste']);
            // $paste = $this->db->real_escape_string($this->input->post);
            if (empty($paste)) {
                //IF PASTE IS EMPTY
                return view('error');
            } else {
                $expiry = $this->getExpiry($expiry);
                //IF PASTE IS NOT EMPTY
                if (strlen($paste) >= 1024) {
                    //IF PASTE IS MORE THAN 1KB
                    $paste_ = substr($paste, 1024, strlen($paste));
                    $this->storePaste(0, $this->generateLink(), substr($paste, 1024, 1024), $expiry, $title, $password, $paste_);
                } else
                    return $this->storePaste(0, $this->generateLink(), substr($paste, 0, 1024), $expiry, $title, $password, "");
            }
        }

        //SERVER SIDE - WRITING PASTE TO DB
        public function storePaste($uid, $link, $paste, $expiry, $title, $password, $paste_)
        {
            //CHECK IF PASTE IS MORE THAN 1KB, IF SO WRITE EXTRA TO txt FILE
            if (trim($paste_) != "") {
                if (!write_file(WRITEPATH . '/' . $link . '.txt', $paste_)) {
                    return view('error');
                }
            }
            //IF EXPIRY IS NULL, $ex BECOMES NULL.
            $ex =  is_null($expiry) ? NULL : $expiry;
            if (!is_null($ex)) {
                //  CONVERTING stdClass OBJECT TO JSON TO CONVERT TO STRING (HACKY??)
                $ex = json_decode(json_encode($ex), true);
                foreach ($ex as $key => $value) {
                    $ex = $value;
                }
            }
            $data = [
                'uid' => $uid,
                'link' => $link,
                'paste' => $paste,
                'expiry' => $ex,
                'title' => $title,
                'password' => $password
            ];
            // $this->db->table->set('expiry', $expiry, false);
            $this->db->table('pastes')
                ->insert($data);
            // } else {
            //     $this->db->table->set('expiry', "NOW()", FALSE);
            // }
            // $sql = "INSERT INTO `pastes` VALUES ($uid, $link, $paste, $expiry, $title, $password)";
        }
    }
