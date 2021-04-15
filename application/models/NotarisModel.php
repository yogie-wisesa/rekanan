<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class NotarisModel extends CI_Model
{
    public function getProvinsi($where = "")
    {
        return $this->db->query("SELECT * FROM tb_provinsi " . $where);
    }

    public function getKota($where = "")
    {
        return $this->db->query("SELECT * FROM tb_kota " . $where);
    }

    public function getWilayah($where = "")
    {
        return $this->db->query("SELECT * FROM tb_wilayah " . $where);
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

    public function all($where = "")
    {
        return $this->db->query("SELECT count(*) FROM tb_notaris " . $where);
    }

    public function getNotaris($where = "")
    {
        return $this->db->query("SELECT * FROM tb_notaris " . $where);
    }

    public function GetLatestNotarisId()
    {
        return $this->db->query("SELECT id FROM tb_notaris ORDER BY id DESC LIMIT 1")->result();
    }

    public function GetNotarisDetail($aktif)
    {
        $this->db->select('*');
        $this->db->from('tb_notaris');
        $this->db->join('tb_kota', 'tb_kota.id=tb_notaris.id_kota');
        $this->db->join('tb_wilayah', 'tb_wilayah.id=tb_notaris.id_wilayah');
        $this->db->join('tb_provinsi', 'tb_provinsi.id=tb_notaris.id_provinsi');
        $this->db->join('tb_status', 'tb_status.id=tb_notaris.id_status');
        $this->db->join('tb_sanksi', 'tb_sanksi.id=tb_notaris.id_sanksi');
        $this->db->where($aktif);
        $query = $this->db->get();
        return $query->result();
    }
}
