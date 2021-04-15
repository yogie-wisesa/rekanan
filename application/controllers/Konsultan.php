<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // is_log_in();
        $this->load->model('ProvinsiModel');
        $this->load->model('KotaModel');
        $this->load->model('WilayahModel');
        $this->load->model('KonsultanModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['Konsultan'] = $this->KonsultanModel->all("WHERE id_status <> 3")->result_array();
        $data['KonsultanDiterima'] = $this->KonsultanModel->all("WHERE id_status = 1")->result_array();
        $data['KonsultanDitolak'] = $this->KonsultanModel->all("WHERE id_status = 2")->result_array();
        $data['KonsultanTerbatas'] = $this->KonsultanModel->all("WHERE id_status = 4")->result_array();
        $data['title'] = 'Konsultan';
        $data['subtitle'] = 'Konsultan';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultan/index', $data);
        $this->load->view('templates/footer');
    }

    public function allKonsultan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->KonsultanModel->GetPeriode()->result();
        $data['title'] = 'Konsultan';
        $data['subtitle'] = 'Konsultan';
        $data['status'] = $this->KonsultanModel->GetStatus()->result();
        $data['sanksi'] = $this->KonsultanModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('Konsultan/KonsultanView', $data);
        $this->load->view('templates/modal_aj');
        $this->load->view('templates/footer');
    }

    public function konsultanDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->KonsultanModel->GetPeriode()->result();
        $data['title'] = 'Konsultan';
        $data['subtitle'] = 'Konsultan';
        $data['status'] = $this->KonsultanModel->GetStatus()->result();
        $data['sanksi'] = $this->KonsultanModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultan/konsultanDapatDigunakanView', $data);
        $this->load->view('templates/modal_notaris');
        $this->load->view('templates/footer');
    }

    public function konsultanTidakDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->KonsultanModel->GetPeriode()->result();
        $data['title'] = 'Konsultan';
        $data['subtitle'] = 'Konsultan';
        $data['status'] = $this->KonsultanModel->GetStatus()->result();
        $data['sanksi'] = $this->KonsultanModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultan/konsultanTidakDapatDigunakanView', $data);
        $this->load->view('templates/modal_notaris');
        $this->load->view('templates/footer');
    }

    public function konsultanTerbatas()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->KonsultanModel->GetPeriode()->result();
        $data['title'] = 'Konsultan';
        $data['subtitle'] = 'Konsultan';
        $data['status'] = $this->KonsultanModel->GetStatus()->result();
        $data['sanksi'] = $this->KonsultanModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultan/konsultanTerbatasView', $data);
        $this->load->view('templates/modal_notaris');
        $this->load->view('templates/footer');
    }

    public function KonsultanDetail($id)
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $aktif = array('tb_konsultan.id' => $id);
        $data['dataKonsultan'] = $this->KonsultanModel->GetKonsultanDetail($aktif);
        $data['title'] = 'Konsultan';
        $data['subtitle'] = 'Konsultan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultan/detailKonsultan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_kap', $data);
    }

    public function tabel_konsultan_perusahaan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'] . " AND id_status <> 3 ";
            $get1 = $this->KonsultanModel->getKonsultan($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDelete = '0000-00-00' AND id_status <> 3 ";
                $get2 = $this->KonsultanModel->getKonsultan($where2)->result();

                foreach ($get2 as $g2) {
                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

                    $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                    foreach ($check2 as $c2) {
                        $provinsi = $c2->nama_provinsi;
                    }

                    $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                    foreach ($check3 as $c3) {
                        $kota = $c3->nama_kota;
                    }

                    $id_status = $g1->id_status;
                    $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('Konsultan/KonsultanDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                        $kota,
                        $g1->alamat,
                        $g1->segmen,
                        $g1->klasifikasi,
                        $g1->pic,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->KonsultanModel->getKonsultan('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status <> 3 ')->result();
            foreach ($get1 as $g1) {

                $id_provinsi = $g1->id_provinsi;
                $id_kota = $g1->id_kota;

                $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                foreach ($check2 as $c2) {
                    $provinsi = $c2->nama_provinsi;
                }

                $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                foreach ($check3 as $c3) {
                    $kota = $c3->nama_kota;
                }

                $id_status = $g1->id_status;
                $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('Konsultan/KonsultanDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $kota,
                    $g1->alamat,
                    $g1->segmen,
                    $g1->klasifikasi,
                    $g1->pic,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KonsultanModel->getKonsultan($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreate LIKE '%" . $_POST['periode'] . "%' AND dateDelete = '0000-00-00' AND id_status <> 3 ";
                $get2 = $this->KonsultanModel->getKonsultan($where2)->result();

                foreach ($get2 as $g2) {

                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

                    $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                    foreach ($check2 as $c2) {
                        $provinsi = $c2->nama_provinsi;
                    }

                    $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                    foreach ($check3 as $c3) {
                        $kota = $c3->nama_kota;
                    }

                    $id_status = $g2->id_status;
                    $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('Konsultan/KonsultanDetail/') . $g2->id . '">' . $g2->namaPerusahaan . '</a>',
                        $kota,
                        $g2->alamat,
                        $g2->segmen,
                        $g2->klasifikasi,
                        $g2->pic,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status <> 3 ";
            $data1 = $this->KonsultanModel->getKonsultan($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {

                $id_provinsi = $d->id_provinsi;
                $id_kota = $d->id_kota;

                $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                foreach ($check2 as $c2) {
                    $provinsi = $c2->nama_provinsi;
                }

                $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                foreach ($check3 as $c3) {
                    $kota = $c3->nama_kota;
                }

                $id_status = $d->id_status;
                $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('Konsultan/KonsultanDetail/') . $d->id . '">' . $d->namaPerusahaan . '</a>',
                    $kota,
                    $d->alamat,
                    $d->segmen,
                    $d->klasifikasi,
                    $d->pic,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function tabel_konsultan_dapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'] . " AND id_status = 1 ";
            $get1 = $this->KonsultanModel->getKonsultan($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDelete = '0000-00-00' AND id_status = 1 ";
                $get2 = $this->KonsultanModel->getKonsultan($where2)->result();

                foreach ($get2 as $g2) {
                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

                    $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                    foreach ($check2 as $c2) {
                        $provinsi = $c2->nama_provinsi;
                    }

                    $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                    foreach ($check3 as $c3) {
                        $kota = $c3->nama_kota;
                    }

                    $id_status = $g1->id_status;
                    $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('Konsultan/KonsultanDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                        $kota,
                        $g1->alamat,
                        $g1->segmen,
                        $g1->klasifikasi,
                        $g1->pic,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->KonsultanModel->getKonsultan('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = 1 ')->result();
            foreach ($get1 as $g1) {

                $id_provinsi = $g1->id_provinsi;
                $id_kota = $g1->id_kota;

                $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                foreach ($check2 as $c2) {
                    $provinsi = $c2->nama_provinsi;
                }

                $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                foreach ($check3 as $c3) {
                    $kota = $c3->nama_kota;
                }

                $id_status = $g1->id_status;
                $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('Konsultan/KonsultanDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $kota,
                    $g1->alamat,
                    $g1->segmen,
                    $g1->klasifikasi,
                    $g1->pic,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KonsultanModel->getKonsultan($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreate LIKE '%" . $_POST['periode'] . "%' AND dateDelete = '0000-00-00' AND id_status = 1 ";
                $get2 = $this->KonsultanModel->getKonsultan($where2)->result();

                foreach ($get2 as $g2) {

                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

                    $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                    foreach ($check2 as $c2) {
                        $provinsi = $c2->nama_provinsi;
                    }

                    $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                    foreach ($check3 as $c3) {
                        $kota = $c3->nama_kota;
                    }

                    $id_status = $g2->id_status;
                    $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('Konsultan/KonsultanDetail/') . $g2->id . '">' . $g2->namaPerusahaan . '</a>',
                        $kota,
                        $g2->alamat,
                        $g2->segmen,
                        $g2->klasifikasi,
                        $g2->pic,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = 1 ";
            $data1 = $this->KonsultanModel->getKonsultan($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {

                $id_provinsi = $d->id_provinsi;
                $id_kota = $d->id_kota;

                $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                foreach ($check2 as $c2) {
                    $provinsi = $c2->nama_provinsi;
                }

                $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                foreach ($check3 as $c3) {
                    $kota = $c3->nama_kota;
                }

                $id_status = $d->id_status;
                $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('Konsultan/KonsultanDetail/') . $d->id . '">' . $d->namaPerusahaan . '</a>',
                    $kota,
                    $d->alamat,
                    $d->segmen,
                    $d->klasifikasi,
                    $d->pic,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function tabel_konsultan_tidakDapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'] . " AND id_status = 2 ";
            $get1 = $this->KonsultanModel->getKonsultan($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDelete = '0000-00-00' AND id_status = 2 ";
                $get2 = $this->KonsultanModel->getKonsultan($where2)->result();

                foreach ($get2 as $g2) {
                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

                    $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                    foreach ($check2 as $c2) {
                        $provinsi = $c2->nama_provinsi;
                    }

                    $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                    foreach ($check3 as $c3) {
                        $kota = $c3->nama_kota;
                    }

                    $id_status = $g1->id_status;
                    $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('Konsultan/KonsultanDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                        $kota,
                        $g1->alamat,
                        $g1->segmen,
                        $g1->klasifikasi,
                        $g1->pic,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->KonsultanModel->getKonsultan('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = 2 ')->result();
            foreach ($get1 as $g1) {

                $id_provinsi = $g1->id_provinsi;
                $id_kota = $g1->id_kota;

                $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                foreach ($check2 as $c2) {
                    $provinsi = $c2->nama_provinsi;
                }

                $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                foreach ($check3 as $c3) {
                    $kota = $c3->nama_kota;
                }

                $id_status = $g1->id_status;
                $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('Konsultan/KonsultanDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $kota,
                    $g1->alamat,
                    $g1->segmen,
                    $g1->klasifikasi,
                    $g1->pic,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KonsultanModel->getKonsultan($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreate LIKE '%" . $_POST['periode'] . "%' AND dateDelete = '0000-00-00' AND id_status = 2 ";
                $get2 = $this->KonsultanModel->getKonsultan($where2)->result();

                foreach ($get2 as $g2) {

                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

                    $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                    foreach ($check2 as $c2) {
                        $provinsi = $c2->nama_provinsi;
                    }

                    $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                    foreach ($check3 as $c3) {
                        $kota = $c3->nama_kota;
                    }

                    $id_status = $g2->id_status;
                    $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('Konsultan/KonsultanDetail/') . $g2->id . '">' . $g2->namaPerusahaan . '</a>',
                        $kota,
                        $g2->alamat,
                        $g2->segmen,
                        $g2->klasifikasi,
                        $g2->pic,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = 2 ";
            $data1 = $this->KonsultanModel->getKonsultan($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {

                $id_provinsi = $d->id_provinsi;
                $id_kota = $d->id_kota;

                $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                foreach ($check2 as $c2) {
                    $provinsi = $c2->nama_provinsi;
                }

                $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                foreach ($check3 as $c3) {
                    $kota = $c3->nama_kota;
                }

                $id_status = $d->id_status;
                $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('Konsultan/KonsultanDetail/') . $d->id . '">' . $d->namaPerusahaan . '</a>',
                    $kota,
                    $d->alamat,
                    $d->segmen,
                    $d->klasifikasi,
                    $d->pic,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function tabel_konsultan_terbatas()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'] . " AND id_status = 2 ";
            $get1 = $this->KonsultanModel->getKonsultan($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDelete = '0000-00-00' AND id_status = 4 ";
                $get2 = $this->KonsultanModel->getKonsultan($where2)->result();

                foreach ($get2 as $g2) {
                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

                    $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                    foreach ($check2 as $c2) {
                        $provinsi = $c2->nama_provinsi;
                    }

                    $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                    foreach ($check3 as $c3) {
                        $kota = $c3->nama_kota;
                    }

                    $id_status = $g1->id_status;
                    $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('Konsultan/KonsultanDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                        $kota,
                        $g1->alamat,
                        $g1->segmen,
                        $g1->klasifikasi,
                        $g1->pic,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->KonsultanModel->getKonsultan('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = 4 ')->result();
            foreach ($get1 as $g1) {

                $id_provinsi = $g1->id_provinsi;
                $id_kota = $g1->id_kota;

                $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                foreach ($check2 as $c2) {
                    $provinsi = $c2->nama_provinsi;
                }

                $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                foreach ($check3 as $c3) {
                    $kota = $c3->nama_kota;
                }

                $id_status = $g1->id_status;
                $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('Konsultan/KonsultanDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $kota,
                    $g1->alamat,
                    $g1->segmen,
                    $g1->klasifikasi,
                    $g1->pic,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KonsultanModel->getKonsultan($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreate LIKE '%" . $_POST['periode'] . "%' AND dateDelete = '0000-00-00' AND id_status = 4 ";
                $get2 = $this->KonsultanModel->getKonsultan($where2)->result();

                foreach ($get2 as $g2) {

                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

                    $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                    foreach ($check2 as $c2) {
                        $provinsi = $c2->nama_provinsi;
                    }

                    $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                    foreach ($check3 as $c3) {
                        $kota = $c3->nama_kota;
                    }

                    $id_status = $g2->id_status;
                    $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('Konsultan/KonsultanDetail/') . $g2->id . '">' . $g2->namaPerusahaan . '</a>',
                        $kota,
                        $g2->alamat,
                        $g2->segmen,
                        $g2->klasifikasi,
                        $g2->pic,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = 4 ";
            $data1 = $this->KonsultanModel->getKonsultan($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {

                $id_provinsi = $d->id_provinsi;
                $id_kota = $d->id_kota;

                $check2 = $this->KonsultanModel->getProvinsi("WHERE id = " . $id_provinsi)->result();
                foreach ($check2 as $c2) {
                    $provinsi = $c2->nama_provinsi;
                }

                $check3 = $this->KonsultanModel->getKota("WHERE id = " . $id_kota)->result();
                foreach ($check3 as $c3) {
                    $kota = $c3->nama_kota;
                }

                $id_status = $d->id_status;
                $check4 = $this->KonsultanModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('Konsultan/KonsultanDetail/') . $d->id . '">' . $d->namaPerusahaan . '</a>',
                    $kota,
                    $d->alamat,
                    $d->segmen,
                    $d->klasifikasi,
                    $d->pic,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KonsultanModel->getKonsultan($where)->num_rows(),
                "recordsFiltered" => $this->KonsultanModel->getKonsultan($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function konsultanAdd()
    {
        if ($_SESSION['role_id'] == 1) {
            $data['title'] = 'Konsultan';
            $data['subtitle'] = 'Tambah Konsultan';
            $data['lastKonsultanId'] = $this->KonsultanModel->GetLatestKonsultanId();
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('konsultan/konsultanUpload', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('konsultan');
        }
    }

    public function uploadKonsultan()
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

                if ($file_name == 'konsultan.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_konsultan FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Konsultan Sukses!');
                        redirect(base_url('konsultan/konsultanAdd'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('konsultan/konsultanAdd'), 'refresh');
                    }
                } else {
                    unlink("./assets/csv/" . $file_name);

                    $this->session->set_flashdata('dangerAlert', 'Nama file salah!');
                    redirect(base_url('konsultan/konsultanAdd'), 'refresh');
                }
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengunggah data!');
                redirect(base_url('konsultan/konsultanAdd'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Tidak ada file ditemukan!');
            redirect(base_url('konsultan/konsultanAdd'), 'refresh');
        }
    }
}
