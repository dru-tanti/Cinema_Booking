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

        //$this->check_login();
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
            'page'      => $this->router->fetch_method(),
            'nav'       => $this->nav_items()
        ];

        $this->load->view('template/header');
        //$this->load->view('template/navbar');
        $this->load->view('template/sidebar', $header);

		$this->load->view($page, $params);

        $this->load->view('template/footer');
    }

    protected function check_login()
    {
        // These two functions will retrieve the controller name ad method the user has accessed.
        $class  = $this->router->fetch_class();
        $method = $this->router->fetch_method();

        $is_logged = $this->system->confirm_session();

        if ($is_logged)
        {
            switch($class)
            {
                case 'system':
                    switch($method)
                    {
                        case 'register': case'do_register': case 'login': case 'do_login':
                        redirect('/');
                        break;
                    }
                    break;

                default:
                    // If the user doesn't have the permission to view the backend, log them out.
                    if(!$this->system->check_permission('BACKEND_ACCESS'))
                    {
                        $this->session->sess_destroy();
                        exit("You do not have permission to access this page");
                    }
                    break;
            }
        } else
        {
            switch($class)
            {
                case 'system':
                    switch($method)
                    {
                        case 'register': case'do_register': case 'login': case 'do_login':
                            break;
                        default:
                            redirect('login'); break;
                    }
                    break;
                default:
                    redirect('login'); break;
            }
        }
    }

    // Populates the navigation side bar.
    private function nav_items()
    {
        $nav = [];

        $nav [] = [
            'title'     => 'Home',
            'icon'      => 'fas fa-home',
            'url'       => '/'
        ];

        $nav [] = [
            'title'     => 'Add Film',
            'icon'      => 'fas fa-plus',
            'url'       => 'film/create'
        ];

        if($this->system->check_permission('MANAGE_USERS'))
        {
            $submenu = [];

            $submenu[] = [
                'title'     => 'New User',
                'icon'      => 'fas fa-user-plus',
                'url'       => 'users/create'
            ];

            if($this->system->check_permission('ASSIGN_PERMISSIONS'))
            {
                $submenu[] = [
                    'title'     => 'Assign Permissions',
                    'icon'      => 'fas fa-user-tag',
                    'url'       => 'users/permissions'
                ];
            }

            $nav[] = [
                'title'         => 'Users',
                'icon'          => 'fas fa-users',
                'submenu'       => $submenu
            ];
        }

        return $nav;
    }
}
