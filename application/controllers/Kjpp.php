<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kjpp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // is_log_in();
        $this->load->model('ProvinsiModel');
        $this->load->model('KotaModel');
        $this->load->model('KjppModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['totalPenilai'] = $this->KjppModel->penilai()->result_array();
        $data['kjppPerusahaan'] = $this->KjppModel->all("WHERE id_status <> 3")->result_array();
        $data['kjppDitolak'] = $this->KjppModel->all("WHERE id_status= 2")->result_array();
        $data['kjppDiizinkan'] = $this->KjppModel->all("WHERE id_status= 1")->result_array();
        $data['kjppTerbatas'] = $this->KjppModel->all("WHERE id_status= 4")->result_array();
        $data['title'] = 'Kjpp';
        $data['subtitle'] = 'KJPP';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kjpp/index', $data);
        $this->load->view('templates/footer');
    }

    public function kjppPerusahaan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->KjppModel->GetPeriode()->result();
        $data['title'] = 'Kjpp';
        $data['subtitle'] = 'KJPP';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kjpp/kjppView', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_objek_kjpp', $data);
        $this->load->view('templates/modal_sektor_kjpp', $data);
    }

    public function dapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->KjppModel->GetPeriode()->result();
        $data['title'] = 'Kjpp';
        $data['subtitle'] = 'KJPP';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kjpp/kjppDapatDigunakanView', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_objek_kjpp', $data);
        $this->load->view('templates/modal_sektor_kjpp', $data);
    }

    public function tidakDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->KjppModel->GetPeriode()->result();
        $data['title'] = 'Kjpp';
        $data['subtitle'] = 'KJPP';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kjpp/kjppTidakDapatDigunakanView', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_objek_kjpp', $data);
        $this->load->view('templates/modal_sektor_kjpp', $data);
    }

    public function terbatas()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->KjppModel->GetPeriode()->result();
        $data['title'] = 'Kjpp';
        $data['subtitle'] = 'KJPP';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kjpp/kjppTerbatasView', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_objek_kjpp', $data);
        $this->load->view('templates/modal_sektor_kjpp', $data);
    }

    public function tabel_kjpp_perusahaan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;


            $where1 = "WHERE id_kota = " . $_POST['id_kota'] . " AND id_status <> 3 ";
            $get1 = $this->KjppModel->GetPenilaiPublikDistinc($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahanKjpp;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeleteKjpp = '0000-00-00' AND id_status <> 3 ";
                $get2 = $this->KjppModel->GetKjpp($where2)->result();

                foreach ($get2 as $g2) {

                    $id_status = $g2->id_status;
                    $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                    foreach ($check6 as $c6) {
                        $status = $c6->jenis_status;
                        if ($status == 'Diizinkan') {
                            $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                        } else {
                            $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                        }
                    }

                    $data[] = array(
                        $no,
                        '<a href="' . base_url('kjpp/kjppDetail/') . $g2->id . '">' . $g2->namaPerusahaanKjpp . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $g2->id . ')">' . "View" . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $g2->id . ')">' . "View" . '</a>',
                        $g2->nomorRekananKjpp,
                        $g2->terdaftarOjkKjpp,
                        $g2->jatuhTempoKjpp,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->KjppModel->GetKjpp('WHERE jatuhTempoKjpp LIKE "%' . $_POST['periode'] . '%" AND dateDeleteKjpp = "0000-00-00" AND id_status <> 3 ')->result();
            foreach ($get1 as $g1) {
                $id_status = $g1->id_status;
                $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                foreach ($check6 as $c6) {
                    $status = $c6->jenis_status;
                    if ($status == 'Diizinkan') {
                        $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                    } else {
                        $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                    }
                }
                $data[] = array(
                    $no,
                    '<a href="' . base_url('kjpp/kjppDetail/') . $g1->id . '">' . $g1->namaPerusahaanKjpp . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $g1->id . ')">' . "View" . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $g1->id . ')">' . "View" . '</a>',
                    $g1->nomorRekananKjpp,
                    $g1->terdaftarOjkKjpp,
                    $g1->jatuhTempoKjpp,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetKjpp($where1)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetKjpp($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'] . " AND id_status <> 3";
            $get1 = $this->KjppModel->GetPenilaiPublik($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahanKjpp;
                $where2 = "WHERE id = " . $id_perusahaan . " AND jatuhTempoKjpp LIKE '%" . $_POST['periode'] . "%' AND dateDeleteKjpp = '0000-00-00' AND id_status <> 3 ";
                $get2 = $this->KjppModel->GetKjpp($where2)->result();

                foreach ($get2 as $g2) {
                    $id_status = $g2->id_status;
                    $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                    foreach ($check6 as $c6) {
                        $status = $c6->jenis_status;
                        if ($status == 'Diizinkan') {
                            $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                        } else {
                            $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                        }
                    }
                    $data[] = array(
                        $no,
                        '<a href="' . base_url('kjpp/kjppDetail/') . $g2->id . '">' . $g2->namaPerusahaanKjpp . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $g2->id . ')">' . "View" . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $g2->id . ')">' . "View" . '</a>',
                        $g2->nomorRekananKjpp,
                        $g2->terdaftarOjkKjpp,
                        $g2->jatuhTempoKjpp,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeleteKjpp = '0000-00-00' AND id_status <> 3 ";
            $data1 = $this->KjppModel->GetKjpp($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {
                $id_status = $d->id_status;
                $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                foreach ($check6 as $c6) {
                    $status = $c6->jenis_status;
                    if ($status == 'Diizinkan') {
                        $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                    } else {
                        $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                    }
                }
                $data[] = array(
                    $no,
                    '<a href="' . base_url('kjpp/kjppDetail/') . $d->id . '">' . $d->namaPerusahaanKjpp . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $d->id . ')">' . "View" . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $d->id . ')">' . "View" . '</a>',
                    $d->nomorRekananKjpp,
                    $d->terdaftarOjkKjpp,
                    $d->jatuhTempoKjpp,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetKjpp($where)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetKjpp($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function tabel_kjpp_dapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;


            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KjppModel->GetPenilaiPublikDistinc($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahanKjpp;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeleteKjpp = '0000-00-00' AND id_status = '1' ";
                $get2 = $this->KjppModel->GetKjpp($where2)->result();

                foreach ($get2 as $g2) {

                    $id_status = $g2->id_status;
                    $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                    foreach ($check6 as $c6) {
                        $status = $c6->jenis_status;
                        if ($status == 'Diizinkan') {
                            $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                        } else {
                            $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                        }
                    }

                    $data[] = array(
                        $no,
                        '<a href="' . base_url('kjpp/kjppDetail/') . $g2->id . '">' . $g2->namaPerusahaanKjpp . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $g2->id . ')">' . "View" . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $g2->id . ')">' . "View" . '</a>',
                        $g2->nomorRekananKjpp,
                        $g2->terdaftarOjkKjpp,
                        $g2->jatuhTempoKjpp,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->KjppModel->GetKjpp('WHERE dateCreateKjpp LIKE "%' . $_POST['periode'] . '%" AND dateDeleteKjpp = "0000-00-00" AND id_status = "1" ')->result();
            foreach ($get1 as $g1) {
                $id_status = $g1->id_status;
                $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                foreach ($check6 as $c6) {
                    $status = $c6->jenis_status;
                    if ($status == 'Diizinkan') {
                        $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                    } else {
                        $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                    }
                }
                $data[] = array(
                    $no,
                    '<a href="' . base_url('kjpp/kjppDetail/') . $g1->id . '">' . $g1->namaPerusahaanKjpp . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $g1->id . ')">' . "View" . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $g1->id . ')">' . "View" . '</a>',
                    $g1->nomorRekananKjpp,
                    $g1->terdaftarOjkKjpp,
                    $g1->jatuhTempoKjpp,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetKjpp($where1)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetKjpp($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KjppModel->GetPenilaiPublik($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahanKjpp;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreateKjpp LIKE '%" . $_POST['periode'] . "%' AND dateDeleteKjpp = '0000-00-00' AND id_status = '1' ";
                $get2 = $this->KjppModel->GetKjpp($where2)->result();

                foreach ($get2 as $g2) {
                    $id_status = $g2->id_status;
                    $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                    foreach ($check6 as $c6) {
                        $status = $c6->jenis_status;
                        if ($status == 'Diizinkan') {
                            $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                        } else {
                            $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                        }
                    }
                    $data[] = array(
                        $no,
                        '<a href="' . base_url('kjpp/kjppDetail/') . $g2->id . '">' . $g2->namaPerusahaanKjpp . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $g2->id . ')">' . "View" . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $g2->id . ')">' . "View" . '</a>',
                        $g2->nomorRekananKjpp,
                        $g2->terdaftarOjkKjpp,
                        $g2->jatuhTempoKjpp,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeleteKjpp = '0000-00-00' AND id_status = '1' ";
            $data1 = $this->KjppModel->GetKjpp($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {
                $id_status = $d->id_status;
                $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                foreach ($check6 as $c6) {
                    $status = $c6->jenis_status;
                    if ($status == 'Diizinkan') {
                        $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                    } else {
                        $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                    }
                }
                $data[] = array(
                    $no,
                    '<a href="' . base_url('kjpp/kjppDetail/') . $d->id . '">' . $d->namaPerusahaanKjpp . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $d->id . ')">' . "View" . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $d->id . ')">' . "View" . '</a>',
                    $d->nomorRekananKjpp,
                    $d->terdaftarOjkKjpp,
                    $d->jatuhTempoKjpp,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetKjpp($where)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetKjpp($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function tabel_kjpp_tidakDapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;


            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KjppModel->GetPenilaiPublikDistinc($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahanKjpp;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeleteKjpp = '0000-00-00' AND id_status = '2' ";
                $get2 = $this->KjppModel->GetKjpp($where2)->result();

                foreach ($get2 as $g2) {

                    $id_status = $g2->id_status;
                    $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                    foreach ($check6 as $c6) {
                        $status = $c6->jenis_status;
                        if ($status == 'Diizinkan') {
                            $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                        } else {
                            $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                        }
                    }

                    $data[] = array(
                        $no,
                        '<a href="' . base_url('kjpp/kjppDetail/') . $g2->id . '">' . $g2->namaPerusahaanKjpp . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $g2->id . ')">' . "View" . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $g2->id . ')">' . "View" . '</a>',
                        $g2->nomorRekananKjpp,
                        $g2->terdaftarOjkKjpp,
                        $g2->jatuhTempoKjpp,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->KjppModel->GetKjpp('WHERE dateCreateKjpp LIKE "%' . $_POST['periode'] . '%" AND dateDeleteKjpp = "0000-00-00" AND id_status = "2" ')->result();
            foreach ($get1 as $g1) {
                $id_status = $g1->id_status;
                $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                foreach ($check6 as $c6) {
                    $status = $c6->jenis_status;
                    if ($status == 'Diizinkan') {
                        $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                    } else {
                        $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                    }
                }
                $data[] = array(
                    $no,
                    '<a href="' . base_url('kjpp/kjppDetail/') . $g1->id . '">' . $g1->namaPerusahaanKjpp . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $g1->id . ')">' . "View" . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $g1->id . ')">' . "View" . '</a>',
                    $g1->nomorRekananKjpp,
                    $g1->terdaftarOjkKjpp,
                    $g1->jatuhTempoKjpp,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetKjpp($where1)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetKjpp($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KjppModel->GetPenilaiPublik($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahanKjpp;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreateKjpp LIKE '%" . $_POST['periode'] . "%' AND dateDeleteKjpp = '0000-00-00' AND id_status = '2' ";
                $get2 = $this->KjppModel->GetKjpp($where2)->result();

                foreach ($get2 as $g2) {
                    $id_status = $g2->id_status;
                    $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                    foreach ($check6 as $c6) {
                        $status = $c6->jenis_status;
                        if ($status == 'Diizinkan') {
                            $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                        } else {
                            $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                        }
                    }
                    $data[] = array(
                        $no,
                        '<a href="' . base_url('kjpp/kjppDetail/') . $g2->id . '">' . $g2->namaPerusahaanKjpp . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $g2->id . ')">' . "View" . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $g2->id . ')">' . "View" . '</a>',
                        $g2->nomorRekananKjpp,
                        $g2->terdaftarOjkKjpp,
                        $g2->jatuhTempoKjpp,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeleteKjpp = '0000-00-00' AND id_status = '2' ";
            $data1 = $this->KjppModel->GetKjpp($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {
                $id_status = $d->id_status;
                $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                foreach ($check6 as $c6) {
                    $status = $c6->jenis_status;
                    if ($status == 'Diizinkan') {
                        $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                    } else {
                        $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                    }
                }
                $data[] = array(
                    $no,
                    '<a href="' . base_url('kjpp/kjppDetail/') . $d->id . '">' . $d->namaPerusahaanKjpp . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $d->id . ')">' . "View" . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $d->id . ')">' . "View" . '</a>',
                    $d->nomorRekananKjpp,
                    $d->terdaftarOjkKjpp,
                    $d->jatuhTempoKjpp,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetKjpp($where)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetKjpp($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function tabel_kjpp_terbatas()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;


            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KjppModel->GetPenilaiPublikDistinc($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahanKjpp;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeleteKjpp = '0000-00-00' AND id_status = '4' ";
                $get2 = $this->KjppModel->GetKjpp($where2)->result();

                foreach ($get2 as $g2) {

                    $id_status = $g2->id_status;
                    $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                    foreach ($check6 as $c6) {
                        $status = $c6->jenis_status;
                        if ($status == 'Diizinkan') {
                            $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                        } else {
                            $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                        }
                    }

                    $data[] = array(
                        $no,
                        '<a href="' . base_url('kjpp/kjppDetail/') . $g2->id . '">' . $g2->namaPerusahaanKjpp . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $g2->id . ')">' . "View" . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $g2->id . ')">' . "View" . '</a>',
                        $g2->nomorRekananKjpp,
                        $g2->terdaftarOjkKjpp,
                        $g2->jatuhTempoKjpp,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->KjppModel->GetKjpp('WHERE dateCreateKjpp LIKE "%' . $_POST['periode'] . '%" AND dateDeleteKjpp = "0000-00-00" AND id_status = "4" ')->result();
            foreach ($get1 as $g1) {
                $id_status = $g1->id_status;
                $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                foreach ($check6 as $c6) {
                    $status = $c6->jenis_status;
                    if ($status == 'Diizinkan') {
                        $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                    } else {
                        $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                    }
                }
                $data[] = array(
                    $no,
                    '<a href="' . base_url('kjpp/kjppDetail/') . $g1->id . '">' . $g1->namaPerusahaanKjpp . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $g1->id . ')">' . "View" . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $g1->id . ')">' . "View" . '</a>',
                    $g1->nomorRekananKjpp,
                    $g1->terdaftarOjkKjpp,
                    $g1->jatuhTempoKjpp,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetKjpp($where1)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetKjpp($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KjppModel->GetPenilaiPublik($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahanKjpp;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreateKjpp LIKE '%" . $_POST['periode'] . "%' AND dateDeleteKjpp = '0000-00-00' AND id_status = '4' ";
                $get2 = $this->KjppModel->GetKjpp($where2)->result();

                foreach ($get2 as $g2) {
                    $id_status = $g2->id_status;
                    $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                    foreach ($check6 as $c6) {
                        $status = $c6->jenis_status;
                        if ($status == 'Diizinkan') {
                            $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                        } else {
                            $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                        }
                    }
                    $data[] = array(
                        $no,
                        '<a href="' . base_url('kjpp/kjppDetail/') . $g2->id . '">' . $g2->namaPerusahaanKjpp . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $g2->id . ')">' . "View" . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $g2->id . ')">' . "View" . '</a>',
                        $g2->nomorRekananKjpp,
                        $g2->terdaftarOjkKjpp,
                        $g2->jatuhTempoKjpp,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetPenilaiPublik($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeleteKjpp = '0000-00-00' AND id_status = '4' ";
            $data1 = $this->KjppModel->GetKjpp($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {
                $id_status = $d->id_status;
                $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
                foreach ($check6 as $c6) {
                    $status = $c6->jenis_status;
                    if ($status == 'Diizinkan') {
                        $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                    } else {
                        $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                    }
                }
                $data[] = array(
                    $no,
                    '<a href="' . base_url('kjpp/kjppDetail/') . $d->id . '">' . $d->namaPerusahaanKjpp . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppObjek" onclick="goView(' . $d->id . ')">' . "View" . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kjppSektor" onclick="goView2(' . $d->id . ')">' . "View" . '</a>',
                    $d->nomorRekananKjpp,
                    $d->terdaftarOjkKjpp,
                    $d->jatuhTempoKjpp,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KjppModel->GetKjpp($where)->num_rows(),
                "recordsFiltered" => $this->KjppModel->GetKjpp($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function kjppDetail($id)
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['dataKjpp'] = $this->KjppModel->GetKjpp("WHERE id = " . $id)->result();
        $data['title'] = 'Kjpp';
        $data['subtitle'] = 'KJPP';
        $data['idKjpp'] = $id;
        $data['jasaPenilai'] = $this->KjppModel->GetJasaPenilai();
        $data['statusPenilai'] = $this->KjppModel->GetStatus()->result();
        $data['sanksi'] = $this->KjppModel->GetSanksi()->result();
        $data['ojkKjpp'] = $this->KjppModel->GetOjkKjpp();
        $data['provinsi'] = $this->ProvinsiModel->view();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kjpp/detail', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_kjpp', $data);
    }

    public function kjppPenilaiDetail($id)
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $aktif = array('tb_penilaipublik.id' => $id);
        $data['dataKjpp'] = $this->KjppModel->GetKjppDetail($aktif);
        $data['title'] = 'Kjpp';
        $data['subtitle'] = 'KJPP';
        $data['jasaPenilai'] = $this->KjppModel->GetJasaPenilai();
        $data['statusPenilai'] = $this->KjppModel->GetStatus()->result();
        $data['sanksi'] = $this->KjppModel->GetSanksi()->result();
        $data['ojkKjpp'] = $this->KjppModel->GetOjkKjpp();
        $data['provinsi'] = $this->ProvinsiModel->view();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kjpp/detailPenilai', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_kjpp', $data);
    }

    # Tabel KJPP Penilai Publik

    public function tabel_kjpp_penilai()
    {

        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $id = $_POST['idKjpp'];

        $where = "WHERE id_perusahanKjpp = " . $id . " AND dateDeletePenilaiPublik = '0000-00-00'";

        $data1 = $this->KjppModel->GetPenilaiPublik($where)->result();

        $data = array();

        $no = 1;

        foreach ($data1 as $d) {
            $id_jasa_penilai = $d->id_jasaPenilai;
            $check = $this->db->query("SELECT * FROM tb_jasapenilai WHERE id = " . $id_jasa_penilai)->result();
            foreach ($check as $c) {
                $jasa_penilai = $c->jasaPenilai;
            }

            $id_ojk = $d->id_ojkKjpp;
            $check2 = $this->db->query("SELECT * FROM tb_ojkkjpp WHERE id = " . $id_ojk)->result();
            foreach ($check2 as $c2) {
                $ojk = $c2->ojkKjpp;
            }
            $id_provinsi = $d->id_provinsi;
            $check3 = $this->KjppModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
            foreach ($check3 as $c3) {
                $provinsi = $c3->nama_provinsi;
            }

            $id_kota = $d->id_kota;
            $check3 = $this->KjppModel->getKota("WHERE id = " . $id_kota)->result();
            foreach ($check3 as $c3) {
                $kota = $c3->nama_kota;
            }

            $id_status = $d->id_status;
            $check6 = $this->KjppModel->GetStatus("WHERE id = " . $id_status)->result();
            foreach ($check6 as $c6) {
                $status = $c6->jenis_status;
                if ($status == 'Diizinkan') {
                    $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                } else {
                    $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                }
            }

            $data[] = array(
                $no,
                '<a href="' . base_url('kjpp/kjppPenilaiDetail/') . $d->id . '">' . $d->penilaiPublik . '</a>',
                $d->jenisKantor,
                $kota,
                $d->alamat,
                $statusArray
            );
            $no++;
        }



        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->KjppModel->GetPenilaiPublik($where)->num_rows(),
            "recordsFiltered" => $this->KjppModel->GetPenilaiPublik($where)->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function tabel_kjpp_objek()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $data = array();
        $no = 1;

        $idKjpp = $this->input->post('idKjpp');

        $where1 = "WHERE idKjpp = " . $idKjpp;
        $get1 = $this->KjppModel->GetKjppObjek($where1)->result();
        foreach ($get1 as $g1) {
            $idObjek = $g1->idObjek;

            $where2 = "WHERE id = " . $idObjek;
            $get2 = $this->KjppModel->GetObjek($where2)->result();
            foreach ($get2 as $g2) {
                $objek = $g2->objek;
            }

            $data[] = array(
                $no,
                $objek
            );
            $no++;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->KjppModel->GetKjppObjek($where1)->num_rows(),
            "recordsFiltered" => $this->KjppModel->GetKjppObjek($where1)->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function tabel_kjpp_sektor()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $data = array();
        $no = 1;

        $idKjpp = $this->input->post('idKjpp');

        $where1 = "WHERE idKjpp = " . $idKjpp;
        $get1 = $this->KjppModel->GetKjppSektor($where1)->result();
        foreach ($get1 as $g1) {
            $idSektor = $g1->idSektor;

            $where2 = "WHERE id = " . $idSektor;
            $get2 = $this->KjppModel->GetSektor($where2)->result();
            foreach ($get2 as $g2) {
                $sektor = $g2->sektor;
            }

            $data[] = array(
                $no,
                $sektor
            );
            $no++;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->KjppModel->GetKjppSektor($where1)->num_rows(),
            "recordsFiltered" => $this->KjppModel->GetKjppSektor($where1)->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    # Tabel KJPP Daftar Kantor

    public function kjppAdd()
    {
        if ($_SESSION['role_id'] == 1) {
            $data['title'] = 'Kjpp';
            $data['subtitle'] = 'Tambah KJPP';
            $data['lastKjppId'] = $this->KjppModel->GetLatestKjppId();
            $data['lastPenilaiPublikId'] = $this->KjppModel->GetLatestPenilaiPublikId();
            $data['status'] = $this->KjppModel->GetStatus()->result();
            $data['sanksi'] = $this->KjppModel->GetSanksi()->result();
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kjpp/kjppAdd', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('kjpp');
        }
    }

    public function listKota()
    {
        // Ambil data ID Provinsi yang dikirim via ajax post
        $id_provinsi = $this->input->post('id_provinsi');

        $kota = $this->KotaModel->viewByProvinsi($id_provinsi);

        // Buat variabel untuk menampung tag-tag option nya
        // Set defaultnya dengan tag option Pilih
        $lists = "<option value=''>--Pilih Kota--</option>";

        foreach ($kota as $data) {
            $lists .= "<option value='" . $data->id . "'>" . $data->nama_kota . "</option>"; // Tambahkan tag option ke variabel $lists
        }

        $callback = array('list_kota' => $lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
        echo json_encode($callback); // konversi varibael $callback menjadi JSON
    }




    // Fungsi CRUD

    public function newKjpp()
    {
        $namaPerusahaanKjpp = $_POST['namaPerusahaanKjpp'];
        $nomorRekananKjpp = $_POST['nomorRekananKjpp'];
        $terdaftarOjkKjpp = $_POST['terdaftarOjkKjpp'];
        $jatuhTempoKjpp = $_POST['jatuhTempoKjpp'];
        $nilaiKjpp = $_POST['nilaiKjpp'];
        $id_status = $_POST['id_status'];
        $id_sanksi = $_POST['id_sanksi'];
        $today = date("Y-m-d");
        $nullDate = "0000-00-00";

        if ($id_status != 'volvo' && $terdaftarOjkKjpp != 'volvo' && $id_sanksi != 'volvo') {
            $datains = array(
                'namaPerusahaanKjpp' => $namaPerusahaanKjpp,
                'nomorRekananKjpp' => $nomorRekananKjpp,
                'terdaftarOjkKjpp' => $terdaftarOjkKjpp,
                'jatuhTempoKjpp' => $jatuhTempoKjpp,
                'nilaiKjpp' => $nilaiKjpp,
                'id_status' => $id_status,
                'id_sanksi' => $id_sanksi,
                'dateCreateKjpp' => $today,
                'dateDeleteKjpp' => $nullDate,
            );
            $ins = $this->db->insert('tb_perusahaankjpp', $datains);

            if ($ins > 0) {
                $where = "WHERE namaPerusahaanKjpp = '" . $namaPerusahaanKjpp . "' AND nomorRekananKjpp = '" . $nomorRekananKjpp . "'";
                $get = $this->KjppModel->GetKjpp($where)->result();
                foreach ($get as $g) {
                    $id_Kjpp = $g->id;
                }
                $this->session->set_flashdata('successAlert', 'Input KJPP Sukses! Silakan isi data pelengkap lainnya.');
                redirect(base_url('kjpp/kjppDetail/' . $id_Kjpp), 'refresh');
            } else {
                $this->session->set_flashdata('dangerAlert', 'Tambah Produk Sukses');
                redirect(base_url('kjpp/kjppAdd'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Tambah Produk Sukses');
            redirect(base_url('kjpp/kjppAdd'), 'refresh');
        }
    }

    public function tambahPenilaiKjpp()
    {
        $id_perusahanKjpp = $_POST['id_perusahanKjpp'];
        $penilaiPublik = $_POST['penilaiPublik'];
        $jenisKantor = $_POST['jenisKantor'];
        $id_provinsi = $_POST['id_provinsi'];
        $id_kota = $_POST['id_kota'];
        $alamat = $_POST['alamat'];
        $phone = $_POST['phone'];
        $id_jasaPenilai = $_POST['id_jasaPenilai'];
        $id_ojkKjpp = $_POST['id_ojkKjpp'];
        $id_status = $_POST['id_status'];
        $id_sanksi = $_POST['id_sanksi'];
        $keterangan = $_POST['keterangan'];
        $today = date("Y-m-d");
        $nullDate = "0000-00-00";

        if ($id_jasaPenilai != 'volvo' && $id_ojkKjpp != 'volvo' && $id_status != 'volvo' && $id_sanksi != 'volvo') {
            $datains = array(
                'id_perusahanKjpp' => $id_perusahanKjpp,
                'penilaiPublik' => $penilaiPublik,
                'jenisKantor' => $jenisKantor,
                'id_provinsi' => $id_provinsi,
                'id_kota' => $id_kota,
                'alamat' => $alamat,
                'phone' => $phone,
                'id_jasaPenilai' => $id_jasaPenilai,
                'id_ojkKjpp' => $id_ojkKjpp,
                'id_status' => $id_status,
                'id_sanksi' => $id_sanksi,
                'keterangan' => $keterangan,
                'dateCreatePenilaiPublik' => $today,
                'dateDeletePenilaiPublik' => $nullDate,
            );
            $ins = $this->db->insert('tb_penilaipublik', $datains);

            if ($ins > 0) {
                $this->session->set_flashdata('successAlert', 'Tambah Penilai Publik Sukses!');
                redirect(base_url('kjpp/kjppDetail/' . $id_perusahanKjpp), 'refresh');
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika menghubungkan dengan pusat data!');
                redirect(base_url('kjpp/kjppDetail/' . $id_perusahanKjpp), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Pastikan semua kolom isian telah terisi dengan sempurna!');
            redirect(base_url('kjpp/kjppDetail/' . $id_perusahanKjpp), 'refresh');
        }
    }

    public function uploadKjpp()
    {

        // Fungsi Upload CSV
        $config['upload_path'] = './assets/csv/'; //path folder
        $config['allowed_types'] = 'csv'; //type 
        $config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

        $this->upload->initialize($config);
        if (!empty($_FILES['upl_csv']['name'])) {

            if ($this->upload->do_upload('upl_csv')) {
                $upl = $this->upload->data();

                $file_name = $upl['file_name'];
                $patiakduo = '"';

                if ($file_name == 'perusahaanKjpp.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_perusahaankjpp FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Instansi KJPP Sukses!');
                        redirect(base_url('kjpp/kjppAdd'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('kjpp/kjppAdd'), 'refresh');
                    }
                } else if ($file_name == 'kantorKjpp.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_kantorkjpp FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Kantor KJPP Sukses!');
                        redirect(base_url('kjpp/kjppAdd'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('kjpp/kjppAdd'), 'refresh');
                    }
                } else if ($file_name == 'penilaiPublik.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_penilaipublik FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Penilai Publik Sukses!');
                        redirect(base_url('kjpp/kjppAdd'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('kjpp/kjppAdd'), 'refresh');
                    }
                } else {
                    unlink("./assets/csv/" . $file_name);

                    $this->session->set_flashdata('dangerAlert', 'Nama file salah!');
                    redirect(base_url('kjpp/kjppAdd'), 'refresh');
                }
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengunggah data!');
                redirect(base_url('kjpp/kjppAdd'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Tidak ada file ditemukan!');
            redirect(base_url('kjpp/kjppAdd'), 'refresh');
        }
    }
}
