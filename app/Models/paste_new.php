<?php

namespace App\Models;

use CodeIgniter\Model;

class paste extends Model
{
    function __construct()
    {
        helper('filesystem');
        $db = \Config\Database::connect();
        $this->builder = $db->table('pastes');
    }

    //CHECK IF LINK EXISTS IN DB
    protected function isNameInDB($link)
    {
        // $sql = "SELECT 1 FROM `pastes` WHERE `link`=`$link`";
        // if ($builder) {
        //     return true;
        // }
        $query = $this->builder->getWhere('link', $link);
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
        $link = "";
        foreach ($arr as $file => $lines) {
            // echo "$file " . "$lines" . "\n";
            $line = mt_rand(1, $lines);
            $file = new \SplFileObject("$file");
            $file->seek($line);
            $link .= $file->current();
            $link = trim($link);
        }
        $link = str_replace(' ', '', $link);
        //adjective+verb+animal
        // $link = str_replace('\n', '', $link);
        $arr = null;
        $file = null;
        if ($this->isNameInDB($link)) {
            $this->generateLink();
        }
        return $link;
    }

    //FUNCTION TO PARSE THE PASTE ON THE SERVER SIDE
    protected function parsePaste($expiry, $title, $password)
    {
        // $paste = $this->db->real_escape_string($_POST['paste']);
        // $paste = $this->db->real_escape_string($this->input->post);
        $paste = "";
        if (empty($paste)) {
            //IF PASTE IS EMPTY
            $msg = _("Please enter a non empty string!");
        } else {
            //IF PASTE IS NOT EMPTY
            if (strlen($paste) >= 1024) {
                //IF PASTE IS MORE THAN 1KB
                $paste_ = substr($paste, 1024, strlen($paste));
                $this->storePaste($_SESSION['uid'], $this->generateLink(), substr($paste, 1024, 1024), $expiry, $title, $password, $paste_);
            } else
                $this->storePaste($_SESSION['uid'], $this->generateLink(), substr($paste, 0, 1024), $expiry, $title, $password, "");
        }
    }

    //SERVER SIDE - WRITING PASTE TO DB
    protected function storePaste($uid, $link, $paste, $expiry, $title, $password, $paste_)
    {
        if (trim($paste_) != "") {
            if (!write_file(WRITEPATH . '/' . $link . '.txt', $paste_)) {
                return view('error');
            }
        }
        $data = [
            'uid' => $uid,
            'link' => $link,
            'paste' => $paste,
            'expiry' => $expiry,
            'title' => $title,
            'password', $password
        ];
        // $sql = "INSERT INTO `pastes` VALUES ($uid, $link, $paste, $expiry, $title, $password)";
        $this->builder->insert($data);
        header("Location: $link");
    }
}
