<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class BlsModel extends CI_Model
{

    public function all($where = "")
    {
        return $this->db->query("SELECT count(*) FROM tb_perusahaanbls " . $where);
    }

    public function kantor()
    {
        return $this->db->query("SELECT count(*) FROM tb_kantorbls ");
    }

    public function GetStatus($where = "")
    {
        return $this->db->query("SELECT * FROM tb_status " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetSanksi($where = "")
    {
        return $this->db->query("SELECT * FROM tb_sanksi " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetPeriode($where = "")
    {
        return $this->db->query("SELECT * FROM tb_periode " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetBls($where = "")
    {
        return $this->db->query("SELECT * FROM tb_perusahaanbls " . $where);
    }

    public function GetKantorBlsId($where = "")
    {
        return $this->db->query("SELECT DISTINCT id_perusahaanBLS FROM tb_kantorbls " . $where);
    }

    public function GetKantorBls($where = "")
    {
        return $this->db->query("SELECT * FROM tb_kantorbls " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetProvinsi($where = "")
    {
        return $this->db->query("SELECT * FROM tb_provinsi " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetKota($where = "")
    {
        return $this->db->query("SELECT * FROM tb_kota " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetLatestBlsId()
    {
        return $this->db->query("SELECT id FROM tb_perusahaanbls ORDER BY id DESC LIMIT 1")->result();
    }

    public function GetLatestKantorBlsId()
    {
        return $this->db->query("SELECT id FROM tb_kantorbls ORDER BY id DESC LIMIT 1")->result();
    }
}
