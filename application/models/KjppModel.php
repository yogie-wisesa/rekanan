<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class KjppModel extends CI_Model
{

    public function all($where = "")
    {
        return $this->db->query("SELECT count(*) FROM tb_perusahaankjpp " . $where);
    }

    public function penilai()
    {
        return $this->db->query("SELECT count(*) FROM tb_penilaipublik");
    }

    // public function GetKantorKjppId($where = "")
    // {
    //     return $this->db->query("SELECT DISTINCT id_perusahanKjpp FROM tb_kantorkjpp " . $where);
    // }

    // public function GetKantorKjpp($where = "")
    // {
    //     return $this->db->query("SELECT * FROM tb_kantorkjpp " . $where);
    // }

    public function GetKjpp($where = "")
    {
        return $this->db->query("SELECT * FROM tb_perusahaankjpp " . $where);
    }

    // public function GetStatusKantor($where = "")
    // {
    //     return $this->db->query("SELECT * FROM tb_statuskantor " . $where); // Tampilkan semua data yang ada di tabel status
    // }

    public function GetStatus($where = "")
    {
        return $this->db->query("SELECT * FROM tb_status " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetSanksi($where = "")
    {
        return $this->db->query("SELECT * FROM tb_sanksi " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetJasaPenilai()
    {
        return $this->db->get('tb_jasapenilai')->result(); // Tampilkan semua data yang ada di tabel status
    }

    public function GetOjkKjpp()
    {
        return $this->db->get('tb_ojkkjpp')->result(); // Tampilkan semua data yang ada di tabel status
    }

    public function GetPenilaiPublikDistinc($where = "")
    {
        return $this->db->query("SELECT DISTINCT id_perusahanKjpp FROM tb_penilaipublik " . $where); // Tampilkan semua data yang ada di tabel status
    }


    public function GetPenilaiPublik($where = "")
    {
        return $this->db->query("SELECT * FROM tb_penilaipublik " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetKota($where = "")
    {
        return $this->db->query("SELECT * FROM tb_kota " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetProvinsi($where = "")
    {
        return $this->db->query("SELECT * FROM tb_provinsi " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetPeriode($where = "")
    {
        return $this->db->query("SELECT * FROM tb_periode " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetLatestKjppId()
    {
        return $this->db->query("SELECT id FROM tb_perusahaankjpp ORDER BY id DESC LIMIT 1")->result();
    }

    public function GetLatestPenilaiPublikId()
    {
        return $this->db->query("SELECT id FROM tb_penilaipublik ORDER BY id DESC LIMIT 1")->result();
    }

    public function GetKjppDetail($aktif)
    {
        $this->db->select('*');
        $this->db->from('tb_penilaipublik');
        $this->db->join('tb_perusahaankjpp', 'tb_perusahaankjpp.id=tb_penilaipublik.id_perusahanKjpp');
        $this->db->join('tb_kota', 'tb_kota.id=tb_penilaipublik.id_kota');
        $this->db->join('tb_provinsi', 'tb_provinsi.id=tb_penilaipublik.id_provinsi');
        $this->db->join('tb_status', 'tb_status.id=tb_penilaipublik.id_status');
        $this->db->join('tb_sanksi', 'tb_sanksi.id=tb_penilaipublik.id_sanksi');
        $this->db->join('tb_jasapenilai', 'tb_jasapenilai.id=tb_penilaipublik.id_jasaPenilai');
        $this->db->join('tb_ojkkjpp', 'tb_ojkkjpp.id=tb_penilaipublik.id_ojkKjpp');
        $this->db->where($aktif);
        $query = $this->db->get();
        return $query->result();
    }

    public function GetSektor($where = "")
    {
        return $this->db->query("SELECT * FROM tb_sektor " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetKjppSektor($where = "")
    {
        return $this->db->query("SELECT * FROM tb_kjppsektor " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetObjek($where = "")
    {
        return $this->db->query("SELECT * FROM tb_objek " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetKjppObjek($where = "")
    {
        return $this->db->query("SELECT * FROM tb_kjppobjek " . $where); // Tampilkan semua data yang ada di tabel status
    }
}
