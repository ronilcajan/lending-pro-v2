<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoanModel extends CI_Model {

	public function __contruct(){
        $this->load->database();
    }

    public function loans(){
        $this->db->select('*, loan.id as id, borrowers.id as borrowers_id');
        $this->db->from('loan');
        $this->db->join('borrowers', 'borrowers.id=loan.borrower_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getloans($id){
        $this->db->select('*, loan.id as id, borrowers.id as borrowers_id');
        $this->db->from('loan');
        $this->db->join('borrowers', 'borrowers.id=loan.borrower_id');
        $this->db->where('loan.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function getborrowers($id){
        $this->db->select('*, loan.id as id, borrowers.id as borrowers_id');
        $this->db->from('loan');
        $this->db->join('borrowers', 'borrowers.id=loan.borrower_id');
        $this->db->where('loan.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function create_loan($data){
        $this->db->insert('loan',$data);
        return $this->db->insert_id();
    }

    public function update_loan($data, $id){
        $this->db->update('loan' ,$data, "id=$id");
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('loan');
        return $this->db->affected_rows();
    }

    public function getType($id){
        $this->db->where('id', $id);
        $query = $this->db->get('loan_type');
        return $query->row();
    }

    public function getLoan_types(){
        $this->db->where('id !=', 1);
        $query = $this->db->get('loan_type');
        return $query->result_array();
    }
    public function create_loan_type($data){
        $this->db->insert('loan_type',$data);
        return $this->db->affected_rows();
    }
    public function update_loan_type($data,$id){
        $this->db->update('loan_type' ,$data, "id='$id'");
        return $this->db->affected_rows();
    }
    public function delete_loan_type($id){
        $this->db->where('id', $id);
        $this->db->delete('loan_type');
        return $this->db->affected_rows();
    }

}