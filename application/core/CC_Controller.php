<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
    Core controllers add an extra layer of functionality to CI.
    Functions defined here will be available in all of its children.
*/
class CC_Controller extends CI_Controller
{
    function __construct()
    {
        // parent -> CI_Controller
        // without this line, all the code we need
        // will not be available.
        parent::__construct();
    }

    /*
        We can define function that otherwise don't exist in CI.
        This is a template function to build pages.

        Protected functions are only visible to this class
        and its children.
    */
    protected function build($page = '', $params = [])
    {
        // Define the header data.
        $header = [
            'section'   => $this->router->fetch_class(),
            'page'      => $this->router->fetch_method()
        ];

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $header);

		$this->load->view($page, $params);

        $this->load->view('template/footer');
    }
}
