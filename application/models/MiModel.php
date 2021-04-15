<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MiModel extends CI_Model
{

    public function all($where = "")
    {
        return $this->db->query("SELECT count(*) FROM tb_managerinvestasi " . $where);
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

    public function getMi($where = "")
    {
        return $this->db->query("SELECT * FROM tb_managerinvestasi " . $where);
    }

    public function GetLatestMiId()
    {
        return $this->db->query("SELECT id FROM tb_managerinvestasi ORDER BY id DESC LIMIT 1")->result();
    }

    public function getMiDetail($aktif)
    {
        $this->db->select('*');
        $this->db->from('tb_managerinvestasi');
        $this->db->join('tb_status', 'tb_status.id=tb_managerinvestasi.id_status');
        $this->db->join('tb_sanksi', 'tb_sanksi.id=tb_managerinvestasi.id_sanksi');
        $this->db->where($aktif);
        $query = $this->db->get();
        return $query->result();
    }
}
