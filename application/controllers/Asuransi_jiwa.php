<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asuransi_Jiwa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // is_log_in();
        $this->load->model('ProvinsiModel');
        $this->load->model('KotaModel');
        $this->load->model('WilayahModel');
        $this->load->model('AjModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['Aj'] = $this->AjModel->all("WHERE id_status <> 3")->result_array();
        $data['AjDiterima'] = $this->AjModel->all("WHERE id_status = 1")->result_array();
        $data['AjDitolak'] = $this->AjModel->all("WHERE id_status = 2")->result_array();
        $data['AjTerbatas'] = $this->AjModel->all("WHERE id_status = 4")->result_array();
        $data['title'] = 'Asuransi_jiwa';
        $data['subtitle'] = 'Asuransi Jiwa';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('aj/index', $data);
        $this->load->view('templates/footer');
    }

    public function allAsuransiJiwa()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->AjModel->GetPeriode()->result();
        $data['title'] = 'Asuransi_jiwa';
        $data['subtitle'] = 'Asuransi Jiwa';
        $data['status'] = $this->AjModel->GetStatus()->result();
        $data['sanksi'] = $this->AjModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('aj/ajView', $data);
        $this->load->view('templates/modal_aj');
        $this->load->view('templates/footer');
    }

    public function ajDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->AjModel->GetPeriode()->result();
        $data['title'] = 'Asuransi_jiwa';
        $data['subtitle'] = 'Asuransi Jiwa';
        $data['status'] = $this->AjModel->GetStatus()->result();
        $data['sanksi'] = $this->AjModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('aj/ajDapatDigunakanView', $data);
        $this->load->view('templates/modal_aj');
        $this->load->view('templates/footer');
    }

    public function ajTidakDapatDigunakan()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->AjModel->GetPeriode()->result();
        $data['title'] = 'Asuransi_jiwa';
        $data['subtitle'] = 'Asuransi Jiwa';
        $data['status'] = $this->AjModel->GetStatus()->result();
        $data['sanksi'] = $this->AjModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('aj/ajTidakDapatDigunakanView', $data);
        $this->load->view('templates/modal_aj');
        $this->load->view('templates/footer');
    }

    public function ajTerbatas()
    {
        $data['provinsi'] = $this->ProvinsiModel->view();
        $data['periode'] = $this->AjModel->GetPeriode()->result();
        $data['title'] = 'Asuransi_jiwa';
        $data['subtitle'] = 'Asuransi Jiwa';
        $data['status'] = $this->AjModel->GetStatus()->result();
        $data['sanksi'] = $this->AjModel->GetSanksi()->result();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('aj/ajTerbatasView', $data);
        $this->load->view('templates/modal_aj');
        $this->load->view('templates/footer');
    }

    public function tabel_aj_perusahaan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->AjModel->getAj('WHERE dateCreateAj LIKE "%' . $_POST['periode'] . '%" AND dateDeleteAj = "0000-00-00" AND id_status <> 3 ')->result();
            foreach ($get1 as $g1) {

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
                    $g1->namaAsuransi,
                    $g1->alamat,
                    $g1->pic,
                    $g1->contact,
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->AjModel->getAj($where1)->num_rows(),
                "recordsFiltered" => $this->AjModel->getAj($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeleteAj = '0000-00-00' AND id_status <> 3 ";
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
                    $g1->namaAsuransi,
                    $g1->alamat,
                    $g1->pic,
                    $g1->contact,
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
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
    }

    public function tabel_aj_dapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->AjModel->getAj('WHERE dateCreateAj LIKE "%' . $_POST['periode'] . '%" AND dateDeleteAj = "0000-00-00" AND id_status = "1" ')->result();
            foreach ($get1 as $g1) {

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
                    $g1->namaAsuransi,
                    $g1->alamat,
                    $g1->pic,
                    $g1->contact,
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->AjModel->getAj($where1)->num_rows(),
                "recordsFiltered" => $this->AjModel->getAj($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeleteAj = '0000-00-00' AND id_status = '1' ";
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
                    $g1->namaAsuransi,
                    $g1->alamat,
                    $g1->pic,
                    $g1->contact,
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
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
    }

    public function tabel_aj_tidakDapatDigunakan()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->AjModel->getAj('WHERE dateCreateAj LIKE "%' . $_POST['periode'] . '%" AND dateDeleteAj = "0000-00-00" AND id_status = "2" ')->result();
            foreach ($get1 as $g1) {

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
                    $g1->namaAsuransi,
                    $g1->alamat,
                    $g1->pic,
                    $g1->contact,
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->AjModel->getAj($where1)->num_rows(),
                "recordsFiltered" => $this->AjModel->getAj($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeleteAj = '0000-00-00' AND id_status = '2' ";
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
                    $g1->namaAsuransi,
                    $g1->alamat,
                    $g1->pic,
                    $g1->contact,
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
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
    }

    public function tabel_aj_terbatas()
    {
        // Datatables Variables
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        if (isset($_POST['periode'])) {
            $data = array();
            $no = 1;

            $where1 = "";
            $get1 = $this->AjModel->getAj('WHERE dateCreateAj LIKE "%' . $_POST['periode'] . '%" AND dateDeleteAj = "0000-00-00" AND id_status = 4 ')->result();
            foreach ($get1 as $g1) {

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
                    $g1->namaAsuransi,
                    $g1->alamat,
                    $g1->pic,
                    $g1->contact,
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
                    $statusArray
                );

                $no++;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->AjModel->getAj($where1)->num_rows(),
                "recordsFiltered" => $this->AjModel->getAj($where1)->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            $where = "WHERE dateDeleteAj = '0000-00-00' AND id_status = 4 ";
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
                    $g1->namaAsuransi,
                    $g1->alamat,
                    $g1->pic,
                    $g1->contact,
                    $g1->fax,
                    $g1->email,
                    $g1->jatuhTempo,
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
    }


    public function tambah()
    {
        if ($_SESSION['role_id'] == 1) {
            $data['title'] = 'Asuransi_jiwa';
            $data['subtitle'] = 'Tambah Asuransi Jiwa';
            $data['lastAjId'] = $this->AjModel->GetLatestAjId();
            $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('aj/ajUpload', $data);
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
        $id_status = $_POST['id_status'];
        $id_sanksi = $_POST['id_sanksi'];
        $today = date("Y-m-d");
        $nullDate = "0000-00-00";

        if ($jatuhTempo != '') {
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
                'id_status' => $id_status,
                'id_sanksi' => $id_sanksi,
                'dateCreateAj' => $today,
                'dateDeleteAj' => $nullDate,
                'dateUpdateAj' => $nullDate,
            );
            $ins = $this->db->insert('tb_asuransijiwa', $datains);

            if ($ins > 0) {
                $this->session->set_flashdata('successAlert', 'Input Asuransi Jiwa Berhasil!.');
                redirect(base_url('asuransi_jiwa/allAsuransiJiwa'), 'refresh');
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terdapat kesalahan ketika menghubungkan ke database.');
                redirect(base_url('asuransi_jiwa/allAsuransiJiwa'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Mohon pastikan semua isian telah terisi dengan benar.');
            redirect(base_url('asuransi_jiwa/allAsuransiJiwa'), 'refresh');
        }
    }

    public function uploadAj()
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

                if ($file_name == 'asuransiJiwaa.csv') {
                    $upl_q = $this->db->query("LOAD DATA INFILE 'D:/xampp/htdocs/rekanan/assets/csv/" . $file_name . "' INTO TABLE tb_asuransijiwa FIELDS TERMINATED BY ';' ENCLOSED BY '" . $patiakduo . "' LINES TERMINATED BY '\n' IGNORE 1 ROWS");

                    if ($upl_q) {
                        unlink("./assets/csv/" . $file_name);

                        $this->session->set_flashdata('successAlert', 'Upload Asuransi Jiwa Sukses!');
                        redirect(base_url('asuransi_jiwa/tambah'), 'refresh');
                    } else {
                        $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengimpor data!');
                        redirect(base_url('asuransi_jiwa/tambah'), 'refresh');
                    }
                } else {
                    unlink("./assets/csv/" . $file_name);

                    $this->session->set_flashdata('dangerAlert', 'Nama file salah!');
                    redirect(base_url('asuransi_jiwa/tambah'), 'refresh');
                }
            } else {
                $this->session->set_flashdata('dangerAlert', 'Terjadi kesalahan ketika mengunggah data!');
                redirect(base_url('asuransi_jiwa/tambah'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('dangerAlert', 'Tidak ada file ditemukan!');
            redirect(base_url('asuransi_jiwa/tambah'), 'refresh');
        }
    }
}
