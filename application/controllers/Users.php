<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CC_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('system_model');
        $this->check_login();

    }

    public function index()
    {
        $data = [
            'users' => $this->system_model->get_users()
        ];

        $this->build('users/index', $data);
    }

    public function create($submit = FALSE)
    {
        if($submit != FALSE)
        {
            return $this->do_register();
        }

        $data = [
            'roles'     => $this->system_model->get_roles_array()
        ];

        $this->build('users/create', $data);
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
            return $this->create();
        }

        // 4. Get the informaiton from the form.
        $email      = $this->input->post('user-email');
        $password   = $this->input->post('user-password');
        $name       = $this->input->post('user-name');
        $surname    = $this->input->post('user-surname');
        $roles      = $this->input->post('user-role');

        // 5. Register the user, if it faiils stop here.
        if (!$this->system->new_user($email, $password, $name, $surname, $roles))
        {
            exit("The user could not be registered. Please go back and try again.");
        }

        // 6. Go back to login.
        redirect('users');
    }
}
