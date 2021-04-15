<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manager_investasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // is_log_in();
        $this->load->model('ProvinsiModel');
        $this->load->model('KotaModel');
        $this->load->model('WilayahModel');
        $this->load->model('MiModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['Mi'] = $this->MiModel->all("WHERE id_status <> 3")->result_array();
        $data['MiDiterima'] = $this->MiModel->all("WHERE id_status = 1")->result_array();
        $data['MiDitolak'] = $this->MiModel->all("WHERE id_status = 2")->result_array();
        $data['MiTerbatas'] = $this->MiModel->all("WHERE id_status = 4")->result_array();
        $data['title'] = 'Manajer_Investasi';
        $data['subtitle'] = 'Manager Investasi';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mi/index', $data);
        $this->load->view('templates/footer');
    }

    public function allManagerInvestasi()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->MiModel->GetPeriode()->result();
        $data['title'] = 'Manajer_Investasi';
        $data['subtitle'] = 'Manager Investasi';
        $data['status'] = $this->MiModel->GetStatus()->result();
        $data['sanksi'] = $this->MiModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mi/miView', $data);
        $this->load->view('templates/modal_mi');
        $this->load->view('templates/footer');
    }

    public function miDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->MiModel->GetPeriode()->result();
        $data['title'] = 'Manajer_Investasi';
        $data['subtitle'] = 'Manager Investasi';
        $data['status'] = $this->MiModel->GetStatus()->result();
        $data['sanksi'] = $this->MiModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mi/dapatDigunakanView', $data);
        $this->load->view('templates/modal_mi');
        $this->load->view('templates/footer');
    }

    public function miTidakDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->MiModel->GetPeriode()->result();
        $data['title'] = 'Manajer_Investasi';
        $data['subtitle'] = 'Manager Investasi';
        $data['status'] = $this->MiModel->GetStatus()->result();
        $data['sanksi'] = $this->MiModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mi/tidakDapatDigunakanView', $data);
        $this->load->view('templates/modal_mi');
        $this->load->view('templates/footer');
    }

    public function miTerbatas()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->MiModel->GetPeriode()->result();
        $data['title'] = 'Manajer_Investasi';
        $data['subtitle'] = 'Manager Investasi';
        $data['status'] = $this->MiModel->GetStatus()->result();
        $data['sanksi'] = $this->MiModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mi/terbatasView', $data);
        $this->load->view('templates/modal_mi');
        $this->load->view('templates/footer');
    }

    public function MiDetail($id)
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $aktif = array('tb_managerinvestasi.id' => $id);
        $data['dataMi'] = $this->MiModel->getMiDetail($aktif);
        $data['title'] = 'Manajer_Investasi';
        $data['subtitle'] = 'Manajer_Investasi';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mi/detailMi', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/modal_kap', $data);
    }


    public function tabel_mi_perusahaan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->MiModel->getMi('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status <> 3 ')->result();
            foreach ($get1 as $g1) {

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
                    '<a href="' . base_url('manager_investasi/MiDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $g1->alamat,
                    $g1->pic,
                    $g1->contact,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->MiModel->getMi($where1)->num_rows(),
                "recordsFiltered" => $this->MiModel->getMi($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' ";
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
                    '<a href="' . base_url('manager_investasi/MiDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
    }

    public function tabel_mi_dapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->MiModel->getMi('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = "1" ')->result();
            foreach ($get1 as $g1) {

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
                    '<a href="' . base_url('manager_investasi/MiDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $g1->alamat,
                    $g1->pic,
                    $g1->contact,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->MiModel->getMi($where1)->num_rows(),
                "recordsFiltered" => $this->MiModel->getMi($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = '1' ";
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
                    '<a href="' . base_url('manager_investasi/MiDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
    }

    public function tabel_mi_tidakDapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->MiModel->getMi('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = "2" ')->result();
            foreach ($get1 as $g1) {

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
                    '<a href="' . base_url('manager_investasi/MiDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $g1->alamat,
                    $g1->pic,
                    $g1->contact,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->MiModel->getMi($where1)->num_rows(),
                "recordsFiltered" => $this->MiModel->getMi($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = '2' ";
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
                    '<a href="' . base_url('manager_investasi/MiDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
    }

    public function tabel_mi_terbatas()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->MiModel->getMi('WHERE dateCreate LIKE "%' . $_POST['periode'] . '%" AND dateDelete = "0000-00-00" AND id_status = "4" ')->result();
            foreach ($get1 as $g1) {

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
                    '<a href="' . base_url('manager_investasi/MiDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
                    $g1->alamat,
                    $g1->pic,
                    $g1->contact,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->MiModel->getMi($where1)->num_rows(),
                "recordsFiltered" => $this->MiModel->getMi($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDelete = '0000-00-00' AND id_status = '4' ";
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
                    '<a href="' . base_url('manager_investasi/MiDetail/') . $g1->id . '">' . $g1->namaPerusahaan . '</a>',
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
    }

    public function tambah()
    {
        if ($_SESSION['role_id'] == 1) {
            $data['title'] = 'Manajer_Investasi';
            $data['subtitle'] = 'Tambah Manager Investasi';
            $data['lastMiId'] = $this->MiModel->GetLatestMiId();
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('mi/miUpload', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('kjpp');
        }
    }




    // Fungsi CRUD

    public function newManager()
    {
        $namaPerusahaan = $_POST['namaPerusahaan'];
        $nomorRekanan = $_POST['nomorRekanan'];
        $pic = $_POST['pic'];
        $jatuhTempo = $_POST['jatuhTempo'];
        $alamat = $_POST['alamat'];
        $contact = $_POST['contact'];
        $fax = $_POST['fax'];
        $email = $_POST['email'];
        $keterangan = $_POST['keterangan'];
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
                'contact' => $contact,
                'fax' => $fax,
                'email' => $email,
                'keterangan' => $keterangan,
                'id_status' => $id_status,
                'id_sanksi' => $id_sanksi,
                'date_created' => $today,
                'dateDelete' => $nullDate,
                'dateUpdate' => $nullDate,
            );
            $ins = $this->db->insert('tb_managerinvestasi', $datains);

            if ($ins > 0) {
                $this->session->set_flashdata('successAlert', 'Input Manager Investasi Berhasil!.');
                redirect(base_url('manager_investasi/allManagerInvestasi'), 'refresh');
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terdapat kesalahan ketika menghubungkan ke database.');
                redirect(base_url('manager_investasi/allManagerInvestasi'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Mohon pastikan semua isian telah terisi dengan benar.');
            redirect(base_url('manager_investasi/allManagerInvestasi'), 'refresh');
        }
    }

    public function uploadMi()
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

                if ($file_name == 'managerInvestasi.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_managerinvestasi FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Manager Investasi Sukses!');
                        redirect(base_url('manager_investasi/tambah'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('manager_investasi/tambah'), 'refresh');
                    }
                } else {
                    unlink("./assets/csv/" . $file_name);

                    $this->session->set_flashdata('dangerAlert', 'Nama file salah!');
                    redirect(base_url('manager_investasi/tambah'), 'refresh');
                }
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengunggah data!');
                redirect(base_url('manager_investasi/tambah'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Tidak ada file ditemukan!');
            redirect(base_url('manager_investasi/tambah'), 'refresh');
        }
    }
}
