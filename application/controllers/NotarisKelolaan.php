<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotarisKelolaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // is_log_in();
        $this->load->model('ProvinsiModel');
        $this->load->model('KotaModel');
        $this->load->model('WilayahModel');
        $this->load->model('NotarisModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['Notaris'] = $this->NotarisModel->all()->result_array();
        $data['Notaris1'] = $this->NotarisModel->all("where id_wilayah = 1")->result_array();
        $data['Kelolaan1'] = $this->WilayahModel->all("where id = 1")->result();
        $data['Notaris2'] = $this->NotarisModel->all("where id_wilayah = 2")->result_array();
        $data['Kelolaan2'] = $this->WilayahModel->all("where id = 2")->result();
        $data['Notaris3'] = $this->NotarisModel->all("where id_wilayah = 3")->result_array();
        $data['Kelolaan3'] = $this->WilayahModel->all("where id = 3")->result();
        $data['Notaris4'] = $this->NotarisModel->all("where id_wilayah = 4")->result_array();
        $data['Kelolaan4'] = $this->WilayahModel->all("where id = 4")->result();
        $data['Notaris5'] = $this->NotarisModel->all("where id_wilayah = 5")->result_array();
        $data['Kelolaan5'] = $this->WilayahModel->all("where id = 5")->result();
        $data['Notaris6'] = $this->NotarisModel->all("where id_wilayah = 6")->result_array();
        $data['Kelolaan6'] = $this->WilayahModel->all("where id = 6")->result();
        $data['Notaris7'] = $this->NotarisModel->all("where id_wilayah = 7")->result_array();
        $data['Kelolaan7'] = $this->WilayahModel->all("where id = 7")->result();
        $data['Notaris8'] = $this->NotarisModel->all("where id_wilayah = 8")->result_array();
        $data['Kelolaan8'] = $this->WilayahModel->all("where id = 8")->result();
        $data['Notaris9'] = $this->NotarisModel->all("where id_wilayah = 9")->result_array();
        $data['Kelolaan9'] = $this->WilayahModel->all("where id = 9")->result();
        $data['Notaris10'] = $this->NotarisModel->all("where id_wilayah = 10")->result_array();
        $data['Kelolaan10'] = $this->WilayahModel->all("where id = 10")->result();
        $data['Notaris11'] = $this->NotarisModel->all("where id_wilayah = 11")->result_array();
        $data['Kelolaan11'] = $this->WilayahModel->all("where id = 11")->result();
        $data['Notaris12'] = $this->NotarisModel->all("where id_wilayah = 12")->result_array();
        $data['Kelolaan12'] = $this->WilayahModel->all("where id = 12")->result();
        $data['Notaris13'] = $this->NotarisModel->all("where id_wilayah = 13")->result_array();
        $data['Kelolaan13'] = $this->WilayahModel->all("where id = 13")->result();
        $data['Notaris14'] = $this->NotarisModel->all("where id_wilayah = 14")->result_array();
        $data['Kelolaan14'] = $this->WilayahModel->all("where id = 14")->result();
        $data['NotarisDiterima'] = $this->NotarisModel->all("WHERE id_status = 1")->result_array();
        $data['NotarisDitolak'] = $this->NotarisModel->all("WHERE id_status = 2")->result_array();
        $data['title'] = 'Notaris';
        $data['subtitle'] = 'Notaris';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('notaris/index', $data);
        $this->load->view('templates/footer');
    }

    public function kelolaan1($id)
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->NotarisModel->GetPeriode()->result();
        $data['title'] = 'Notaris';
        $data['subtitle'] = 'Notaris';
        $data['idWilayah'] = $id;
        $data['status'] = $this->NotarisModel->GetStatus()->result();
        $data['wilayah'] = $this->NotarisModel->GetWilayah()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('notaris/notarisKelolaan', $data);
        $this->load->view('templates/modal_notaris');
        $this->load->view('templates/footer');
    }

    public function tabel_notaris_kelolaan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $id = $_POST['idWilayah'];

        if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->NotarisModel->getNotaris('WHERE id_wilayah = ' . $id . ' AND dateCreateNotaris LIKE "%' . $_POST['periode'] . '%" ')->result();
            foreach ($get1 as $g1) {

                $id_wilayah = $g1->id_wilayah;
                $id_provinsi = $g1->id_provinsi;
                $id_kota = $g1->id_kota;

                $check1 = $this->NotarisModel->getWilayah("WHERE id = " . $id_wilayah)->result();
                foreach ($check1 as $c1) {
                    $wilayah = $c1->wilayah;
                }

                $check2 = $this->NotarisModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                foreach ($check2 as $c2) {
                    $provinsi = $c2->nama_provinsi;
                }

                $check3 = $this->NotarisModel->getKota("WHERE id = " . $id_kota)->result();
                foreach ($check3 as $c3) {
                    $kota = $c3->nama_kota;
                }

                $id_status = $g1->id_status;
                $check4 = $this->NotarisModel->GetStatus("WHERE id = " . $id_status)->result();
                foreach ($check4 as $c4) {
                    $status = $c4->jenis_status;
                    if ($status == 'Diizinkan') {
                        $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                    } else {
                        $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                    }
                }

                $data[] = array(
                    $no,
                    $g1->nama,
                    $wilayah,
                    $provinsi,
                    $kota,
                    $g1->alamat,
                    $g1->phone,
                    $g1->fax,
                    $g1->ponsel,
                    $g1->klasifikasi,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->NotarisModel->getNotaris($where1)->num_rows(),
                "recordsFiltered" => $this->NotarisModel->getNotaris($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE id_wilayah = " . $id . " AND dateDeleteNotaris = '0000-00-00'";
            $data1 = $this->NotarisModel->getNotaris($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {

                $id_wilayah = $d->id_wilayah;
                $id_provinsi = $d->id_provinsi;
                $id_kota = $d->id_kota;

                $check1 = $this->NotarisModel->getWilayah("WHERE id = " . $id_wilayah)->result();
                foreach ($check1 as $c1) {
                    $wilayah = $c1->wilayah;
                }

                $check2 = $this->NotarisModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                foreach ($check2 as $c2) {
                    $provinsi = $c2->nama_provinsi;
                }

                $check3 = $this->NotarisModel->getKota("WHERE id = " . $id_kota)->result();
                foreach ($check3 as $c3) {
                    $kota = $c3->nama_kota;
                }

                $id_status = $d->id_status;
                $check4 = $this->NotarisModel->GetStatus("WHERE id = " . $id_status)->result();
                foreach ($check4 as $c4) {
                    $status = $c4->jenis_status;
                    if ($status == 'Diizinkan') {
                        $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                    } else {
                        $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                    }
                }

                $data[] = array(
                    $no,
                    $d->nama,
                    $wilayah,
                    $provinsi,
                    $kota,
                    $d->alamat,
                    $d->phone,
                    $d->fax,
                    $d->ponsel,
                    $d->klasifikasi,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->NotarisModel->getNotaris($where)->num_rows(),
                "recordsFiltered" => $this->NotarisModel->getNotaris($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }
}
