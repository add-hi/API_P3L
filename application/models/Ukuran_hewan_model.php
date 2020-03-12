<?php

class Ukuran_hewan_model extends CI_Model{

    public function getUkuran_hewan($id_ukuran = null){
        if($id_ukuran === null){
            return $this->db->get('ukuran_hewan')->result_array();
        } else{
            return $this->db->get_where('ukuran_hewan', ['id_ukuran' => $id_ukuran]) ->result_array();
        }
        
    }

    public function deleteUkuran_hewan($id_ukuran){
        $this->db->delete('ukuran_hewan' , ['id_ukuran' => $id_ukuran]);
        return $this->db->affected_rows();
    }

    public function createUkuran_hewan($data){
        $this->db->insert('ukuran_hewan', $data);
        return $this->db->affected_rows();
    }

    public function updateUkuran_hewan($data,$id_ukuran){
        $this->db->update('ukuran_hewan' , $data , ['id_ukuran' => $id_ukuran]);
        return $this->db->affected_rows();
    }
}