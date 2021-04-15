<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bls extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // is_log_in();
        $this->load->model('ProvinsiModel');
        $this->load->model('KotaModel');
        $this->load->model('BlsModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['totalKantor'] = $this->BlsModel->kantor()->result_array();
        $data['blsPerusahaan'] = $this->BlsModel->all("WHERE id_status <> 3")->result_array();
        $data['blsDitolak'] = $this->BlsModel->all("WHERE id_status = 2")->result_array();
        $data['blsDizinkan'] = $this->BlsModel->all("WHERE id_status = 1")->result_array();
        $data['blsTerbatas'] = $this->BlsModel->all("WHERE id_status = 4")->result_array();
        $data['title'] = 'Bls';
        $data['subtitle'] = 'Balai Lelang Swasta';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bls/index', $data);
        $this->load->view('templates/footer');
    }

    public function blsPerusahaan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->BlsModel->GetPeriode()->result();
        $data['title'] = 'Bls';
        $data['subtitle'] = 'Balai Lelang Swasta';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bls/blsView', $data);
        $this->load->view('templates/footer');
    }

    public function blsDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->BlsModel->GetPeriode()->result();
        $data['title'] = 'Bls';
        $data['subtitle'] = 'Balai Lelang Swasta';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bls/blsDapatDigunakanView', $data);
        $this->load->view('templates/footer');
    }

    public function blsTidakDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->BlsModel->GetPeriode()->result();
        $data['title'] = 'Bls';
        $data['subtitle'] = 'Balai Lelang Swasta';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bls/blsTidakDapatDigunakanView', $data);
        $this->load->view('templates/footer');
    }

    public function blsTerbatas()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->BlsModel->GetPeriode()->result();
        $data['title'] = 'Bls';
        $data['subtitle'] = 'Balai Lelang Swasta';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bls/blsTerbatasView', $data);
        $this->load->view('templates/footer');
    }

    public function tabel_bls_perusahaan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->BlsModel->GetKantorBlsId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanBLS;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeleteBLS = '0000-00-00' AND id_status <> 3 ";
                $get2 = $this->BlsModel->GetBls($where2)->result();

                foreach ($get2 as $g2) {
                    $id_status = $g2->id_status;
                    $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('bls/blsDetail/') . $g2->id . '">' . $g2->namaPerusahaan . '</a>',
                        $g2->nomorRekanan,
                        $g2->suratRekanan,
                        $g2->penanggungJawab,
                        $g2->jatuhTempo,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->BlsModel->GetBls('WHERE dateCreateBLS LIKE "%' . $_POST['periode'] . '%" AND dateDeleteBLS = "0000-00-00" AND id_status <> 3')->result();
            foreach ($get1 as $g1) {
                $id_status = $g1->id_status;
                $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('bls/blsDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $g1->nomorRekanan,
                    $g1->suratRekanan,
                    $g1->penanggungJawab,
                    $g1->jatuhTempo,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetBls($where1)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetBls($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->BlsModel->GetKantorBlsId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanBLS;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreateBLS LIKE '%" . $_POST['periode'] . "%' AND dateDeleteBLS = '0000-00-00' AND id_status <> 3 ";
                $get2 = $this->BlsModel->GetBls($where2)->result();

                foreach ($get2 as $g2) {
                    $id_status = $g2->id_status;
                    $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('bls/blsDetail/') . $g2->id . '">' . $g2->namaPerusahaan . '</a>',
                        $g2->nomorRekanan,
                        $g2->suratRekanan,
                        $g2->penanggungJawab,
                        $g2->jatuhTempo,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeleteBLS = '0000-00-00' AND id_status <> 3";
            $data1 = $this->BlsModel->GetBls($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {
                $id_status = $d->id_status;
                $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('bls/blsDetail/') . $d->id . '">' . $d->namaPerusahaan . '</a>',
                    $d->nomorRekanan,
                    $d->suratRekanan,
                    $d->penanggungJawab,
                    $d->jatuhTempo,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetBls($where)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetBls($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function tabel_bls_dapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->BlsModel->GetKantorBlsId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanBLS;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeleteBLS = '0000-00-00' AND id_status= '1' ";
                $get2 = $this->BlsModel->GetBls($where2)->result();

                foreach ($get2 as $g2) {
                    $id_status = $g2->id_status;
                    $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('bls/blsDetail/') . $g2->id . '">' . $g2->namaPerusahaan . '</a>',
                        $g2->nomorRekanan,
                        $g2->suratRekanan,
                        $g2->penanggungJawab,
                        $g2->jatuhTempo,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->BlsModel->GetBls('WHERE dateCreateBLS LIKE "%' . $_POST['periode'] . '%" AND dateDeleteBLS = "0000-00-00" AND id_status= "1" ')->result();
            foreach ($get1 as $g1) {
                $id_status = $g1->id_status;
                $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('bls/blsDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $g1->nomorRekanan,
                    $g1->suratRekanan,
                    $g1->penanggungJawab,
                    $g1->jatuhTempo,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetBls($where1)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetBls($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->BlsModel->GetKantorBlsId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanBLS;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreateBLS LIKE '%" . $_POST['periode'] . "%' AND dateDeleteBLS = '0000-00-00' AND id_status= '1' ";
                $get2 = $this->BlsModel->GetBls($where2)->result();

                foreach ($get2 as $g2) {
                    $id_status = $g2->id_status;
                    $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('bls/blsDetail/') . $g2->id . '">' . $g2->namaPerusahaan . '</a>',
                        $g2->nomorRekanan,
                        $g2->suratRekanan,
                        $g2->penanggungJawab,
                        $g2->jatuhTempo,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeleteBLS = '0000-00-00' AND id_status= '1' ";
            $data1 = $this->BlsModel->GetBls($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {
                $id_status = $d->id_status;
                $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('bls/blsDetail/') . $d->id . '">' . $d->namaPerusahaan . '</a>',
                    $d->nomorRekanan,
                    $d->suratRekanan,
                    $d->penanggungJawab,
                    $d->jatuhTempo,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetBls($where)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetBls($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function tabel_bls_tidakDapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->BlsModel->GetKantorBlsId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanBLS;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeleteBLS = '0000-00-00' AND id_status= '2' ";
                $get2 = $this->BlsModel->GetBls($where2)->result();

                foreach ($get2 as $g2) {
                    $id_status = $g2->id_status;
                    $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('bls/blsDetail/') . $g2->id . '">' . $g2->namaPerusahaan . '</a>',
                        $g2->nomorRekanan,
                        $g2->suratRekanan,
                        $g2->penanggungJawab,
                        $g2->jatuhTempo,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->BlsModel->GetBls('WHERE dateCreateBLS LIKE "%' . $_POST['periode'] . '%" AND dateDeleteBLS = "0000-00-00" AND id_status= "2" ')->result();
            foreach ($get1 as $g1) {
                $id_status = $g1->id_status;
                $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('bls/blsDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $g1->nomorRekanan,
                    $g1->suratRekanan,
                    $g1->penanggungJawab,
                    $g1->jatuhTempo,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetBls($where1)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetBls($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->BlsModel->GetKantorBlsId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanBLS;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreateBLS LIKE '%" . $_POST['periode'] . "%' AND dateDeleteBLS = '0000-00-00' AND id_status= '2' ";
                $get2 = $this->BlsModel->GetBls($where2)->result();

                foreach ($get2 as $g2) {
                    $id_status = $g2->id_status;
                    $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('bls/blsDetail/') . $g2->id . '">' . $g2->namaPerusahaan . '</a>',
                        $g2->nomorRekanan,
                        $g2->suratRekanan,
                        $g2->penanggungJawab,
                        $g2->jatuhTempo,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeleteBLS = '0000-00-00' AND id_status= '2' ";
            $data1 = $this->BlsModel->GetBls($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {
                $id_status = $d->id_status;
                $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('bls/blsDetail/') . $d->id . '">' . $d->namaPerusahaan . '</a>',
                    $d->nomorRekanan,
                    $d->suratRekanan,
                    $d->penanggungJawab,
                    $d->jatuhTempo,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetBls($where)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetBls($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function tabel_bls_terbatas()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['id_kota']) && !isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->BlsModel->GetKantorBlsId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanBLS;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateDeleteBLS = '0000-00-00' AND id_status= '4' ";
                $get2 = $this->BlsModel->GetBls($where2)->result();

                foreach ($get2 as $g2) {
                    $id_status = $g2->id_status;
                    $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('bls/blsDetail/') . $g2->id . '">' . $g2->namaPerusahaan . '</a>',
                        $g2->nomorRekanan,
                        $g2->suratRekanan,
                        $g2->penanggungJawab,
                        $g2->jatuhTempo,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['periode']) && !isset($_POST['id_kota'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->BlsModel->GetBls('WHERE dateCreateBLS LIKE "%' . $_POST['periode'] . '%" AND dateDeleteBLS = "0000-00-00" AND id_status= "4" ')->result();
            foreach ($get1 as $g1) {
                $id_status = $g1->id_status;
                $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('bls/blsDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $g1->nomorRekanan,
                    $g1->suratRekanan,
                    $g1->penanggungJawab,
                    $g1->jatuhTempo,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetBls($where1)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetBls($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else if (isset($_POST['id_kota']) && isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "WHERE id_kota = " . $_POST['id_kota'];
            $get1 = $this->BlsModel->GetKantorBlsId($where1)->result();
            foreach ($get1 as $g1) {
                $id_perusahaan = $g1->id_perusahaanBLS;
                $where2 = "WHERE id = " . $id_perusahaan . " AND dateCreateBLS LIKE '%" . $_POST['periode'] . "%' AND dateDeleteBLS = '0000-00-00' AND id_status= '4' ";
                $get2 = $this->BlsModel->GetBls($where2)->result();

                foreach ($get2 as $g2) {
                    $id_status = $g2->id_status;
                    $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                        '<a href="' . base_url('bls/blsDetail/') . $g2->id . '">' . $g2->namaPerusahaan . '</a>',
                        $g2->nomorRekanan,
                        $g2->suratRekanan,
                        $g2->penanggungJawab,
                        $g2->jatuhTempo,
                        $statusArray
                    );
                    $no++;
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetKantorBlsId($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeleteBLS = '0000-00-00' AND id_status= '4' ";
            $data1 = $this->BlsModel->GetBls($where)->result();

            $data = array();

            $no = 1;

            foreach ($data1 as $d) {
                $id_status = $d->id_status;
                $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                    '<a href="' . base_url('bls/blsDetail/') . $d->id . '">' . $d->namaPerusahaan . '</a>',
                    $d->nomorRekanan,
                    $d->suratRekanan,
                    $d->penanggungJawab,
                    $d->jatuhTempo,
                    $statusArray
                );
                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->BlsModel->GetBls($where)->num_rows(),
                "recordsFiltered" => $this->BlsModel->GetBls($where)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        }
    }

    public function blsDetail($id)
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['dataBls'] = $this->BlsModel->GetBls("WHERE id = " . $id)->result();
        $data['title'] = 'Bls';
        $data['subtitle'] = 'Balai Lelang Swasta';
        $data['idBls'] = $id;
        $data['status'] = $this->BlsModel->GetStatus()->result();
        $data['sanksi'] = $this->BlsModel->GetSanksi()->result();
        $data['provinsi'] = $this->ProvinsiModel->view();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bls/detail', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_bls', $data);
    }

    public function tabel_bls_detail()
    {

        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $id = $_POST['idBls'];

        $where = "WHERE id_perusahaanBLS = " . $id . " AND dateDeleteBLS = '0000-00-00'";

        $data1 = $this->BlsModel->GetKantorBls($where)->result();

        $data = array();

        $no = 1;

        foreach ($data1 as $d) {
            $id_provinsi = $d->id_provinsi;
            $id_kota = $d->id_kota;

            $check3 = $this->BlsModel->GetProvinsi("WHERE id = " . $id_provinsi)->result();
            foreach ($check3 as $c3) {
                $provinsi = $c3->nama_provinsi;
            }

            $check4 = $this->BlsModel->GetKota("WHERE id = " . $id_kota)->result();
            foreach ($check4 as $c4) {
                $kota = $c4->nama_kota;
            }

            $id_status = $d->id_status;
            $check6 = $this->BlsModel->GetStatus("WHERE id = " . $id_status)->result();
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
                $d->jenisKantor,
                $provinsi,
                $kota,
                $d->alamat,
                $d->phone,
                $d->fax,
                $statusArray
            );
            $no++;
        }



        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->BlsModel->GetKantorBls($where)->num_rows(),
            "recordsFiltered" => $this->BlsModel->GetKantorBls($where)->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function blsAdd()
    {
        if ($_SESSION['role_id'] == 1) {
            $data['title'] = 'Bls';
            $data['subtitle'] = 'Tambah Balai Lelang';
            $data['lastBlsId'] = $this->BlsModel->GetLatestBlsId();
            $data['lastKantorBlsId'] = $this->BlsModel->GetLatestKantorBlsId();
            $data['status'] = $this->BlsModel->GetStatus()->result();
            $data['sanksi'] = $this->BlsModel->GetSanksi()->result();
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('bls/blsAdd', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('kjpp');
        }
    }




    // Fungsi CRUD

    public function newBls()
    {
        $namaPerusahaan = $_POST['namaPerusahaan'];
        $nomorRekanan = $_POST['nomorRekanan'];
        $jatuhTempo = $_POST['jatuhTempo'];
        $penanggungJawab = $_POST['penanggungJawab'];
        $suratRekanan = $_POST['suratRekanan'];
        $id_status = $_POST['id_status'];
        $id_sanksi = $_POST['id_sanksi'];
        $today = date("Y-m-d");
        $nullDate = "0000-00-00";

        if ($jatuhTempo != '') {
            $datains = array(
                'namaPerusahaan' => $namaPerusahaan,
                'nomorRekanan' => $nomorRekanan,
                'jatuhTempo' => $jatuhTempo,
                'penanggungJawab' => $penanggungJawab,
                'suratRekanan' => $suratRekanan,
                'id_status' => $id_status,
                'id_sanksi' => $id_sanksi,
                'dateCreateBLS' => $today,
                'dateDeleteBLS' => $nullDate,
                'dateUpdateBLS' => $nullDate,
            );
            $ins = $this->db->insert('tb_perusahaanbls', $datains);

            if ($ins > 0) {
                $where = "WHERE namaPerusahaan = '" . $namaPerusahaan . "' AND nomorRekanan = '" . $nomorRekanan . "'";
                $get = $this->BlsModel->GetBls($where)->result();
                foreach ($get as $g) {
                    $idBls = $g->id;
                }
                $this->session->set_flashdata('successAlert', 'Input KAP Sukses! Silakan isi data pelengkap lainnya.');
                redirect(base_url('bls/blsDetail/' . $idBls), 'refresh');
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terdapat kesalahan ketika menghubungkan ke database.');
                redirect(base_url('bls/blsAdd'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Mohon pastikan semua isian telah terisi dengan benar.');
            redirect(base_url('bls/blsAdd'), 'refresh');
        }
    }

    public function tambahKantorBls()
    {
        $id_perusahaanBLS = $_POST['id_perusahaanBLS'];
        $jenisKantor = $_POST['jenisKantor'];
        $id_kota = $_POST['id_kota'];
        $id_provinsi = $_POST['id_provinsi'];
        $alamat = $_POST['alamat'];
        $phone = $_POST['phone'];
        $fax = $_POST['fax'];
        $id_status = $_POST['id_status'];
        $id_sanksi = $_POST['id_sanksi'];
        $today = date("Y-m-d");
        $nullDate = "0000-00-00";

        if ($id_kota != 'volvo' && $id_provinsi != 'volvo' && $id_status != 'volvo') {
            $datains = array(
                'id_perusahaanBLS' => $id_perusahaanBLS,
                'jenisKantor' => $jenisKantor,
                'id_kota' => $id_kota,
                'id_provinsi' => $id_provinsi,
                'alamat' => $alamat,
                'phone' => $phone,
                'fax' => $fax,
                'id_status' => $id_status,
                'id_sanksi' => $id_sanksi,
                'dateCreateBLS' => $today,
                'dateDeleteBLS' => $nullDate,
                'dateUpdateBLS' => $nullDate
            );
            $ins = $this->db->insert('tb_kantorbls', $datains);

            if ($ins > 0) {
                $this->session->set_flashdata('successAlert', 'Tambah Lokasi BLS Sukses!');
                redirect(base_url('bls/blsDetail/' . $id_perusahaanBLS), 'refresh');
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika menghubungkan dengan pusat data!');
                redirect(base_url('bls/blsDetail/' . $id_perusahaanBLS), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Pastikan semua kolom isian telah terisi dengan sempurna!');
            redirect(base_url('bls/blsDetail/' . $id_perusahaanBLS), 'refresh');
        }
    }

    public function uploadBls()
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

                if ($file_name == 'perusahaanBls.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_perusahaanbls FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Instansi BLS Sukses!');
                        redirect(base_url('bls/blsAdd'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('bls/blsAdd'), 'refresh');
                    }
                } else if ($file_name == 'kantorBls.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_kantorbls FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Kantor BLS Sukses!');
                        redirect(base_url('bls/blsAdd'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('bls/blsAdd'), 'refresh');
                    }
                } else {
                    unlink("./assets/csv/" . $file_name);

                    $this->session->set_flashdata('dangerAlert', 'Nama file salah!');
                    redirect(base_url('bls/blsAdd'), 'refresh');
                }
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengunggah data!');
                redirect(base_url('bls/blsAdd'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Tidak ada file ditemukan!');
            redirect(base_url('bls/blsAdd'), 'refresh');
        }
    }
}
