<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Film extends CC_Controller
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
        $this->load->helper('file');
    }

    // Builds the index that shows all the films in the databse.
    public function index()
    {
        $data = [
            'films' => $this->film_model->get_films()
        ];

        $this->build('film/index', $data);
    }

    // Builds the Create Film page.
    public function create($submit = FALSE)
    {
        if($submit != FALSE)
        {
            return $this->_do_create();
        }

        $this->load->library(['user_agent' => 'ua']);

        $data = [
            'categories'        => $this->film_model->get_categories_array(),
            'platform'          => strtolower($this->ua->platform())
        ];

        $this->build('film/create', $data);
    }

    // Process the creation form.
    private function _do_create()
    {
        // 1. Load the form_validation library.
        $this->load->library(['form_validation' => 'fv']);

        // 2. Set the validation rules.
        $this->fv->set_rules([
            [
                'field'	=> 'film-title',
                'label'	=> 'Title',
                'rules' => 'required|min_length[5]'
            ],
            [
                'field'	=> 'film-text',
                'label'	=> 'Content',
                'rules' => 'required|min_length[50]'
            ],
            [
                'field'	=> 'film-image',
                'label' => 'Image',
                'rules' => 'file_required|file_size_max[10mb]|file_allowed_type[gif,png,jpg]'
            ]
        ]);

        // 3. If the validation failed, we'll reload.
        if ($this->fv->run() === FALSE)
        {
            // var_dump(validation_errors()); exit;
            return $this->create();
        }

        // 4. Get the inputs from the form.
        $title		= $this->input->post('film-title');
        $text		= $this->input->post('film-text');
        $runtime    = $this->input->post('film-runtime');
        $release    = $this->input->post('film-release');
        $categories = $this->input->post('film-categories') ?: [];


        $release = strtotime($release);

        // 5. Try to insert the data in its tables, and get back the ID.
        $film_id = $this->film_model->create_film($title, $runtime, $release, $categories);
        if ($film_id === FALSE)
        {
            exit("Your film could not be posted. Please go back and try again.");
        }

        // 6. If the folder path is missing, create it.
        $this->_build_dir($this->text_folder);
        if (!write_file("{$this->text_folder}/{$film_id}.txt", $text))
        {
            // delete the record.
            exit("Your film could not be posted. Please go back and try again.");
        }

        $this->_upload_image($film_id);

        redirect('film');
    }

    // Checks that the folder exists, creates it if not.
    private function _build_dir($dir)
    {
        // we don't need to do anything if the folder exists.
        if (file_exists($dir)) return;

        $segments = explode('/', $dir);
        $path = '';

        while (count($segments) > 0)
        {
            // array_shift -> removes the first element from $segments
            // and returns it as a string.
            $path .= array_shift($segments) . '/';
            if (!file_exists($path)) mkdir($path);
        }
    }

    // Uploads an image to a specific folder using the film id as name.
    private function _upload_image($name)
    {
        // Since we're using this function for the film edit page,
        // we also need to delete the existing files first.
        $files = glob("{$this->images_folder}/{$name}.*");
        foreach ($files as $file) unlink($file);

        // Create the images folder if it doesn't exist.
        $this->_build_dir($this->images_folder);

        // Set up the configuration for this file upload.
        $config['upload_path']			= $this->images_folder;
        $config['file_name']			= $name;
        $config['allowed_types']		= 'gif|jpg|png';
        $config['max_size']				= 10240;
        $config['file_ext_tolower']		= TRUE;

        // Load the upload library and set its configuration.
        $this->load->library('upload');
        $this->upload->initialize($config);

        // Check if the file has uploaded, and show an error if not.
        if (!$this->upload->do_upload('film-image'))
        {
            exit($this->upload->display_errors());
        }
    }

    // Looks for an image with a particular ID and returns the path.
    private function _get_image_path($id, $to_array = FALSE)
    {
        // Use glob to get all the images matching this name.
        $files = glob("{$this->images_folder}/{$id}.*");
        if ($to_array) return $files;

        if (count($files) > 0) return $files[0];
        return '';
    }
}
