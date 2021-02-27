<?php
class paste
{
    function __construct()
    {
        $db = \Config\Database::connect();
        $this->db = $db;
    }

    //CHECK IF LINK EXISTS IN DB
    protected function isNameInDB($link)
    {
        $sql = "SELECT 1 FROM `pastes` WHERE `link`=`$link`";
        if ($this->db->query($sql) >= 1) {
            return true;
        }
        return false;
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
            $file = new SplFileObject("$file");
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
        $paste = $this->db->real_escape_string($this->input->post);
        if (empty($paste)) {
            //IF PASTE IS EMPTY
            $msg = _("Please enter a non empty string!");
        } else {
            //IF PASTE IS NOT EMPTY
            if (strlen($paste) >= 1024) {
                //IF PASTE IS MORE THAN 1KB
                $paste_ = substr($paste, 1024, strlen($paste));
                $this->storePaste($_SESSION['uid'], $this->generateLink(), substr($paste, 1024, 1024), $expiry, $title, $password);
            } else
                $this->storePaste($_SESSION['uid'], $this->generateLink(), substr($paste, 0, 1024), $expiry, $title, $password);
        }
    }

    //SERVER SIDE - WRITING PASTE TO DB
    protected function storePaste($uid, $link, $paste, $expiry, $title, $password)
    {
        $sql = "INSERT INTO `pastes` VALUES ($uid, $link, $paste, $expiry, $title, $password)";
        if ($this->db->query($sql) == True) {
            header("Location: $link");
        }
    }
}
