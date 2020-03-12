<?php

class Supplier_model extends CI_Model{

    public function getSupplier($id_supplier = null){
        if($id_supplier === null){
            return $this->db->get('supplier')->result_array();
        } else{
            return $this->db->get_where('supplier', ['id_supplier' => $id_supplier]) ->result_array();
        }
        
    }

    public function deleteSupplier($id_supplier){
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