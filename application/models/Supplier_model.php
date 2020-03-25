<?php

class Supplier_model extends CI_Model{

    //untuk tampil semua data
    public function getLog($id = null){
        if($id === null){
            return $this->db->get('supplier')->result_array();
        } else{
            return $this->db->get_where('supplier', ['id_supplier' => $id]) ->result_array();
        }
        
    }

    //tidak menampilkan yang ter soft delete    
    public function getSupplier($id_supplier = null){
        if($id_supplier === null){
            return $this->db->get_where('supplier', ['delete_at' => null])->result_array();
        } else{
            return $this->db->get_where('supplier', ['id_supplier' => $id_supplier]) ->result_array();
        }
        
    }

    public function deleteSupplier($data,$id_supplier){
        $this->db->update('supplier' , $data , ['id_supplier' => $id_supplier]);
        return $this->db->affected_rows();
    }

    public function hardDelete($id_supplier){
        $this->db->delete('supplier' , ['id_supplier' => $id_supplier]);
        return $this->db->affected_rows();
    }

    public function createSupplier($data){
        $this->db->insert('supplier', $data);
        return $this->db->affected_rows();
    }

    public function updateSupplier($data,$id_supplier){
        $this->db->update('supplier' , $data , ['id_supplier' => $id_supplier]);
        return $this->db->affected_rows();
    }
}