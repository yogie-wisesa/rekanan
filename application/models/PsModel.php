<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class PsModel extends CI_Model
{

    public function all($where = "")
    {
        return $this->db->query("SELECT count(*) FROM tb_pialangsaham " . $where);
    }

    public function GetKota($where = "")
    {
        return $this->db->query("SELECT * FROM tb_kota " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function getPeriode($where = "")
    {
        return $this->db->query("SELECT * FROM tb_periode " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetStatus($where = "")
    {
        return $this->db->query("SELECT * FROM tb_status " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetSanksi($where = "")
    {
        return $this->db->query("SELECT * FROM tb_sanksi " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function getPs($where = "")
    {
        return $this->db->query("SELECT * FROM tb_pialangsaham " . $where);
    }

    public function GetLatestPsId()
    {
        return $this->db->query("SELECT id FROM tb_pialangsaham ORDER BY id DESC LIMIT 1")->result();
    }

    public function getPsDetail($aktif)
    {
        $this->db->select('*');
        $this->db->from('tb_pialangsaham');
        $this->db->join('tb_provinsi', 'tb_provinsi.id=tb_pialangsaham.id_provinsi');
        $this->db->join('tb_kota', 'tb_kota.id=tb_pialangsaham.id_kota');
        $this->db->join('tb_status', 'tb_status.id=tb_pialangsaham.id_status');
        $this->db->join('tb_sanksi', 'tb_sanksi.id=tb_pialangsaham.id_sanksi');
        $this->db->where($aktif);
        $query = $this->db->get();
        return $query->result();
    }
}
