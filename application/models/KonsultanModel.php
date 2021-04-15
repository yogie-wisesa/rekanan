<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class KonsultanModel extends CI_Model
{

    public function all($where = "")
    {
        return $this->db->query("SELECT count(*) FROM tb_konsultan " . $where);
    }

    public function getProvinsi($where = "")
    {
        return $this->db->query("SELECT * FROM tb_provinsi " . $where);
    }

    public function getKota($where = "")
    {
        return $this->db->query("SELECT * FROM tb_kota " . $where);
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

    public function getKonsultan($where = "")
    {
        return $this->db->query("SELECT * FROM tb_konsultan " . $where);
    }

    public function GetLatestKonsultanId()
    {
        return $this->db->query("SELECT id FROM tb_konsultan ORDER BY id DESC LIMIT 1")->result();
    }

    public function GetKonsultanDetail($aktif)
    {
        $this->db->select('*');
        $this->db->from('tb_Konsultan');
        $this->db->join('tb_kota', 'tb_kota.id=tb_konsultan.id_kota');
        $this->db->join('tb_provinsi', 'tb_provinsi.id=tb_konsultan.id_provinsi');
        $this->db->join('tb_status', 'tb_status.id=tb_konsultan.id_status');
        $this->db->join('tb_sanksi', 'tb_sanksi.id=tb_konsultan.id_sanksi');
        $this->db->where($aktif);
        $query = $this->db->get();
        return $query->result();
    }
}
