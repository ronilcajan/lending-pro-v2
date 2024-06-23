<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

	public function __contruct(){
        $this->load->database();
    }

    public function getborrowers(){
        $query = $this->db->get('borrowers');
        return $query->num_rows();
    }
    public function getloans(){
        $query = $this->db->get('loan');
        return $query->num_rows();
    }
    public function getactiveloan(){
        $this->db->where('status','Active');
        $query = $this->db->get('loan');
        return $query->num_rows();
    }
    public function getpaid(){
        $this->db->where('status','Paid');
        $query = $this->db->get('loan');
        return $query->num_rows();
    }

    public function getprofit(){
        $this->db->select_sum('principal');
        $this->db->select_sum('total_amount');
        $query = $this->db->get('loan');
        return $query->row();
    }
    public function getpenalty(){
        $this->db->select_sum('p_penalty');
        $query = $this->db->get('payment');
        return $query->row();
    }

    public function getrevenue(){
        $this->db->select_sum('total_amount');
        $query = $this->db->get('transaction');
        return $query->row();
    }
    public function getRev($id){
        $this->db->select_sum('total_amount');
        $this->db->where('MONTH(trans_date)', $id);
        $query = $this->db->get('transaction');
        return $query->row();
    }
}