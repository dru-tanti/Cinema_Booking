<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends CC_Controller
{
    // The class constructer will be needed here.
    function __construct()
    {
        parent::__construct();
    }

    function login()
    {
        $this->load->view('template/header');
        $this->load->view('system/login');
        $this->load->view('template/footer');
    }

    function do_login()
    {
        // 1. Load the form validation library.
        $this->load->library(['form_validation' => 'fv']);

        // 2. Set the validation rules.
        $this->fv->set_rules([
            [
                'field'     => 'user-email',
                'label'     => 'Email',
                'rules'     => 'required|valid_email'
            ],
            [
                'field'     => 'user-password',
                'label'     => 'Password',
                'rules'     => 'required'
            ]
        ]);
        // 3. Check that the validation clearded, if not show the errors.
        if($this->fv->run() === FALSE)
        {
            return $this->login();
        }

        // 4. Retrieve the information from the form.
        $email          = $this->input->post('user-email');
        $password       = $this->input->post('user-password');

        // 5. If the account is locked, show an error.
        $is_locked = $this->system->is_locked($email);
        if($is_locked !== FALSE)
        {
            exit ("Your account is locked, please try again on " . date('d M Y, H:i', $is_locked) . ".");
        }

        // 6. If the user's credentials are incorrect, show an error.
        $data = $this->system->login($email, $password);
        if($data === FALSE)
        {
            exit("Your login details are incorrect.");
        }

        // 7. Keep this information in thhe sesion and redirect to the homepage.
        $this->session->set_userdata($data);
        redirect('/');
    }

    function register()
    {
        $this->load->view('template/header');
        $this->load->view('system/register');
        $this->load->view('template/footer');
    }

    function do_register()
    {
        // 1. Load the form validation library.
        $this->load->library(['form_validation' => 'fv']);

        // 2. Set the validation rules.
        $this->fv->set_rules([
            [
                'field'     => 'user-email',
                'label'     => 'Email',
                'rules'     => 'required|valid_email|is_unique[tbl_users.email]'
            ],
            [
                'field'     => 'user-password',
                'label'     => 'Password',
                'rules'     => 'required|min_length[8]'
            ],
            [
                'field'     => 'user-conf-password',
                'label'     => 'Confirm Password',
                'rules'     => 'required|matches[user-password]'
            ],
            [
                'field'     => 'user-name',
                'label'     => 'Name',
                'rules'     => 'required|alpha_spaces'
            ],
            [
                'field'     => 'user-surname',
                'label'     => 'Surname',
                'rules'     => 'required|alpha_spaces'
            ]
        ]);

        // 3. If the form doesn't validate reload the page.
        if ($this->fv->run() === FALSE)
        {
            return $this->register();
        }

        // 4. Get the informaiton from the form.
        $email      = $this->input->post('user-email');
        $password   = $this->input->post('user-password');
        $name       = $this->input->post('user-name');
        $surname    = $this->input->post('user-surname');

        // 5. Register the user, if it faiils stop here.
        if (!$this->system->new_user($email, $password, $name, $surname))
        {
            exit("The user could not be registered. Please go back and try again.");
        }

        // 6. Go back to login.
        redirect('login');
    }
}
