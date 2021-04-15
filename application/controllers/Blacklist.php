<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BlackList extends CI_Controller
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

    public function kap()
    {
        $data['title'] = 'KAP BlackList';
        $data['subtitle'] = 'KAP BlackList';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('blacklist/kap', $data);
        $this->load->view('templates/footer');
    }

    public function kjpp()
    {
        $data['title'] = 'KJPP BlackList';
        $data['subtitle'] = 'KJPP BlackList';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('blacklist/kjpp', $data);
        $this->load->view('templates/footer');
    }

    public function bls()
    {
        $data['title'] = 'Balai Lelang Swasta BlackList';
        $data['subtitle'] = 'Balai Lelang Swasta BlackList';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('blacklist/bls', $data);
        $this->load->view('templates/footer');
    }

    public function notaris()
    {
        $data['title'] = 'Notaris BlackList';
        $data['subtitle'] = 'Notaris BlackList';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('blacklist/notaris', $data);
        $this->load->view('templates/footer');
    }

    public function aj()
    {
        $data['title'] = 'Asuransi Jiwa BlackList';
        $data['subtitle'] = 'Asuransi Jiwa BlackList';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('blacklist/aj', $data);
        $this->load->view('templates/footer');
    }

    public function ak()
    {
        $data['title'] = 'Asuransi Kerugian BlackList';
        $data['subtitle'] = 'Asuransi Kerugian BlackList';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('blacklist/ak', $data);
        $this->load->view('templates/footer');
    }

    public function mi()
    {
        $data['title'] = 'Manager Investasi BlackList';
        $data['subtitle'] = 'Manager Investasi BlackList';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('blacklist/mi', $data);
        $this->load->view('templates/footer');
    }

    public function mb()
    {
        $data['title'] = 'Money Broker BlackList';
        $data['subtitle'] = 'Money Broker BlackList';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('blacklist/mb', $data);
        $this->load->view('templates/footer');
    }

    public function pa()
    {
        $data['title'] = 'Pialang Asuransi BlackList';
        $data['subtitle'] = 'Pialang Asuransi BlackList';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('blacklist/pa', $data);
        $this->load->view('templates/footer');
    }

    public function konsultan()
    {
        $data['title'] = 'Konsultan BlackList';
        $data['subtitle'] = 'Konsultan BlackList';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('blacklist/konsultan', $data);
        $this->load->view('templates/footer');
    }

    public function tabel_kap_blacklist()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));


        $where = "WHERE dateDeletePerusahaanKap = '0000-00-00' AND id_statusPerusahaan = '3' ";
        $data1 = $this->KapModel->GetKap($where)->result();

        $data = array();

        $no = 1;

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
                $d->namaKantorKap,
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

    public function tabel_kap_akuntanblacklist()
    {

        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $where = "WHERE dateDeleteAkuntanPublik = '0000-00-00' AND id_status = 3 ";

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
                $d->namaAkuntan,
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

    public function tabel_kjpp_blacklist()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $where = "WHERE dateDeleteKjpp = '0000-00-00' AND id_status = 3 ";
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
                $d->namaPerusahaanKjpp,
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

    public function tabel_kjpp_penilaiblacklist()
    {

        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $where = "WHERE dateDeletePenilaiPublik = '0000-00-00' AND id_status = 3 ";

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
                $d->penilaiPublik,
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

    public function tabel_bls_blacklist()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $where = "WHERE dateDeleteBLS = '0000-00-00' AND id_status = 3";
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
                $d->namaPerusahaan,
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

    public function tabel_bls_detailblacklist()
    {

        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $where = "WHERE dateDeleteBLS = '0000-00-00' AND id_status = 3";

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

    public function tabel_notaris_perusahaanblacklist()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $where = "WHERE dateDeleteNotaris = '0000-00-00' AND id_status = '3' ";
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

    public function tabel_aj_blacklist()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $where = "WHERE dateDeleteAj = '0000-00-00' AND id_status = '3' ";
        $data1 = $this->AjModel->getAj($where)->result();

        $data = array();

        $no = 1;

        foreach ($data1 as $g1) {

            $id_status = $g1->id_status;
            $check1 = $this->AjModel->getStatus("WHERE id = " . $id_status)->result();
            foreach ($check1 as $c1) {
                $status = $c1->jenis_status;
                if ($status == 'Diizinkan') {
                    $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                } else {
                    $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                }
            }

            $data[] = array(
                $no,
                '<a href="' . base_url('asuransi_jiwa/ajDetail/') . $g1->id . '">' . $g1->namaAsuransi . '</a>',
                $g1->alamat,
                $g1->pic,
                $g1->contact,
                $statusArray
            );
            $no++;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->AjModel->getAj($where)->num_rows(),
            "recordsFiltered" => $this->AjModel->getAj($where)->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function tabel_ak_blacklist()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $where = "WHERE dateDelete = '0000-00-00' AND id_status = '3' ";
        $data1 = $this->AkModel->getAk($where)->result();

        $data = array();

        $no = 1;

        foreach ($data1 as $g1) {

            $id_status = $g1->id_status;
            $check1 = $this->AkModel->getStatus("WHERE id = " . $id_status)->result();
            foreach ($check1 as $c1) {
                $status = $c1->jenis_status;
                if ($status == 'Diizinkan') {
                    $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                } else {
                    $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                }
            }

            $data[] = array(
                $no,
                $g1->namaAsuransi,
                $g1->alamat,
                $g1->pic,
                $g1->contact,
                $statusArray
            );
            $no++;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->AkModel->getAk($where)->num_rows(),
            "recordsFiltered" => $this->AkModel->getAk($where)->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function tabel_mi_blacklist()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $where = "WHERE dateDelete = '0000-00-00' AND id_status = '3' ";
        $data1 = $this->MiModel->getMi($where)->result();

        $data = array();

        $no = 1;

        foreach ($data1 as $g1) {

            $id_status = $g1->id_status;
            $check1 = $this->MiModel->getStatus("WHERE id = " . $id_status)->result();
            foreach ($check1 as $c1) {
                $status = $c1->jenis_status;
                if ($status == 'Diizinkan') {
                    $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                } else {
                    $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                }
            }

            $data[] = array(
                $no,
                $g1->namaPerusahaan,
                $g1->alamat,
                $g1->pic,
                $g1->contact,
                $statusArray
            );
            $no++;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->MiModel->getMi($where)->num_rows(),
            "recordsFiltered" => $this->MiModel->getMi($where)->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function tabel_mb_blacklist()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $where = "WHERE dateDelete = '0000-00-00' AND id_status = '3' ";
        $data1 = $this->MbModel->getMb($where)->result();

        $data = array();

        $no = 1;

        foreach ($data1 as $g1) {

            $id_kota = $g1->id_kota;
            $check2 = $this->MbModel->GetKota("WHERE id = " . $id_kota)->result();
            foreach ($check2 as $c2) {
                $kota = $c2->nama_kota;
            }

            $id_status = $g1->id_status;
            $check1 = $this->MbModel->getStatus("WHERE id = " . $id_status)->result();
            foreach ($check1 as $c1) {
                $status = $c1->jenis_status;
                if ($status == 'Diizinkan') {
                    $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                } else {
                    $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                }
            }

            $data[] = array(
                $no,
                $g1->namaPerusahaan,
                $g1->statusKantor,
                $g1->nomorRekanan,
                $kota,
                $g1->alamat,
                $statusArray
            );
            $no++;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->MbModel->getMb($where)->num_rows(),
            "recordsFiltered" => $this->MbModel->getMb($where)->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function tabel_ps_blacklist()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $where = "WHERE dateDelete = '0000-00-00' AND id_status = '3' ";
        $data1 = $this->PsModel->getPs($where)->result();

        $data = array();

        $no = 1;

        foreach ($data1 as $g1) {

            $id_kota = $g1->id_kota;
            $check2 = $this->PsModel->GetKota("WHERE id = " . $id_kota)->result();
            foreach ($check2 as $c2) {
                $kota = $c2->nama_kota;
            }

            $id_status = $g1->id_status;
            $check1 = $this->PsModel->getStatus("WHERE id = " . $id_status)->result();
            foreach ($check1 as $c1) {
                $status = $c1->jenis_status;
                if ($status == 'Diizinkan') {
                    $statusArray = '<span class="badge badge-success">' . $status . '</span>';
                } else {
                    $statusArray = '<span class="badge badge-danger">' . $status . '</span>';
                }
            }

            $data[] = array(
                $no,
                $g1->namaPerusahaan,
                $kota,
                $g1->alamat,
                $g1->phone,
                $statusArray,
            );
            $no++;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->PsModel->getPs($where)->num_rows(),
            "recordsFiltered" => $this->PsModel->getPs($where)->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function tabel_konsultan_blacklist()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $where = "WHERE dateDelete = '0000-00-00' AND id_status = 3 ";
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
                $d->namaPerusahaan,
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
