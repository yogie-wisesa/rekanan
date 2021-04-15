<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pialang_asuransi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // is_log_in();
        $this->load->model('ProvinsiModel');
        $this->load->model('KotaModel');
        $this->load->model('WilayahModel');
        $this->load->model('PsModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['Ps'] = $this->PsModel->all("WHERE id_status <> 3")->result_array();
        $data['PsDiterima'] = $this->PsModel->all("WHERE id_status = 1")->result_array();
        $data['PsDitolak'] = $this->PsModel->all("WHERE id_status = 2")->result_array();
        $data['PsTerbatas'] = $this->PsModel->all("WHERE id_status = 4")->result_array();
        $data['title'] = 'pialang_Asuransi';
        $data['subtitle'] = 'Pialang Saham';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ps/index', $data);
        $this->load->view('templates/footer');
    }

    public function allPialangSaham()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->PsModel->GetPeriode()->result();
        $data['title'] = 'pialang_Asuransi';
        $data['subtitle'] = 'Pialang Saham';
        $data['status'] = $this->PsModel->GetStatus()->result();
        $data['sanksi'] = $this->PsModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ps/psView', $data);
        $this->load->view('templates/modal_ps');
        $this->load->view('templates/footer');
    }

    public function dapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->PsModel->GetPeriode()->result();
        $data['title'] = 'Pialang Saham';
        $data['subtitle'] = 'Pialang Saham';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ps/psDapatDigunakanView', $data);
        $this->load->view('templates/footer');
    }

    public function tidakDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->PsModel->GetPeriode()->result();
        $data['title'] = 'Pialang Saham';
        $data['subtitle'] = 'Pialang Saham';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ps/psTidakDapatDigunakanView', $data);
        $this->load->view('templates/footer');
    }

    public function terbatas()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->PsModel->GetPeriode()->result();
        $data['title'] = 'Pialang Saham';
        $data['subtitle'] = 'Pialang Saham';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ps/psTerbatasView', $data);
        $this->load->view('templates/footer');
    }

    public function PsDetail($id)
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $aktif = array('tb_pialangsaham.id' => $id);
        $data['dataPs'] = $this->PsModel->getPsDetail($aktif);
        $data['title'] = 'Pialang Asuransi';
        $data['subtitle'] = 'Pialang Asuransi';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ps/detailPs', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_kap', $data);
    }

    public function tabel_ps_perusahaan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->PsModel->getPs('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status <> 3 ')->result();
            foreach ($get1 as $g1) {

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
                    '<a href="' . base_url('pialang_asuransi/PsDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $kota,
                    $g1->alamat,
                    $g1->phone,
                    $statusArray,
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->PsModel->getPs($where1)->num_rows(),
                "recordsFiltered" => $this->PsModel->getPs($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' ";
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
                    '<a href="' . base_url('pialang_asuransi/PsDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
    }

    public function tabel_ps_dapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->PsModel->getPs('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = "1" ')->result();
            foreach ($get1 as $g1) {

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
                    '<a href="' . base_url('pialang_asuransi/PsDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $g1->alamat,
                    $g1->phone,
                    $statusArray,
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->PsModel->getPs($where1)->num_rows(),
                "recordsFiltered" => $this->PsModel->getPs($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = '1' ";
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
                    '<a href="' . base_url('pialang_asuransi/PsDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
    }

    public function tabel_ps_tidakDapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->PsModel->getPs('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = "2" ')->result();
            foreach ($get1 as $g1) {

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
                    '<a href="' . base_url('pialang_asuransi/PsDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $g1->alamat,
                    $g1->phone,
                    $statusArray,
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->PsModel->getPs($where1)->num_rows(),
                "recordsFiltered" => $this->PsModel->getPs($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = '2' ";
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
                    '<a href="' . base_url('pialang_asuransi/PsDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
    }

    public function tabel_ps_terbatas()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->PsModel->getPs('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = "4" ')->result();
            foreach ($get1 as $g1) {

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
                    '<a href="' . base_url('pialang_asuransi/PsDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $g1->alamat,
                    $g1->phone,
                    $statusArray,
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->PsModel->getPs($where1)->num_rows(),
                "recordsFiltered" => $this->PsModel->getPs($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = '4' ";
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
                    '<a href="' . base_url('pialang_asuransi/PsDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
    }

    public function psAdd()
    {
        if ($_SESSION['role_id'] == 1) {
            $data['title'] = 'pialang_Asuransi';
            $data['subtitle'] = 'Tambah Pialang Saham';
            $data['lastPsId'] = $this->PsModel->GetLatestPsId();
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ps/psUpload', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('kjpp');
        }
    }




    // Fungsi CRUD

    public function newPialang()
    {
        $namaPerusahaan = $_POST['namaPerusahaan'];
        $nomorRekanan = $_POST['nomorRekanan'];
        $pic = $_POST['pic'];
        $jatuhTempo = $_POST['jatuhTempo'];
        $alamat = $_POST['alamat'];
        $phone = $_POST['phone'];
        $fax = $_POST['fax'];
        $email = $_POST['email'];
        $keterangan = $_POST['keterangan'];
        $id_provinsi = $_POST['id_provinsi'];
        $id_kota = $_POST['id_kota'];
        $id_status = $_POST['id_status'];
        $id_sanksi = $_POST['id_sanksi'];
        $today = date("Y-m-d");
        $nullDate = "0000-00-00";

        if ($jatuhTempo != '' && $id_sanksi != 'volvo') {
            $datains = array(
                'namaPerusahaan' => $namaPerusahaan,
                'nomorRekanan' => $nomorRekanan,
                'pic' => $pic,
                'jatuhTempo' => $jatuhTempo,
                'alamat' => $alamat,
                'phone' => $phone,
                'fax' => $fax,
                'email' => $email,
                'keterangan' => $keterangan,
                'id_provinsi' => $id_provinsi,
                'id_kota' => $id_kota,
                'id_status' => $id_status,
                'id_sanksi' => $id_sanksi,
                'dateCreate' => $today,
                'dateDelete' => $nullDate,
                'dateUpdate' => $nullDate,
            );
            $ins = $this->db->insert('tb_pialangsaham', $datains);

            if ($ins > 0) {
                $this->session->set_flashdata('successAlert', 'Input Pialang Saham Berhasil!.');
                redirect(base_url('Pialang_asuransi/allPialangSaham'), 'refresh');
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terdapat kesalahan ketika menghubungkan ke database.');
                redirect(base_url('Pialang_asuransi/allPialangSaham'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Mohon pastikan semua isian telah terisi dengan benar.');
            redirect(base_url('Pialang_asuransi/allPialangSaham'), 'refresh');
        }
    }

    public function uploadPs()
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

                if ($file_name == 'pialangSaham.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_pialangsaham FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Pialang Saham Sukses!');
                        redirect(base_url('Pialang_asuransi/psAdd'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('Pialang_asuransi/psAdd'), 'refresh');
                    }
                } else {
                    unlink("./assets/csv/" . $file_name);

                    $this->session->set_flashdata('dangerAlert', 'Nama file salah!');
                    redirect(base_url('Pialang_asuransi/psAdd'), 'refresh');
                }
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengunggah data!');
                redirect(base_url('Pialang_asuransi/psAdd'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Tidak ada file ditemukan!');
            redirect(base_url('Pialang_asuransi/psAdd'), 'refresh');
        }
    }
}
