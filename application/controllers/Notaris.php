<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notaris extends CI_Controller
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
        $data['Notaris'] = $this->NotarisModel->all("WHERE id_status <> 3")->result_array();
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
        $data['NotarisTerbatas'] = $this->NotarisModel->all("WHERE id_status = 4")->result_array();
        $data['title'] = 'Notaris';
        $data['subtitle'] = 'Notaris';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('notaris/index', $data);
        $this->load->view('templates/footer');
    }

    public function allNotaris()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->NotarisModel->GetPeriode()->result();
        $data['title'] = 'Notaris';
        $data['subtitle'] = 'Notaris';
        $data['status'] = $this->NotarisModel->GetStatus()->result();
        $data['sanksi'] = $this->NotarisModel->GetSanksi()->result();
        $data['wilayah'] = $this->NotarisModel->GetWilayah()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('notaris/notarisView', $data);
        $this->load->view('templates/modal_notaris');
        $this->load->view('templates/footer');
    }

    public function notarisDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->NotarisModel->GetPeriode()->result();
        $data['title'] = 'Notaris';
        $data['subtitle'] = 'Notaris';
        $data['status'] = $this->NotarisModel->GetStatus()->result();
        $data['sanksi'] = $this->NotarisModel->GetSanksi()->result();
        $data['wilayah'] = $this->NotarisModel->GetWilayah()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('notaris/notarisDapatDigunakanView', $data);
        $this->load->view('templates/modal_notaris');
        $this->load->view('templates/footer');
    }

    public function notarisTidakDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->NotarisModel->GetPeriode()->result();
        $data['title'] = 'Notaris';
        $data['subtitle'] = 'Notaris';
        $data['status'] = $this->NotarisModel->GetStatus()->result();
        $data['sanksi'] = $this->NotarisModel->GetSanksi()->result();
        $data['wilayah'] = $this->NotarisModel->GetWilayah()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('notaris/notarisTidakDapatDigunakanView', $data);
        $this->load->view('templates/modal_notaris');
        $this->load->view('templates/footer');
    }

    public function notarisTerbatas()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->NotarisModel->GetPeriode()->result();
        $data['title'] = 'Notaris';
        $data['subtitle'] = 'Notaris';
        $data['status'] = $this->NotarisModel->GetStatus()->result();
        $data['sanksi'] = $this->NotarisModel->GetSanksi()->result();
        $data['wilayah'] = $this->NotarisModel->GetWilayah()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('notaris/notarisTerbatasView', $data);
        $this->load->view('templates/modal_notaris');
        $this->load->view('templates/footer');
    }

    public function notarisDetail($id)
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $aktif = array('tb_notaris.id' => $id);
        $data['dataNotaris'] = $this->NotarisModel->GetNotarisDetail($aktif);
        $data['title'] = 'Notaris';
        $data['subtitle'] = 'Notaris';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('notaris/detailNotaris', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_kap', $data);
    }

    public function tabel_notaris_perusahaan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'] . " AND id_status <> 3 ";
            $get1 = $this->NotarisModel->getNotaris($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeleteNotaris = '0000-00-00' AND id_status <> 3 ";
                $get2 = $this->NotarisModel->getNotaris($where2)->result();

                foreach ($get2 as $g2) {
                    $id_wilayah = $g2->id_wilayah;
                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

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
                        '<a href="' . base_url('notaris/notarisDetail/') . $g2->id . '">' . $g2->nama . '</a>',
                        $wilayah,
                        $kota,
                        $g2->alamat,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->NotarisModel->getNotaris($where1)->num_rows(),
                "recordsFiltered" => $this->NotarisModel->getNotaris($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->NotarisModel->getNotaris('WHERE dateCreateNotaris LIKE "%' . $_POST['periode'] . '%" AND dateDeleteNotaris = "0000-00-00" AND id_status <> 3 ')->result();
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
                    '<a href="' . base_url('notaris/notarisDetail/') . $g1->id . '">' . $g1->nama . '</a>',
                    $wilayah,
                    $kota,
                    $g1->alamat,
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
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->NotarisModel->getNotaris($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreateNotaris LIKE '%" . $_POST['periode'] . "%' AND dateDeleteNotaris = '0000-00-00' AND id_status <> 3 ";
                $get2 = $this->NotarisModel->getNotaris($where2)->result();

                foreach ($get2 as $g2) {

                    $id_wilayah = $g2->id_wilayah;
                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

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

                    $id_status = $g2->id_status;
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
                        '<a href="' . base_url('notaris/notarisDetail/') . $g2->id . '">' . $g2->nama . '</a>',
                        $wilayah,
                        $kota,
                        $g2->alamat,
                        $statusArray
                    );
                    $no++;
                }
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
            $where = "WHERE dateDeleteNotaris = '0000-00-00' AND id_status <> 3 ";
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
                    '<a href="' . base_url('notaris/notarisDetail/') . $d->id . '">' . $d->nama . '</a>',
                    $wilayah,
                    $kota,
                    $d->alamat,
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

    public function tabel_notaris_dapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->NotarisModel->getNotaris($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeleteNotaris = '0000-00-00' AND id_status = '1' ";
                $get2 = $this->NotarisModel->getNotaris($where2)->result();

                foreach ($get2 as $g2) {
                    $id_wilayah = $g2->id_wilayah;
                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

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
                        '<a href="' . base_url('notaris/notarisDetail/') . $g2->id . '">' . $g2->nama . '</a>',
                        $wilayah,
                        $kota,
                        $g2->alamat,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->NotarisModel->getNotaris($where1)->num_rows(),
                "recordsFiltered" => $this->NotarisModel->getNotaris($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->NotarisModel->getNotaris('WHERE dateCreateNotaris LIKE "%' . $_POST['periode'] . '%" AND dateDeleteNotaris = "0000-00-00" AND id_status = "1" ')->result();
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
                    '<a href="' . base_url('notaris/notarisDetail/') . $g1->id . '">' . $g1->nama . '</a>',
                    $wilayah,
                    $kota,
                    $g1->alamat,
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
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->NotarisModel->getNotaris($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreateNotaris LIKE '%" . $_POST['periode'] . "%' AND dateDeleteNotaris = '0000-00-00' AND id_status = '1' ";
                $get2 = $this->NotarisModel->getNotaris($where2)->result();

                foreach ($get2 as $g2) {

                    $id_wilayah = $g2->id_wilayah;
                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

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

                    $id_status = $g2->id_status;
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
                        '<a href="' . base_url('notaris/notarisDetail/') . $g2->id . '">' . $g2->nama . '</a>',
                        $wilayah,
                        $kota,
                        $g2->alamat,
                        $statusArray
                    );
                    $no++;
                }
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
            $where = "WHERE dateDeleteNotaris = '0000-00-00' AND id_status = '1' ";
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
                    '<a href="' . base_url('notaris/notarisDetail/') . $d->id . '">' . $d->nama . '</a>',
                    $wilayah,
                    $kota,
                    $d->alamat,
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

    public function tabel_notaris_tidakDapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->NotarisModel->getNotaris($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeleteNotaris = '0000-00-00' AND id_status = '2' ";
                $get2 = $this->NotarisModel->getNotaris($where2)->result();

                foreach ($get2 as $g2) {
                    $id_wilayah = $g2->id_wilayah;
                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

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
                        '<a href="' . base_url('notaris/notarisDetail/') . $g2->id . '">' . $g2->nama . '</a>',
                        $wilayah,
                        $kota,
                        $g2->alamat,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->NotarisModel->getNotaris($where1)->num_rows(),
                "recordsFiltered" => $this->NotarisModel->getNotaris($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->NotarisModel->getNotaris('WHERE dateCreateNotaris LIKE "%' . $_POST['periode'] . '%" AND dateDeleteNotaris = "0000-00-00" AND id_status = "2" ')->result();
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
                    '<a href="' . base_url('notaris/notarisDetail/') . $g1->id . '">' . $g1->nama . '</a>',
                    $wilayah,
                    $kota,
                    $g1->alamat,
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
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->NotarisModel->getNotaris($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreateNotaris LIKE '%" . $_POST['periode'] . "%' AND dateDeleteNotaris = '0000-00-00' AND id_status = '2' ";
                $get2 = $this->NotarisModel->getNotaris($where2)->result();

                foreach ($get2 as $g2) {

                    $id_wilayah = $g2->id_wilayah;
                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

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

                    $id_status = $g2->id_status;
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
                        '<a href="' . base_url('notaris/notarisDetail/') . $g2->id . '">' . $g2->nama . '</a>',
                        $wilayah,
                        $kota,
                        $g2->alamat,
                        $statusArray
                    );
                    $no++;
                }
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
            $where = "WHERE dateDeleteNotaris = '0000-00-00' AND id_status = '2' ";
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
                    '<a href="' . base_url('notaris/notarisDetail/') . $d->id . '">' . $d->nama . '</a>',
                    $wilayah,
                    $kota,
                    $d->alamat,
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

    public function tabel_notaris_terbatas()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->NotarisModel->getNotaris($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeleteNotaris = '0000-00-00' AND id_status = '4' ";
                $get2 = $this->NotarisModel->getNotaris($where2)->result();

                foreach ($get2 as $g2) {
                    $id_wilayah = $g2->id_wilayah;
                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

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
                        '<a href="' . base_url('notaris/notarisDetail/') . $g2->id . '">' . $g2->nama . '</a>',
                        $wilayah,
                        $kota,
                        $g2->alamat,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->NotarisModel->getNotaris($where1)->num_rows(),
                "recordsFiltered" => $this->NotarisModel->getNotaris($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->NotarisModel->getNotaris('WHERE dateCreateNotaris LIKE "%' . $_POST['periode'] . '%" AND dateDeleteNotaris = "0000-00-00" AND id_status = "4" ')->result();
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
                    '<a href="' . base_url('notaris/notarisDetail/') . $g1->id . '">' . $g1->nama . '</a>',
                    $wilayah,
                    $kota,
                    $g1->alamat,
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
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->NotarisModel->getNotaris($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreateNotaris LIKE '%" . $_POST['periode'] . "%' AND dateDeleteNotaris = '0000-00-00' AND id_status = '4' ";
                $get2 = $this->NotarisModel->getNotaris($where2)->result();

                foreach ($get2 as $g2) {

                    $id_wilayah = $g2->id_wilayah;
                    $id_provinsi = $g2->id_provinsi;
                    $id_kota = $g2->id_kota;

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

                    $id_status = $g2->id_status;
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
                        '<a href="' . base_url('notaris/notarisDetail/') . $g2->id . '">' . $g2->nama . '</a>',
                        $wilayah,
                        $kota,
                        $g2->alamat,
                        $statusArray
                    );
                    $no++;
                }
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
            $where = "WHERE dateDeleteNotaris = '0000-00-00' AND id_status = '4' ";
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
                    '<a href="' . base_url('notaris/notarisDetail/') . $d->id . '">' . $d->nama . '</a>',
                    $wilayah,
                    $kota,
                    $d->alamat,
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

    public function notarisUpload()
    {
        if ($_SESSION['role_id'] == 1) {
            $data['title'] = 'Notaris';
            $data['subtitle'] = 'Tambah Notaris';
            $data['lastNotarisId'] = $this->NotarisModel->GetLatestNotarisId();
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('notaris/notarisUpload', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('notaris');
        }
    }

    public function newNotaris()
    {
        $nama = $_POST['nama'];
        $id_provinsi = $_POST['id_provinsi'];
        $id_kota = $_POST['id_kota'];
        $id_wilayah = $_POST['id_wilayah'];
        $klasifikasi = $_POST['klasifikasi'];
        $jatuhTempo = $_POST['jatuhTempo'];
        $alamat = $_POST['alamat'];
        $phone = $_POST['phone'];
        $fax = $_POST['fax'];
        $ponsel = $_POST['ponsel'];
        $keterangan = $_POST['keterangan'];
        $id_status = $_POST['id_status'];
        $id_sanksi = $_POST['id_sanksi'];
        $today = date("Y-m-d");
        $nullDate = "0000-00-00";

        if ($jatuhTempo != '' && $id_sanksi != 'volvo') {
            $datains = array(
                'nama' => $nama,
                'id_provinsi' => $id_provinsi,
                'id_kota' => $id_kota,
                'id_wilayah' => $id_wilayah,
                'klasifikasi' => $klasifikasi,
                'jatuhTempo' => $jatuhTempo,
                'alamat' => $alamat,
                'phone' => $phone,
                'fax' => $fax,
                'ponsel' => $ponsel,
                'keterangan' => $keterangan,
                'id_status' => $id_status,
                'id_sanksi' => $id_sanksi,
                'dateCreateNotaris' => $today,
                'dateDeleteNotaris' => $nullDate,
                'dateUpdateNotaris' => $nullDate,
            );
            $ins = $this->db->insert('tb_notaris', $datains);

            if ($ins > 0) {
                $this->session->set_flashdata('successAlert', 'Input Notaris Berhasil!.');
                redirect(base_url('notaris/allNotaris'), 'refresh');
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terdapat kesalahan ketika menghubungkan ke database.');
                redirect(base_url('notaris/allNotaris'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Mohon pastikan semua isian telah terisi dengan benar.');
            redirect(base_url('notaris/allNotaris'), 'refresh');
        }
    }

    public function uploadNotaris()
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

                if ($file_name == 'notaris.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_notaris FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Notaris Sukses!');
                        redirect(base_url('notaris/notarisUpload'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('notaris/notarisUpload'), 'refresh');
                    }
                } else {
                    unlink("./assets/csv/" . $file_name);

                    $this->session->set_flashdata('dangerAlert', 'Nama file salah!');
                    redirect(base_url('notaris/notarisUpload'), 'refresh');
                }
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengunggah data!');
                redirect(base_url('notaris/notarisUpload'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Tidak ada file ditemukan!');
            redirect(base_url('notaris/notarisUpload'), 'refresh');
        }
    }
}
