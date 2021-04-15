<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class WilayahModel extends CI_Model
{

    public function all($where = "")
    {
        return $this->db->query("SELECT * FROM tb_wilayah " . $where);
    }
}
