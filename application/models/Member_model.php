<?php

class Member_model extends CI_Model{

    public function getMember($id_member = null){
        if($id_member === null){
            return $this->db->get('member')->result_array();
        } else{
            return $this->db->get_where('member', ['id_member' => $id_member]) ->result_array();
        }
        
    }

    public function deleteMember($id_member){
        $this->db->delete('member' , ['id_member' => $id_member]);
        return $this->db->affected_rows();
    }

    public function createMember($data){
        $this->db->insert('member', $data);
        return $this->db->affected_rows();
    }

    public function updateMember($data,$id_member){
        $this->db->update('member' , $data , ['id_member' => $id_member]);
        return $this->db->affected_rows();
    }
}