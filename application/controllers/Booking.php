<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CC_Controller
{
   function __construct()
   {
     parent::__construct();

     $this->load->model('booking_model');
   }

   public function index()
   {
      $data = [
         'bookings' => $this->booking_model->get_bookings()
      ];

      $this->build('booking/index', $data);
   }
}
