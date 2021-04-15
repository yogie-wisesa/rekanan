<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // is_log_in();
        $this->load->model('ProvinsiModel');
        $this->load->model('KotaModel');
        $this->load->model('AjModel');
        $this->load->model('AkModel');
        $this->load->model('BlsModel');
        $this->load->model('KapModel');
        $this->load->model('KjppModel');
        $this->load->model('MiModel');
        $this->load->model('NotarisModel');
        $this->load->model('MbModel');
        $this->load->model('PsModel');
        $this->load->model('KonsultanModel');
    }

    public function index()
    {
        $data['kapPerusahaan'] = $this->KapModel->all("WHERE id_statusPerusahaan <> 3")->result_array();
        $data['Aj'] = $this->AjModel->all("WHERE id_status <> 3")->result_array();
        $data['Ak'] = $this->AkModel->all("WHERE id_status <> 3")->result_array();
        $data['blsPerusahaan'] = $this->BlsModel->all("WHERE id_status <> 3")->result_array();
        $data['kjppPerusahaan'] = $this->KjppModel->all("WHERE id_status <> 3")->result_array();
        $data['Mi'] = $this->MiModel->all("WHERE id_status <> 3")->result_array();
        $data['Mb'] = $this->MbModel->all("WHERE id_status <> 3")->result_array();
        $data['Notaris'] = $this->NotarisModel->all("WHERE id_status <> 3")->result_array();
        $data['Ps'] = $this->PsModel->all("WHERE id_status <> 3")->result_array();
        $data['Konsultan'] = $this->KonsultanModel->all("WHERE id_status <> 3")->result_array();
        $data['title'] = 'Dashboard';
        $data['subtitle'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}
