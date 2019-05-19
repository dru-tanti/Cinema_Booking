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
            'page'      => $this->router->fetch_method(),
            'nav'       => $this->nav_items()
        ];

        $this->load->view('template/header');
        if($this->system->confirm_session() && $this->system->check_permission('BACKEND_ACCESS'))
        {
            $this->load->view('template/sidebar', $header);
        }

        if($header['section'] == 'home')
        {
            $this->load->view('template/navbar');
        }

		$this->load->view($page, $params);

        $this->load->view('template/footer');
    }

    // TODO: Check for errors to not allow access to backend if user is not logged in.
    // protected function check_login()
    // {
    //     // These two functions will retrieve the controller name ad method the user has accessed.
    //     $class  = $this->router->fetch_class();
    //     $method = $this->router->fetch_method();
    //
    //     $is_logged = $this->system->confirm_session();
    //
    //     if ($is_logged)
    //     {
    //         switch($class)
    //         {
    //             case 'system':
    //                 switch($method)
    //                 {
    //                     case 'register': case'do_register': case 'login': case 'do_login':
    //                     redirect('/');
    //                     break;
    //                 }
    //                 break;
    //
    //             default:
    //                 // If the user doesn't have the permission to view the backend, log them out.
    //                 if(!$this->system->check_permission('BACKEND_ACCESS'))
    //                 {
    //                     $this->session->sess_destroy();
    //                     exit("You do not have permission to access this page");
    //                 }
    //                 break;
    //         }
    //     } else
    //     {
    //         switch($class)
    //         {
    //             case 'system':
    //                 switch($method)
    //                 {
    //                     case 'register': case'do_register': case 'login': case 'do_login':
    //                         break;
    //                     default:
    //                         redirect('login'); break;
    //                 }
    //                 break;
    //             default:
    //                 redirect('login'); break;
    //         }
    //     }
    // }

    // Populates the navigation side bar.
    private function nav_items()
    {
        $nav = [];

        $nav [] = [
            'title'     => 'Home',
            'icon'      => 'fas fa-home',
            'url'       => 'film'
        ];

        $nav [] = [
            'title'     => 'Add Film',
            'icon'      => 'fas fa-plus',
            'url'       => 'film/create'
        ];

        if($this->system->check_permission('VIEW_USERS'))
        {
            $submenu = [];

            $submenu[] = [
                'title'     => 'View Users',
                'icon'      => 'fas fa-user',
                'url'       => 'users'
            ];

            if($this->system->check_permission('MANAGE_USERS'))
            {
                $submenu[] = [
                    'title'     => 'New User',
                    'icon'      => 'fas fa-user-plus',
                    'url'       => 'users/create'
                ];
            }

            $nav[] = [
                'title'         => 'Users',
                'icon'          => 'fas fa-users',
                'submenu'       => $submenu
            ];
        }

        if($this->system->check_permission('VIEW_CINEMAS'))
        {
            $submenu = [];

            $submenu[] = [
                'title'             => 'View Cinemas',
                'icon'              => 'fas fa-eye',
                'url'               => 'cinema'
            ];

            if($this->system->check_permission('ADD_CINEMAS'))
            {
                $submenu[] = [
                    'title'             => 'Add Cinemas',
                    'icon'              => 'fas fa-plus',
                    'url'             => 'cinema/create'
                ];
            }

            $nav[] = [
                'title'         => 'Cinemas',
                'icon'          => 'fas fa-video',
                'submenu'       => $submenu
            ];
        }

        if($this->system->check_permission('VIEW_SCREENINGS'))
        {
            $submenu = [];

            $submenu[] = [
                'title'     => 'View Screenings',
                'icon'      => 'fas fa-eye',
                'url'       => 'screening'
            ];

            if($this->system->check_permission('ADD_SCREENINGS'))
            {
                $submenu[] = [
                    'title'     => 'New Screening',
                    'icon'      => 'fas fa-plus',
                    'url'       => 'screening/create'
                ];
            }

            $nav[] = [
                'title'         => 'Screenings',
                'icon'          => 'fas fa-film',
                'submenu'       => $submenu
            ];
        }

        if($this->system->check_permission('VIEW_BOOKINGS'))
        {
            $submenu = [];

            $submenu[] = [
                'title'     => 'View Bookings',
                'icon'      => 'fas fa-eye',
                'url'       => 'booking'
            ];

            if($this->system->check_permission('MANAGE_BOOKINGS'))
            {
                $submenu[] = [
                    'title'     => 'New Booking',
                    'icon'      => 'fas fa-plus',
                    'url'       => 'booking/create'
                ];
            }

            $nav[] = [
                'title'         => 'Bookings',
                'icon'          => 'fas fa-book',
                'submenu'       => $submenu
            ];
        }

        $nav [] = [
            'title'     => 'Back to Home Page',
            'icon'      => 'fas fa-arrow-left',
            'url'       => 'home'
        ];


        return $nav;
    }
}
