<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BorrowersModel extends CI_Model {

	public function __contruct(){
        $this->load->database();
    }

    public function borrowers(){
        $query = $this->db->get('borrowers');
        return $query->result_array();
    }

    public function getborrowers($id){
        $this->db->where('id', $id);
        $query = $this->db->get('borrowers');
        return $query->row();
    }

    public function getloans($id){
        $this->db->select('*, loan.id as id, borrowers.id as borrowers_id');
        $this->db->from('loan');
        $this->db->join('borrowers', 'borrowers.id=loan.borrower_id');
        $this->db->where('borrowers.id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add($data){
        $this->db->insert('borrowers',$data);
        return $this->db->affected_rows();
    }

    public function update($data,$id){
        $this->db->update('borrowers' ,$data, "id='$id'");
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('borrowers');
        return $this->db->affected_rows();
    }
}