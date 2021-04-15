<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class AkModel extends CI_Model
{

    public function all($where = "")
    {
        return $this->db->query("SELECT count(*) FROM tb_asuransikerugian " . $where);
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

    public function getAk($where = "")
    {
        return $this->db->query("SELECT * FROM tb_asuransikerugian " . $where);
    }

    public function GetLatestAkId()
    {
        return $this->db->query("SELECT id FROM tb_asuransikerugian ORDER BY id DESC LIMIT 1")->result();
    }

    public function getAkDetail($aktif)
    {
        $this->db->select('*');
        $this->db->from('tb_asuransikerugian');
        $this->db->join('tb_status', 'tb_status.id=tb_asuransikerugian.id_status');
        $this->db->join('tb_sanksi', 'tb_sanksi.id=tb_asuransikerugian.id_sanksi');
        $this->db->where($aktif);
        $query = $this->db->get();
        return $query->result();
    }
}
