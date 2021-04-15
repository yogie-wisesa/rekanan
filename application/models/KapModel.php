<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class KapModel extends CI_Model
{

    public function all($where = "")
    {
        return $this->db->query("SELECT count(*) FROM tb_perusahaankap " . $where);
    }

    public function cabang()
    {
        return $this->db->query("SELECT count(*) FROM tb_kantorkap ");
    }

    public function penilai()
    {
        return $this->db->query("SELECT count(*) FROM tb_akuntanpublik ");
    }

    public function GetKantorKapId($where = "")
    {
        return $this->db->query("SELECT DISTINCT id_perusahaanKap FROM tb_akuntanpublik " . $where);
    }

    public function GetKantorKap($where = "")
    {
        return $this->db->query("SELECT * FROM tb_kantorkap " . $where);
    }

    public function GetKap($where = "")
    {
        return $this->db->query("SELECT * FROM tb_perusahaankap " . $where);
    }

    public function GetStatusKantor($where = "")
    {
        return $this->db->query("SELECT * FROM tb_statuskantor " . $where); // Tampilkan semua data yang ada di tabel status
    }

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

    public function GetAkuntan($where = "")
    {
        return $this->db->query("SELECT * FROM tb_akuntanpublik " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetProvinsi($where = "")
    {
        return $this->db->query("SELECT * FROM tb_provinsi " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetKota($where = "")
    {
        return $this->db->query("SELECT * FROM tb_kota " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetPeriode($where = "")
    {
        return $this->db->query("SELECT * FROM tb_periode " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetSektor($where = "")
    {
        return $this->db->query("SELECT * FROM tb_sektor " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetKapSektor($where = "")
    {
        return $this->db->query("SELECT * FROM tb_kapsektor " . $where); // Tampilkan semua data yang ada di tabel status
    }

    public function GetLatestKapId()
    {
        return $this->db->query("SELECT id FROM tb_perusahaankap ORDER BY id DESC LIMIT 1")->result();
    }

    public function GetLatestAkuntanPublikId()
    {
        return $this->db->query("SELECT id FROM tb_akuntanpublik ORDER BY id DESC LIMIT 1")->result();
    }

    public function GetAkuntanDetail($aktif)
    {
        $this->db->select('*');
        $this->db->from('tb_akuntanpublik');
        $this->db->join('tb_perusahaankap', 'tb_perusahaankap.id=tb_akuntanpublik.id_perusahaanKap');
        $this->db->join('tb_kota', 'tb_kota.id=tb_akuntanpublik.id_kota');
        $this->db->join('tb_provinsi', 'tb_provinsi.id=tb_akuntanpublik.id_provinsi');
        $this->db->join('tb_status', 'tb_status.id=tb_akuntanpublik.id_status');
        $this->db->join('tb_sanksi', 'tb_sanksi.id=tb_akuntanpublik.id_sanksi');
        $this->db->where($aktif);
        $query = $this->db->get();
        return $query->result();
    }
}
