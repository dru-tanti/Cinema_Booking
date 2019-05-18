<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Screening extends CC_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('screening_model');
    }

    public function index()
    {
        $data = [
            'screenings'    => $this->screening_model->get_screenings()
        ];

        $this->build('screening/index', $data);
    }

    public function create($submit = FALSE)
    {
        if($submit != FALSE)
        {
            return $this->do_create();
        }

        $data = [
            'films'     => $this->film_model->get_films(),
            'cinemas'   => $this->cinema_model->get_cinemas()
        ];

        $this->build('screening/create', $data);
    }

    //TODO: Add Edit and Delete functionality

    private function do_create()
    {
        // 1. Load the form_validation library.
        $this->load->library(['form_validation' => 'fv']);

        // 2. Set the validation rules.
        $this->fv->set_rules([
            [
                'field'	=> 'screening-time',
                'label'	=> 'Time',
                'rules' => 'required'
            ],
            [
                'field'	=> 'screening-film',
                'label'	=> 'Film',
                'rules' => 'required'
            ],
            [
                'field'	=> 'screening-cinema',
                'label' => 'Cinema',
                'rules' => 'required'
            ]
        ]);

        // 3. If the validation failed, we'll reload.
        if ($this->fv->run() === FALSE)
        {
            // var_dump(validation_errors()); exit;
            return $this->create();
        }

        // 4. Get the inputs from the form.
        $time		= $this->input->post('screening-time');
        $film	    = $this->input->post('screening-film');
        $cinema     = $this->input->post('screening-cinema');

        // 5. Try to insert the data in its tables, and get back the ID.
        $screening_id = $this->screening_model->create_screening($time, $film, $cinema);
        if ($screening_id === FALSE)
        {
            exit("The new screening could not be created. Please go back and try again.");
        }

        redirect('screening');
    }

}
