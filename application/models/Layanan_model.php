<?php

class Layanan_model extends CI_Model{

    public function getLayanan($id_layanan = null){
        if($id_layanan === null){
            return $this->db->get('layanan')->result_array();
        } else{
            return $this->db->get_where('layanan', ['id_layanan' => $id_layanan]) ->result_array();
        }
        
    }

    public function deleteLayanan($id_layanan){
        $this->db->delete('layanan' , ['id_layanan' => $id_layanan]);
        return $this->db->affected_rows();
    }

    public function createLayanan($data){
        $this->db->insert('layanan', $data);
        return $this->db->affected_rows();
    }

    public function updateLayanan($data,$id_layanan){
        $this->db->update('layanan' , $data , ['id_layanan' => $id_layanan]);
        return $this->db->affected_rows();
    }
}