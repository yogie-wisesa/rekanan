<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asuransi_Kerugian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // is_log_in();
        $this->load->model('ProvinsiModel');
        $this->load->model('KotaModel');
        $this->load->model('WilayahModel');
        $this->load->model('AkModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['Ak'] = $this->AkModel->all("WHERE id_status <> 3")->result_array();
        $data['AkDiterima'] = $this->AkModel->all("WHERE id_status = 1")->result_array();
        $data['AkDitolak'] = $this->AkModel->all("WHERE id_status = 2")->result_array();
        $data['AkTerbatas'] = $this->AkModel->all("WHERE id_status = 4")->result_array();
        $data['title'] = 'Asuransi_kerugian';
        $data['subtitle'] = 'Asuransi Kerugian';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ak/index', $data);
        $this->load->view('templates/footer');
    }

    public function allAsuransiKerugian()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->AkModel->GetPeriode()->result();
        $data['title'] = 'Asuransi_kerugian';
        $data['subtitle'] = 'Asuransi Kerugian';
        $data['status'] = $this->AkModel->GetStatus()->result();
        $data['sanksi'] = $this->AkModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ak/akView', $data);
        $this->load->view('templates/modal_ak');
        $this->load->view('templates/footer');
    }

    public function akDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->AkModel->GetPeriode()->result();
        $data['title'] = 'Asuransi_kerugian';
        $data['subtitle'] = 'Asuransi Kerugian';
        $data['status'] = $this->AkModel->GetStatus()->result();
        $data['sanksi'] = $this->AkModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ak/akDapatDigunakanView', $data);
        $this->load->view('templates/modal_ak');
        $this->load->view('templates/footer');
    }

    public function akTidakDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->AkModel->GetPeriode()->result();
        $data['title'] = 'Asuransi_kerugian';
        $data['subtitle'] = 'Asuransi Kerugian';
        $data['status'] = $this->AkModel->GetStatus()->result();
        $data['sanksi'] = $this->AkModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ak/akTidakDapatDigunakanView', $data);
        $this->load->view('templates/modal_ak');
        $this->load->view('templates/footer');
    }

    public function akTerbatas()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->AkModel->GetPeriode()->result();
        $data['title'] = 'Asuransi_kerugian';
        $data['subtitle'] = 'Asuransi Kerugian';
        $data['status'] = $this->AkModel->GetStatus()->result();
        $data['sanksi'] = $this->AkModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ak/akTerbatasView', $data);
        $this->load->view('templates/modal_ak');
        $this->load->view('templates/footer');
    }

    public function tabel_ak_perusahaan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->AkModel->getAk('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status <> 3 ')->result();
            foreach ($get1 as $g1) {

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
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
                    $g1->scoring,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->AkModel->getAk($where1)->num_rows(),
                "recordsFiltered" => $this->AkModel->getAk($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status <> 3 ";
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
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
                    $g1->scoring,
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
    }

    public function tabel_ak_dapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->AkModel->getAk('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = "1" ')->result();
            foreach ($get1 as $g1) {

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
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
                    $g1->scoring,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->AkModel->getAk($where1)->num_rows(),
                "recordsFiltered" => $this->AkModel->getAk($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = '1' ";
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
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
                    $g1->scoring,
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
    }

    public function tabel_ak_tidakDapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->AkModel->getAk('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = "2" ')->result();
            foreach ($get1 as $g1) {

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
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
                    $g1->scoring,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->AkModel->getAk($where1)->num_rows(),
                "recordsFiltered" => $this->AkModel->getAk($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = '2' ";
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
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
                    $g1->scoring,
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
    }

    public function tabel_ak_terbatas()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->AkModel->getAk('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = "4" ')->result();
            foreach ($get1 as $g1) {

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
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
                    $g1->scoring,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->AkModel->getAk($where1)->num_rows(),
                "recordsFiltered" => $this->AkModel->getAk($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = '4' ";
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
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
                    $g1->scoring,
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
    }

    public function tambah()
    {
        if ($_SESSION['role_id'] == 1) {
            $data['title'] = 'Asuransi_kerugian';
            $data['subtitle'] = 'Tambah Asuransi Kerugian';
            $data['lastAkId'] = $this->AkModel->GetLatestAkId();
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ak/akUpload', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('kjpp');
        }
    }




    // Fungsi CRUD

    public function newAsuransi()
    {
        $namaAsuransi = $_POST['namaAsuransi'];
        $nomorRekanan = $_POST['nomorRekanan'];
        $pic = $_POST['pic'];
        $jatuhTempo = $_POST['jatuhTempo'];
        $alamat = $_POST['alamat'];
        $contact = $_POST['contact'];
        $fax = $_POST['fax'];
        $email = $_POST['email'];
        $keterangan = $_POST['keterangan'];
        $scoring = $_POST['scoring'];
        $id_status = $_POST['id_status'];
        $id_sanksi = $_POST['id_sanksi'];
        $today = date("Y-m-d");
        $nullDate = "0000-00-00";

        if ($jatuhTempo != '' && $id_sanksi != 'volvo') {
            $datains = array(
                'namaAsuransi' => $namaAsuransi,
                'nomorRekanan' => $nomorRekanan,
                'pic' => $pic,
                'jatuhTempo' => $jatuhTempo,
                'alamat' => $alamat,
                'contact' => $contact,
                'fax' => $fax,
                'email' => $email,
                'keterangan' => $keterangan,
                'scoring' => $scoring,
                'id_status' => $id_status,
                'id_sanksi' => $id_sanksi,
                'dateCreate' => $today,
                'dateDelete' => $nullDate,
                'dateUpdate' => $nullDate,
            );
            $ins = $this->db->insert('tb_asuransikerugian', $datains);

            if ($ins > 0) {
                $this->session->set_flashdata('successAlert', 'Input Asuransi Jiwa Berhasil!.');
                redirect(base_url('asuransi_kerugian/allAsuransiKerugian'), 'refresh');
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terdapat kesalahan ketika menghubungkan ke database.');
                redirect(base_url('asuransi_kerugian/allAsuransiKerugian'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Mohon pastikan semua isian telah terisi dengan benar.');
            redirect(base_url('asuransi_kerugian/allAsuransiKerugian'), 'refresh');
        }
    }

    public function uploadAk()
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

                if ($file_name == 'asuransiKerugian.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_asuransikerugian FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Asuransi Kerugian Sukses!');
                        redirect(base_url('asuransi_kerugian/tambah'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('asuransi_kerugian/tambah'), 'refresh');
                    }
                } else {
                    unlink("./assets/csv/" . $file_name);

                    $this->session->set_flashdata('dangerAlert', 'Nama file salah!');
                    redirect(base_url('asuransi_kerugian/tambah'), 'refresh');
                }
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengunggah data!');
                redirect(base_url('asuransi_kerugian/tambah'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Tidak ada file ditemukan!');
            redirect(base_url('asuransi_kerugian/tambah'), 'refresh');
        }
    }
}
