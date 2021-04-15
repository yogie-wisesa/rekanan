<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MbModel extends CI_Model
{

    public function all($where = "")
    {
        return $this->db->query("SELECT count(*) FROM tb_moneybroker " . $where);
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

    public function getMb($where = "")
    {
        return $this->db->query("SELECT * FROM tb_moneybroker " . $where);
    }

    public function GetLatestMbId()
    {
        return $this->db->query("SELECT id FROM tb_moneybroker ORDER BY id DESC LIMIT 1")->result();
    }

    public function getMbDetail($aktif)
    {
        $this->db->select('*');
        $this->db->from('tb_moneybroker');
        $this->db->join('tb_status', 'tb_status.id=tb_moneybroker.id_status');
        $this->db->join('tb_sanksi', 'tb_sanksi.id=tb_moneybroker.id_sanksi');
        $this->db->where($aktif);
        $query = $this->db->get();
        return $query->result();
    }
}
