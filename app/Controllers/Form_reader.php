<?php

use App\Controllers\BaseController;

class Form_reader extends BaseController
{
    public function getPOSTinput()
    {
        $form_data = $this->input->post();
        echo $form_data;
    }
}
