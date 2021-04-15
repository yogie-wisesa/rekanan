<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MoneyBroker extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // is_log_in();
        $this->load->model('ProvinsiModel');
        $this->load->model('KotaModel');
        $this->load->model('WilayahModel');
        $this->load->model('MbModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['Mb'] = $this->MbModel->all("WHERE id_status <> 3")->result_array();
        $data['MbDiterima'] = $this->MbModel->all("WHERE id_status = 1")->result_array();
        $data['MbDitolak'] = $this->MbModel->all("WHERE id_status = 2")->result_array();
        $data['MbTerbatas'] = $this->MbModel->all("WHERE id_status = 4")->result_array();
        $data['title'] = 'MoneyBroker';
        $data['subtitle'] = 'Money Broker';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mb/index', $data);
        $this->load->view('templates/footer');
    }

    public function allMoneyBroker()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->MbModel->GetPeriode()->result();
        $data['title'] = 'MoneyBroker';
        $data['subtitle'] = 'Money Broker';
        $data['status'] = $this->MbModel->GetStatus()->result();
        $data['sanksi'] = $this->MbModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mb/mbView', $data);
        $this->load->view('templates/modal_mb');
        $this->load->view('templates/footer');
    }

    public function dapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->MbModel->GetPeriode()->result();
        $data['title'] = 'Money Broker';
        $data['subtitle'] = 'Money Broker';
        $data['sanksi'] = $this->MbModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mb/mbDapatDigunakanView', $data);
        $this->load->view('templates/modal_mb');
        $this->load->view('templates/footer');
    }

    public function tidakDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->MbModel->GetPeriode()->result();
        $data['title'] = 'Money Broker';
        $data['subtitle'] = 'Money Broker';
        $data['sanksi'] = $this->MbModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mb/mbTidakDapatDigunakanView', $data);
        $this->load->view('templates/modal_mb');
        $this->load->view('templates/footer');
    }

    public function terbatas()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->MbModel->GetPeriode()->result();
        $data['title'] = 'Money Broker';
        $data['subtitle'] = 'Money Broker';
        $data['sanksi'] = $this->MbModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mb/mbTerbatasView', $data);
        $this->load->view('templates/modal_mb');
        $this->load->view('templates/footer');
    }


    public function MbDetail($id)
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $aktif = array('tb_moneybroker.id' => $id);
        $data['dataMb'] = $this->MbModel->getMbDetail($aktif);
        $data['title'] = 'Money Broker';
        $data['subtitle'] = 'Money Broker';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mb/detailMb', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_kap', $data);
    }


    public function tabel_mb_perusahaan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->MbModel->getMb('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00"')->result();
            foreach ($get1 as $g1) {

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
                    '<a href="' . base_url('moneybroker/MbDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
                "recordsTotal" => $this->MbModel->getMb($where1)->num_rows(),
                "recordsFiltered" => $this->MbModel->getMb($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' ";
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
                    '<a href="' . base_url('moneybroker/MbDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
    }

    public function tabel_mb_dapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->MbModel->getMb('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = "1" ')->result();
            foreach ($get1 as $g1) {

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
                    '<a href="' . base_url('moneybroker/MbDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
                "recordsTotal" => $this->MbModel->getMb($where1)->num_rows(),
                "recordsFiltered" => $this->MbModel->getMb($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = '1' ";
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
                    '<a href="' . base_url('moneybroker/MbDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
    }

    public function tabel_mb_tidakDapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->MbModel->getMb('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = "2" ')->result();
            foreach ($get1 as $g1) {

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
                    '<a href="' . base_url('moneybroker/MbDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
                "recordsTotal" => $this->MbModel->getMb($where1)->num_rows(),
                "recordsFiltered" => $this->MbModel->getMb($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = '2' ";
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
                    '<a href="' . base_url('moneybroker/MbDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
    }

    public function tabel_mb_terbatas()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->MbModel->getMb('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = "4" ')->result();
            foreach ($get1 as $g1) {

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
                    '<a href="' . base_url('moneybroker/MbDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
                "recordsTotal" => $this->MbModel->getMb($where1)->num_rows(),
                "recordsFiltered" => $this->MbModel->getMb($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = '4' ";
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
                    '<a href="' . base_url('moneybroker/MbDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
    }

    public function mbAdd()
    {
        if ($_SESSION['role_id'] == 1) {
            $data['title'] = 'MoneyBroker';
            $data['subtitle'] = 'Tambah Money Broker';
            $data['lastMbId'] = $this->MbModel->GetLatestMbId();
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('mb/mbUpload', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('kjpp');
        }
    }




    // Fungsi CRUD

    public function newBroker()
    {
        $namaPerusahaan = $_POST['namaPerusahaan'];
        $statusKantor = $_POST['statusKantor'];
        $nomorRekanan = $_POST['nomorRekanan'];
        $pic = $_POST['pic'];
        $jatuhTempo = $_POST['jatuhTempo'];
        $alamat = $_POST['alamat'];
        $phone = $_POST['phone'];
        $fax = $_POST['fax'];
        $suratRekanan = $_POST['suratRekanan'];
        $keterangan = $_POST['keterangan'];
        $id_status = $_POST['id_status'];
        $id_sanksi = $_POST['id_sanksi'];
        $today = date("Y-m-d");
        $nullDate = "0000-00-00";

        if ($jatuhTempo != '' && $id_sanksi != 'volvo') {
            $datains = array(
                'namaPerusahaan' => $namaPerusahaan,
                'statusKantor' => $statusKantor,
                'nomorRekanan' => $nomorRekanan,
                'pic' => $pic,
                'jatuhTempo' => $jatuhTempo,
                'alamat' => $alamat,
                'phone' => $phone,
                'fax' => $fax,
                'suratRekanan' => $suratRekanan,
                'keterangan' => $keterangan,
                'id_status' => $id_status,
                'id_sanksi' => $id_sanksi,
                'dateCreate' => $today,
                'dateDelete' => $nullDate,
                'dateUpdate' => $nullDate,
            );
            $ins = $this->db->insert('tb_moneybroker', $datains);

            if ($ins > 0) {
                $this->session->set_flashdata('successAlert', 'Input Money Broker Berhasil!.');
                redirect(base_url('MoneyBroker/allMoneyBroker'), 'refresh');
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terdapat kesalahan ketika menghubungkan ke database.');
                redirect(base_url('MoneyBroker/allMoneyBroker'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Mohon pastikan semua isian telah terisi dengan benar.');
            redirect(base_url('MoneyBroker/allMoneyBroker'), 'refresh');
        }
    }

    public function uploadMb()
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

                if ($file_name == 'moneyBroker.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_moneybroker FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Money Broker Sukses!');
                        redirect(base_url('MoneyBroker/mbAdd'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('MoneyBroker/mbAdd'), 'refresh');
                    }
                } else {
                    unlink("./assets/csv/" . $file_name);

                    $this->session->set_flashdata('dangerAlert', 'Nama file salah!');
                    redirect(base_url('MoneyBroker/mbAdd'), 'refresh');
                }
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengunggah data!');
                redirect(base_url('MoneyBroker/mbAdd'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Tidak ada file ditemukan!');
            redirect(base_url('MoneyBroker/mbAdd'), 'refresh');
        }
    }
}
