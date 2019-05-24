<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CC_Controller
{
   function __construct()
   {
     parent::__construct();

     $this->load->model('booking_model');
     $this->load->model('cinema_model');
     $this->load->model('screening_model');

     $this->check_login();

   }

   public function index()
   {
        $data = [
            'bookings' => $this->booking_model->get_bookings(),
        ];

      $this->build('booking/index', $data);
   }

   public function create($id = NULL, $submit = FALSE)
   {
        if(!$screening = $this->screening_model->get_screening($id))
        {
            show_404();
        }

        $cinema = $this->cinema_model->get_cinema_capacity($screening['cinema_id']);

        if($submit != FALSE)
        {
            return $this->_do_create();
        }

        $data = [
            'cinema'        => $cinema,
            'screening'     => $screening
        ];
       $this->build('booking/create', $data);
   	}

    public function _do_create()
    {
        // 1. Load the form_validation library.
        $this->load->library(['form_validation' => 'fv']);

        // 2. Set the validation rules.
        $this->fv->set_rules([
            [
                'field'     => 'booking-email',
                'label'     => 'email',
                'rules'     => 'required|valid_email'
            ]
        ]);

        // 3. If the validation failed, we'll reload.
        if($this->fv->run() === FALSE)
        {
            return $this->create();
        }

        // 4. Get the inputs from the form.
        $screening = $this->input->post('booking-screening');
        $seats = $this->input->post('booking-seat');
        $email = $this->input->post('booking-email');

        // 5. Try to insert the data in its tables, and get back the ID.
        $booking_id = $this->booking_model->create_booking($screening, $seats, $email);
        if($booking_id === FALSE)
        {
            exit("Booking could not be created. Please try again later");
        }

        redirect('booking');
    }
}
