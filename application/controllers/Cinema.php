<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cinema extends CC_Controller
{
   function __construct()
   {
     parent::__construct();
     $this->load->model('cinema_model');

   }

   public function index()
   {
     $data = [
         'cinemas' => $this->cinema_model->get_cinemas()
     ];

     $this->build('cinema/index', $data);
   }

   public function create($submit = FALSE)
   {
   if($submit != FALSE)
   {
      return $this->_do_create();
   }

   $this->build('cinema/create');
   }

   public function delete($id = NULL)
   {
      if(!$cinema = $this->cinema_model->get_cinema($id))
      {
         show_404();
      }

      $this->cinema_model->delete_cinema($id);
      redirect('cinema');
   }

   public function edit($id = NULL, $submit = FALSE)
   {
      // Check if the cinema exists, if it does, assignt it to a variable.
      if(!$cinema = $this->cinema_model->get_cinema($id))
      {
         show_404();
      }

      // Checks that the form was sent.
      if($submit !== FALSE)
      {
         return $this->_do_edit($cinema);
      }

      $data = [
         'cinema' => $cinema
      ];

      $this->build('cinema/edit', $data);
   }

   private function _do_create()
   {
      // 1. Load form validation library.
      $this->load->library(['form_validation' => 'fv']);

      // 2. Set the validation rules.
      $this->fv->set_rules([
         [
            'field'     => 'cinema-name',
            'label'     => 'Name',
            'rules'     => 'required|min_length[3]'
         ],
         [
            'field'     => 'cinema-capacity',
            'label'     => 'Capacity',
            'rules'     => 'required'
         ]
      ]);

      // 3. If validation failed, reload the page.
      if($this->fv->run() === FALSE)
      {
         return $this->create();
      }

      // 4. Get the inputs from the form.
      $name       = $this->input->post('cinema-name');
      $capacity   = $this->input->post('cinema-capacity');

      // 5. Insert the data in the table and retrieve the ID.
      $cinema_id = $this->cinema_model->create_cinema($name, $capacity);
      if($cinema_id === FALSE)
      {
         exit("The cinema could not be created. Please try again.");
      }

      redirect('cinema');
   }

   private function _do_edit()
   {
      // 1. Load form validation library.
      $this->load->library(['form_validation' => 'fv']);

      // 2. Set the validation rules.
      $rule = [
         [
            'field'     => 'cinema-name',
            'label'     => 'Name',
            'rules'     => 'required|min_length[3]'
         ],
         [
            'field'     => 'cinema-capacity',
            'label'     => 'Capacity',
            'rules'     => 'required'
         ]
      ];

      // 3. If the calidation fialed, releat the page.
      if($this->fv->run() === FALSE)
      {
         return $this->edit($cinema['id']);
      }

      // 4. Get the inputs from the form.
      $name       = $this->input->post('cinema-name');
      $capacity   = $this->input->post('cinema-capacity');

      // 5. Check if anything changed.
      if($cinema['name'] != $name || $cinema['capacity'] != $capacity)
      {
         if (!$this->cinema_model->update_cinema($cinema['id'], $title, $capacity))
         {
            exit("The cinema could not be updated");
         }
      }
   }
}
