<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mak extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_log_in();
    }

    public function audit()
    {
        $data['title'] = 'Audit';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mak/index', $data);
        $this->load->view('templates/footer');
    }
}
