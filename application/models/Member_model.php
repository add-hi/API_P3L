<?php

class Member_model extends CI_Model{

    //untuk tampil semua data
    public function getLog($id = null){
        if($id === null){
            return $this->db->query("SELECT M.id_member, M.id_pegawai_cs, M.id_pegawai_kasir, M.nama, M.no_telp, M.tgl_lhr, M.alamat, M.created_at, M.update_at, M.delete_at, M.status ,M.created_by , M.deleted_by, P1.nama AS nama_cs , P2.nama AS nama_kasir , P3.nama AS nama_created_by , P4.nama AS nama_deleted_by
            FROM member M JOIN pegawai P1 ON (M.id_pegawai_cs = P1.id_pegawai) JOIN pegawai P2 ON (M.id_pegawai_kasir= P2.id_pegawai) JOIN pegawai P3 ON(M.created_by = P3.id_pegawai) JOIN pegawai P4 ON (M.deleted_by = P4.id_pegawai)")->result_array();
        } else{
            return $this->db->get_where('member', ['id_member' => $id]) ->result_array();
        }
        
    }

    //tidak menampilkan yang ter soft delete 
    public function getMember($id_member = null){
        if($id_member === null){
            return $this->db->query("SELECT M.id_member, M.id_pegawai_cs, M.id_pegawai_kasir, M.nama, M.no_telp, M.tgl_lhr, M.alamat, M.created_at, M.update_at, M.delete_at, M.status ,M.created_by , M.deleted_by, P1.nama AS nama_cs , P2.nama AS nama_kasir , P3.nama AS nama_created_by , P4.nama AS nama_deleted_by
            FROM member M JOIN pegawai P1 ON (M.id_pegawai_cs = P1.id_pegawai) JOIN pegawai P2 ON (M.id_pegawai_kasir= P2.id_pegawai) JOIN pegawai P3 ON(M.created_by = P3.id_pegawai) JOIN pegawai P4 ON (M.deleted_by = P4.id_pegawai) WHERE M.delete_at IS NULL")->result_array();
        } else{
            return $this->db->get_where('member', ['id_member' => $id_member]) ->result_array();
        }
        
    }

    public function deleteMember($data,$id_member){
        $this->db->update('member' , $data , ['id_member' => $id_member]);
        return $this->db->affected_rows();
    }

    public function hardDelete($id_member){
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