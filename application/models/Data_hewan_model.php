<?php

class Data_hewan_model extends CI_Model{

    //untuk tampil semua data
    public function getLog($id = null){
        if($id === null){
            return $this->db->get('data_hewan')->result_array();
        } else{
            return $this->db->get_where('data_hewan', ['id_hewan' => $id]) ->result_array();
        }
        
    }

    //tidak menampilkan yang ter soft delete  
    public function getData_hewan($id_hewan = null){
        if($id_hewan === null){
            return $this->db->get_where('data_hewan', ['delete_at' => null])->result_array();
        } else{
            return $this->db->get_where('data_hewan', ['id_hewan' => $id_hewan]) ->result_array();
        }
        
    }

    public function deleteData_hewan($data,$id_hewan){
        $this->db->update('data_hewan' , $data , ['id_hewan' => $id_hewan]);
        return $this->db->affected_rows();
    }

    public function hardDelete($id_hewan){
        $this->db->delete('data_hewan' , ['id_hewan' => $id_hewan]);
        return $this->db->affected_rows();
    }

    public function createData_hewan($data){
        $this->db->insert('data_hewan', $data);
        return $this->db->affected_rows();
    }

    public function updateData_hewan($data,$id_hewan){
        $this->db->update('data_hewan' , $data , ['id_hewan' => $id_hewan]);
        return $this->db->affected_rows();
    }
}