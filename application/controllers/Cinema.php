<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cinema extends CC_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('cinema_model');

        $this->check_login();
    }

    public function index()
    {
        $data = [
            'cinemas' => $this->cinema_model->get_cinemas()
        ];

        $this->build('film/index', $data);
    }
}
