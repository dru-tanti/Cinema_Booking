<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CC_Controller
{
    // This is the folder path all text will upload to.
	var $text_folder = 'uploads/films/text';

	// This is the folder path all text will upload to.
	var $images_folder = 'uploads/films/images';

    // The class constructer will be needed here.
    function __construct()
    {
        parent::__construct();

        $this->load->model('film_model');
        $this->load->model('screening_model');
        $this->load->helper('file');
    }

    // Builds the index that shows all the films in the databse.
    public function index()
    {
        $data = [
            'films'         => $this->film_model->now_showing(),
            'coming_soon'   => $this->film_model->coming_soon()
        ];

        $this->build('home/index', $data);
    }

    public function film_view($slug = '')
    {
        $data = [
            'film'          => $this->film_model->get_film($slug),
            'screenings'    => $this->screening_model->get_film_screenings($slug)
        ];

        $this->build('home/film_view', $data);
    }

    public function booking()
    {
      $data = [
         'seats' => 200
      ];

        $this->build('home/booking', $data);
    }

    // Looks for an image with a particular ID and returns the path.
    public function _get_image_path($id)
    {
        // Use glob to get all the images matching this name.
        $files = glob("{$this->images_folder}/{$id}.*");

        //if ($to_array) return $files;
        if (count($files) > 0) return $files[0];
        return '';

        var_dump($files);
    }

}
