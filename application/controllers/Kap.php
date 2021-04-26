<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kap extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // is_log_in();
        $this->load->model('ProvinsiModel');
        $this->load->model('KotaModel');
        $this->load->model('KapModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['totalAkuntan'] = $this->KapModel->penilai("WHERE id_statusPerusahaan != 3")->result_array();
        $data['kapPerusahaan'] = $this->KapModel->all("WHERE id_statusPerusahaan != 3")->result_array();
        $data['kapDitolak'] = $this->KapModel->all("WHERE id_statusPerusahaan = 2")->result_array();
        $data['kapDizinkan'] = $this->KapModel->all("WHERE id_statusPerusahaan = 1")->result_array();
        $data['kapTerbatas'] = $this->KapModel->all("WHERE id_statusPerusahaan = 4")->result_array();
        $data['title'] = 'Kap';
        $data['subtitle'] = 'Akuntan Publik';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kap/index', $data);
        $this->load->view('templates/footer');
    }

    public function kapPerusahaan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->KapModel->GetPeriode()->result();
        $data['title'] = 'Kap';
        $data['subtitle'] = 'Akuntan Publik';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kap/kapView', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_objek_kap', $data);
    }

    public function kapDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->KapModel->GetPeriode()->result();
        $data['title'] = 'Kap';
        $data['subtitle'] = 'Akuntan Publik';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kap/kapDapatDigunakanView', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_objek_kap', $data);
    }

    public function kapTidakDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->KapModel->GetPeriode()->result();
        $data['title'] = 'Kap';
        $data['subtitle'] = 'Akuntan Publik';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kap/kapTidakDapatDigunakanView', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_objek_kap', $data);
    }

    public function kapTerbatas()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->KapModel->GetPeriode()->result();
        $data['title'] = 'Kap';
        $data['subtitle'] = 'Akuntan Publik';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kap/kapTerbatasView', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_objek_kap', $data);
    }

    public function tabel_kap_perusahaan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;
            $objek = "View";

            $where1 = "WHERE id_kota = " . $_POST['id_kota'] . " AND id_status <> 3 ";
            $get1 = $this->KapModel->GetKantorKapId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanKap;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan <> 3 ";
                $get2 = $this->KapModel->GetKap($where2)->result();

                foreach ($get2 as $g2) {

                    $id_status = $g2->id_statusPerusahaan;
                    $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('kap/kapDetail/') . $g2->id . '">' . $g2->namaKantorKap . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $g2->id . ')">' . $objek . '</a>',
                        $g2->nomorRekanan,
                        $g2->jatuhTempoKap,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;
            $objek = "View";

            $where1 = "";
            $get1 = $this->KapModel->GetKap('WHERE jatuhTempoKap LIKE "%' . $_POST['periode'] . '%" AND dateDeletePerusahaanKap = "0000-00-00 AND id_statusPerusahaan <> 3 "')->result();
            foreach ($get1 as $g1) {

                $id_status = $g1->id_statusPerusahaan;
                $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('kap/kapDetail/') . $g1->id . '">' . $g1->namaKantorKap . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $g1->id . ')">' . $objek . '</a>',
                    $g1->nomorRekanan,
                    $g1->jatuhTempoKap,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKap($where1)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKap($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;
            $objek = "View";

            $where1 = "WHERE id_kota = " . $_POST['id_kota'] . " AND id_status <> 3 ";
            $get1 = $this->KapModel->GetKantorKapId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanKap;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreatePerusahaanKap LIKE '%" . $_POST['periode'] . "%' AND dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan <> 3 ";
                $get2 = $this->KapModel->GetKap($where2)->result();

                foreach ($get2 as $g2) {

                    $id_status = $g2->id_statusPerusahaan;
                    $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('kap/kapDetail/') . $g2->id . '">' . $g2->namaKantorKap . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $g2->id . ')">' . $objek . '</a>',
                        $g2->nomorRekanan,
                        $g2->jatuhTempoKap,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan <> 3 ";
            $data1 = $this->KapModel->GetKap($where)->result();

            $data = array();

            $no = 1;
            $objek = "View";

            foreach ($data1 as $d) {
                $id_status = $d->id_statusPerusahaan;
                $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('kap/kapDetail/') . $d->id . '">' . $d->namaKantorKap . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $d->id . ')">' . $objek . '</a>',
                    $d->nomorRekanan,
                    $d->jatuhTempoKap,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKap($where)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKap($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function tabel_kap_dapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;
            $objek = "View";

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KapModel->GetKantorKapId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanKap;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan = '1' ";
                $get2 = $this->KapModel->GetKap($where2)->result();

                foreach ($get2 as $g2) {

                    $id_status = $g2->id_statusPerusahaan;
                    $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('kap/kapDetail/') . $g2->id . '">' . $g2->namaKantorKap . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $g2->id . ')">' . $objek . '</a>',
                        $g2->nomorRekanan,
                        $g2->jatuhTempoKap,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;
            $objek = "View";

            $where1 = "";
            $get1 = $this->KapModel->GetKap('WHERE dateCreatePerusahaanKap LIKE "%' . $_POST['periode'] . '%" AND dateDeletePerusahaanKap = "0000-00-00"  AND id_statusPerusahaan = "1" ')->result();
            foreach ($get1 as $g1) {

                $id_status = $g1->id_statusPerusahaan;
                $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('kap/kapDetail/') . $g1->id . '">' . $g1->namaKantorKap . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $g1->id . ')">' . $objek . '</a>',
                    $g1->nomorRekanan,
                    $g1->jatuhTempoKap,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKap($where1)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKap($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;
            $objek = "View";

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KapModel->GetKantorKapId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanKap;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreatePerusahaanKap LIKE '%" . $_POST['periode'] . "%' AND dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan = '1' ";
                $get2 = $this->KapModel->GetKap($where2)->result();

                foreach ($get2 as $g2) {

                    $id_status = $g2->id_statusPerusahaan;
                    $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('kap/kapDetail/') . $g2->id . '">' . $g2->namaKantorKap . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $g2->id . ')">' . $objek . '</a>',
                        $g2->nomorRekanan,
                        $g2->jatuhTempoKap,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan = '1' ";
            $data1 = $this->KapModel->GetKap($where)->result();

            $data = array();

            $no = 1;
            $objek = "View";

            foreach ($data1 as $d) {
                $id_status = $d->id_statusPerusahaan;
                $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('kap/kapDetail/') . $d->id . '">' . $d->namaKantorKap . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $d->id . ')">' . $objek . '</a>',
                    $d->nomorRekanan,
                    $d->jatuhTempoKap,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKap($where)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKap($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function tabel_kap_tidakDapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;
            $objek = "View";

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KapModel->GetKantorKapId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanKap;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan = '2' ";
                $get2 = $this->KapModel->GetKap($where2)->result();

                foreach ($get2 as $g2) {

                    $id_status = $g2->id_statusPerusahaan;
                    $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('kap/kapDetail/') . $g2->id . '">' . $g2->namaKantorKap . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $g2->id . ')">' . $objek . '</a>',
                        $g2->nomorRekanan,
                        $g2->jatuhTempoKap,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;
            $objek = "View";

            $where1 = "";
            $get1 = $this->KapModel->GetKap('WHERE dateCreatePerusahaanKap LIKE "%' . $_POST['periode'] . '%" AND dateDeletePerusahaanKap = "0000-00-00"  AND id_statusPerusahaan = "2" ')->result();
            foreach ($get1 as $g1) {

                $id_status = $g1->id_statusPerusahaan;
                $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('kap/kapDetail/') . $g1->id . '">' . $g1->namaKantorKap . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $g1->id . ')">' . $objek . '</a>',
                    $g1->nomorRekanan,
                    $g1->jatuhTempoKap,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKap($where1)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKap($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;
            $objek = "View";

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KapModel->GetKantorKapId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanKap;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreatePerusahaanKap LIKE '%" . $_POST['periode'] . "%' AND dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan = '2' ";
                $get2 = $this->KapModel->GetKap($where2)->result();

                foreach ($get2 as $g2) {

                    $id_status = $g2->id_statusPerusahaan;
                    $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('kap/kapDetail/') . $g2->id . '">' . $g2->namaKantorKap . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $g2->id . ')">' . $objek . '</a>',
                        $g2->nomorRekanan,
                        $g2->jatuhTempoKap,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan = '2' ";
            $data1 = $this->KapModel->GetKap($where)->result();

            $data = array();

            $no = 1;
            $objek = "View";

            foreach ($data1 as $d) {
                $id_status = $d->id_statusPerusahaan;
                $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('kap/kapDetail/') . $d->id . '">' . $d->namaKantorKap . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $d->id . ')">' . $objek . '</a>',
                    $d->nomorRekanan,
                    $d->jatuhTempoKap,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKap($where)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKap($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function tabel_kap_terbatas()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;
            $objek = "View";

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KapModel->GetKantorKapId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanKap;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan = '4' ";
                $get2 = $this->KapModel->GetKap($where2)->result();

                foreach ($get2 as $g2) {

                    $id_status = $g2->id_statusPerusahaan;
                    $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('kap/kapDetail/') . $g2->id . '">' . $g2->namaKantorKap . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $g2->id . ')">' . $objek . '</a>',
                        $g2->nomorRekanan,
                        $g2->jatuhTempoKap,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;
            $objek = "View";

            $where1 = "";
            $get1 = $this->KapModel->GetKap('WHERE dateCreatePerusahaanKap LIKE "%' . $_POST['periode'] . '%" AND dateDeletePerusahaanKap = "0000-00-00"  AND id_statusPerusahaan = "4" ')->result();
            foreach ($get1 as $g1) {

                $id_status = $g1->id_statusPerusahaan;
                $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('kap/kapDetail/') . $g1->id . '">' . $g1->namaKantorKap . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $g1->id . ')">' . $objek . '</a>',
                    $g1->nomorRekanan,
                    $g1->jatuhTempoKap,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKap($where1)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKap($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;
            $objek = "View";

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->KapModel->GetKantorKapId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanKap;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreatePerusahaanKap LIKE '%" . $_POST['periode'] . "%' AND dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan = '4' ";
                $get2 = $this->KapModel->GetKap($where2)->result();

                foreach ($get2 as $g2) {

                    $id_status = $g2->id_statusPerusahaan;
                    $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('kap/kapDetail/') . $g2->id . '">' . $g2->namaKantorKap . '</a>',
                        '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $g2->id . ')">' . $objek . '</a>',
                        $g2->nomorRekanan,
                        $g2->jatuhTempoKap,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKantorKapId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan = '4' ";
            $data1 = $this->KapModel->GetKap($where)->result();

            $data = array();

            $no = 1;
            $objek = "View";

            foreach ($data1 as $d) {
                $id_status = $d->id_statusPerusahaan;
                $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('kap/kapDetail/') . $d->id . '">' . $d->namaKantorKap . '</a>',
                    '<a href="#" data-toggle="modal" data-target="#kapObjek" onclick="goView(' . $d->id . ')">' . $objek . '</a>',
                    $d->nomorRekanan,
                    $d->jatuhTempoKap,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->KapModel->GetKap($where)->num_rows(),
                "recordsFiltered" => $this->KapModel->GetKap($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function kapDetail($id)
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['dataKap'] = $this->KapModel->GetKap("WHERE id = " . $id . " AND id_statusPerusahaan <> 3 ")->result();
        $data['title'] = 'Kap';
        $data['subtitle'] = 'Akuntan Publik';
        $data['idKap'] = $id;
        $data['statusAkuntan'] = $this->KapModel->GetStatus()->result();
        $data['sanksi'] = $this->KapModel->GetSanksi()->result();
        $data['provinsi'] = $this->ProvinsiModel->view();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kap/detail', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_kap', $data);
    }

    public function kapDetailAkuntan($id)
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $aktif = array('tb_akuntanpublik.id' => $id);
        $data['dataAkuntan'] = $this->KapModel->GetAkuntanDetail($aktif);
        $data['title'] = 'Kap';
        $data['subtitle'] = 'Akuntan Publik';
        $data['idKap'] = $id;
        $data['statusAkuntan'] = $this->KapModel->GetStatus()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kap/detailAkuntan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_kap', $data);
    }


    public function tabel_kap_akuntan()
    {

        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $id = $_POST['idKap'];

        $where = "WHERE id_perusahaanKap = " . $id . " AND dateDeleteAkuntanPublik = '0000-00-00' AND id_status <> 3 ";

        $data1 = $this->KapModel->GetAkuntan($where)->result();

        $data = array();

        $no = 1;

        foreach ($data1 as $d) {
            $id_provinsi = $d->id_provinsi;
            $id_kota = $d->id_kota;

            $check3 = $this->KapModel->GetProvinsi("WHERE id = " . $id_provinsi)->result();
            foreach ($check3 as $c3) {
                $provinsi = $c3->nama_provinsi;
            }

            $check4 = $this->KapModel->GetKota("WHERE id = " . $id_kota)->result();
            foreach ($check4 as $c4) {
                $kota = $c4->nama_kota;
            }

            $id_status = $d->id_status;
            $check6 = $this->KapModel->GetStatus("WHERE id = " . $id_status)->result();
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
                '<a href="' . base_url('kap/kapDetailAkuntan/') . $d->id . '">' . $d->namaAkuntan . '</a>',
                $d->statusKantor,
                $provinsi,
                $kota,
                $d->alamat,
                $statusArray
            );
            $no++;
        }



        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->KapModel->GetAkuntan($where)->num_rows(),
            "recordsFiltered" => $this->KapModel->GetAkuntan($where)->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function tabel_kap_objek()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $data = array();
        $no = 1;

        $idKap = $this->input->post('idKap');

        $where1 = "WHERE idKap = " . $idKap;
        $get1 = $this->KapModel->GetKapSektor($where1)->result();
        foreach ($get1 as $g1) {
            $idSektor = $g1->idSektor;

            $where2 = "WHERE id = " . $idSektor;
            $get2 = $this->KapModel->GetSektor($where2)->result();
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
            "recordsTotal" => $this->KapModel->GetKapSektor($where1)->num_rows(),
            "recordsFiltered" => $this->KapModel->GetKapSektor($where1)->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function kapAdd()
    {
        if ($_SESSION['role_id'] == 1) {
            $data['title'] = 'Kap';
            $data['subtitle'] = 'Tambah Akuntan Publik';
            $data['lastKapId'] = $this->KapModel->GetLatestKapId();
            $data['lastAkuntanPublikId'] = $this->KapModel->GetLatestAkuntanPublikId();
            $data['status'] = $this->KapModel->GetStatus()->result();
            $data['sanksi'] = $this->KapModel->GetSanksi()->result();
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kap/kapAdd', $data);
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

    public function newKap()
    {
        $namaKantorKap = $_POST['namaKantorKap'];
        $nomorRekanan = $_POST['nomorRekanan'];
        $jatuhTempoKap = $_POST['jatuhTempoKap'];
        $nilaiKap = $_POST['nilaiKap'];
        $keteranganKap = $_POST['keteranganKap'];
        $id_statusPerusahaan = $_POST['id_statusPerusahaan'];
        $id_sanksi = $_POST['id_sanksi'];
        $today = date("Y-m-d");
        $nullDate = "0000-00-00";

        if ($id_statusPerusahaan != 'volvo') {
            $datains = array(
                'namaKantorKap' => $namaKantorKap,
                'nomorRekanan' => $nomorRekanan,
                'jatuhTempoKap' => $jatuhTempoKap,
                'nilaiKap' => $nilaiKap,
                'keteranganKap' => $keteranganKap,
                'id_statusPerusahaan' => $id_statusPerusahaan,
                'id_sanksi' => $id_sanksi,
                'dateCreatePerusahaanKap' => $today,
                'dateDeletePerusahaanKap' => $nullDate,
            );
            $ins = $this->db->insert('tb_perusahaankap', $datains);

            if ($ins > 0) {
                $where = "WHERE namaKantorKap = '" . $namaKantorKap . "' AND nomorRekanan = '" . $nomorRekanan . "'";
                $get = $this->KapModel->GetKap($where)->result();
                foreach ($get as $g) {
                    $idKap = $g->id;
                }
                $this->session->set_flashdata('successAlert', 'Input KAP Sukses! Silakan isi data pelengkap lainnya.');
                redirect(base_url('kap/kapDetail/' . $idKap), 'refresh');
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terdapat kesalahan ketika menghubungkan ke database.');
                redirect(base_url('kap/kapAdd'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Mohon pastikan semua isian telah terisi dengan benar.');
            redirect(base_url('kap/kapAdd'), 'refresh');
        }
    }

    public function tambahAkuntanKap()
    {
        $id_perusahaanKap = $_POST['id_perusahaanKap'];
        $namaAkuntan = $_POST['namaAkuntan'];
        $statusKantor = $_POST['statusKantor'];
        $id_kota = $_POST['id_kota'];
        $id_provinsi = $_POST['id_provinsi'];
        $alamat = $_POST['alamat'];
        $phone = $_POST['phone'];
        $pasarModal = $_POST['pasarModal'];
        $perbankan = $_POST['perbankan'];
        $iknb = $_POST['iknb'];
        $id_status = $_POST['id_status'];
        $id_sanksi = $_POST['id_sanksi'];
        $keterangan = $_POST['keterangan'];
        $today = date("Y-m-d");
        $nullDate = "0000-00-00";

        if ($pasarModal != 'volvo' && $perbankan != 'volvo' && $id_status != 'volvo' && $iknb != 'volvo') {
            $datains = array(
                'id_perusahaanKap' => $id_perusahaanKap,
                'namaAkuntan' => $namaAkuntan,
                'statusKantor' => $statusKantor,
                'id_kota' => $id_kota,
                'id_provinsi' => $id_provinsi,
                'alamat' => $alamat,
                'phone' => $phone,
                'pasarModal' => $pasarModal,
                'perbankan' => $perbankan,
                'iknb' => $iknb,
                'keterangan' => $keterangan,
                'id_status' => $id_status,
                'id_sanksi' => $id_sanksi,
                'dateCreateAkuntanPublik' => $today,
                'dateDeleteAkuntanPublik' => $nullDate,
            );
            $ins = $this->db->insert('tb_akuntanpublik', $datains);

            if ($ins > 0) {
                $this->session->set_flashdata('successAlert', 'Tambah Akuntan Publik Sukses!');
                redirect(base_url('kap/kapDetail/' . $id_perusahaanKap), 'refresh');
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika menghubungkan dengan pusat data!');
                redirect(base_url('kap/kapDetail/' . $id_perusahaanKap), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Pastikan semua kolom isian telah terisi dengan sempurna!');
            redirect(base_url('kap/kapDetail/' . $id_perusahaanKap), 'refresh');
        }
    }

    public function uploadKap()
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

                if ($file_name == 'perusahaanKap.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_perusahaankap FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Instansi KAP Sukses!');
                        redirect(base_url('kap/kapAdd'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('kap/kapAdd'), 'refresh');
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
                } else if ($file_name == 'akuntanPublik.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_akuntanpublik FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Akuntan Publik Sukses!');
                        redirect(base_url('kap/kapAdd'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('kap/kapAdd'), 'refresh');
                    }
                } else {
                    unlink("./assets/csv/" . $file_name);

                    $this->session->set_flashdata('dangerAlert', 'Nama file salah!');
                    redirect(base_url('kap/kapAdd'), 'refresh');
                }
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengunggah data!');
                redirect(base_url('kap/kapAdd'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Tidak ada file ditemukan!');
            redirect(base_url('kap/kapAdd'), 'refresh');
        }
    }
}
