<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loans extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['title'] = 'Loan Management';
		$data['borrowers'] = $this->borrowersModel->borrowers();
		$data['loan_type'] = $this->loanModel->getLoan_types();
		$data['loans'] = $this->loanModel->loans();

		$this->base->load('default', 'loans/manage', $data);
	}

	public function create_loan()
	{
		$this->session->set_flashdata('success', 'danger');

		$this->form_validation->set_rules('borrowers_id', 'Borrowers', 'trim|required');
		$this->form_validation->set_rules('principal', 'Principal Amount', 'trim|required');
		$this->form_validation->set_rules('interest', 'Interest', 'trim|required');
		$this->form_validation->set_rules('penalty', 'Penalty', 'trim|required');

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('message', validation_errors());
		} else {

			$data = array(
				'borrower_id' => $this->input->post('borrowers_id'),
				'loan_type' => $this->input->post('loan_type'),
				'principal' => $this->input->post('principal'),
				'terms' => $this->input->post('terms'),
				'interest' => $this->input->post('interest'),
				'penalty' => $this->input->post('penalty'),
				'date_started' => $this->input->post('date_started'),
				'maturity_date' => $this->input->post('maturity_date'),
				'monthly' => $this->input->post('monthly'),
				'total_amount' => $this->input->post('total'),
				'notes' => $this->input->post('notes'),
				'co_maker' => $this->input->post('cname'),
				'co_maker2' => $this->input->post('cname1'),
			);

			$loan_id =  $this->loanModel->create_loan($data);

			if ($loan_id) {
				for ($i = 1; $i <= $this->input->post('terms'); $i++) {
					if ($i == 1) {
						$payment = array(
							'loan_id' => $loan_id,
							'due_date' => date("Y-m-d", strtotime("+1 month", strtotime($this->input->post('date_started')))),
							'due' => $this->input->post('principal') / $this->input->post('terms'),
							'p_interest' => $this->input->post('principal') * ($this->input->post('interest') / 100),
							'status' => 'Processing',
						);
					} else {
						$payment =  array(
							'loan_id' => $loan_id,
							'due_date' => date("Y-m-d", strtotime("+" . $i . " month", strtotime($this->input->post('date_started')))),
						);
					}

					$this->paymentModel->insert_pment($payment);
				}
				$this->session->set_flashdata('success', 'success');
				$this->session->set_flashdata('message', 'Loan has been created!');
			} else {
				$this->session->set_flashdata('message', 'Something went wrong. Please refresh the page and try again!');
			}
		}

		redirect('loans', 'refresh');
	}

	public function update_loan()
	{
		$this->session->set_flashdata('success', 'danger');

		$this->form_validation->set_rules('borrowers_id', 'Borrowers', 'trim|required');
		$this->form_validation->set_rules('principal', 'Principal Amount', 'trim|required');
		$this->form_validation->set_rules('interest', 'Interest', 'trim|required');
		$this->form_validation->set_rules('penalty', 'Penalty', 'trim|required');

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('message', validation_errors());
		} else {

			$id =  $this->input->post('loan_id');

			$data = array(
				'borrower_id' => $this->input->post('borrowers_id'),
				'loan_type' => $this->input->post('loan_type'),
				'principal' => $this->input->post('principal'),
				'terms' => $this->input->post('terms'),
				'interest' => $this->input->post('interest'),
				'penalty' => $this->input->post('penalty'),
				'date_started' => $this->input->post('date_started'),
				'maturity_date' => $this->input->post('maturity_date'),
				'monthly' => $this->input->post('monthly'),
				'total_amount' => $this->input->post('total'),
				'notes' => $this->input->post('notes'),
				'co_maker' => $this->input->post('cname'),
				'co_maker2' => $this->input->post('cname1'),
			);

			$update =  $this->loanModel->update_loan($data, $id);

			if ($update) {

				$this->paymentModel->delete($id);
				for ($i = 1; $i <= $this->input->post('terms'); $i++) {
					if ($i == 1) {
						$payment = array(
							'loan_id' => $id,
							'due_date' => date("Y-m-d", strtotime("+1 month", strtotime($this->input->post('date_started')))),
							'due' => $this->input->post('principal') / $this->input->post('terms'),
							'p_interest' => $this->input->post('principal') * ($this->input->post('interest') / 100),
							'status' => 'Processing',
						);
					} else {
						$payment =  array(
							'loan_id' => $id,
							'due_date' => date("Y-m-d", strtotime("+" . $i . " month", strtotime($this->input->post('date_started')))),
						);
					}
					$this->paymentModel->insert_pment($payment);
				}

				$this->session->set_flashdata('success', 'success');
				$this->session->set_flashdata('message', 'Loan has been updated!');
			} else {
				$this->session->set_flashdata('message', 'No changes has been made!');
			}
		}

		redirect('loans', 'refresh');
	}

	public function delete($id)
	{

		$delete = $this->loanModel->delete($id);
		$this->session->set_flashdata('success', 'danger');

		if ($delete) {
			$this->session->set_flashdata('message', 'Loan has been deleted!');
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. This Loan cannot be deleted!');
		}
		redirect('loans', 'refresh');
	}

	public function loan_type()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['title'] = 'Type of Loans';

		$data['loan_type'] = $this->loanModel->getLoan_types();

		$this->base->load('default', 'loans/loan_type', $data);
	}

	public function create_loan_type()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this->session->set_flashdata('success', 'danger');

		$this->form_validation->set_rules('name', 'Loan Type', 'trim|required');
		$this->form_validation->set_rules('interest', 'Interest', 'trim|required');
		$this->form_validation->set_rules('terms', 'Terms', 'trim|required');

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('message', validation_errors());
		} else {

			$data = array(
				'name' => $this->input->post('name'),
				'interest' => $this->input->post('interest'),
				'terms' => $this->input->post('terms'),
			);

			$insert =  $this->loanModel->create_loan_type($data);

			if ($insert) {
				$this->session->set_flashdata('success', 'success');
				$this->session->set_flashdata('message', 'Loan type has been created!');
			} else {
				$this->session->set_flashdata('message', 'Something went wrong. Please refresh the page and try again!');
			}
		}

		redirect('loan_type', 'refresh');
	}

	public function update_loan_type()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this->session->set_flashdata('success', 'danger');

		$this->form_validation->set_rules('name', 'Laon Type', 'trim|required');
		$this->form_validation->set_rules('interest', 'Interest', 'trim|required');
		$this->form_validation->set_rules('terms', 'Terms', 'trim|required');

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('message', validation_errors());
		} else {
			$id = $this->input->post('loan_type_id');

			$data = array(
				'name' => $this->input->post('name'),
				'interest' => $this->input->post('interest'),
				'terms' => $this->input->post('terms'),
			);

			$insert =  $this->loanModel->update_loan_type($data, $id);

			if ($insert) {
				$this->session->set_flashdata('success', 'success');
				$this->session->set_flashdata('message', 'Loan type has been update!');
			} else {
				$this->session->set_flashdata('message', 'No changes has been made!');
			}
		}

		redirect('loan_type', 'refresh');
	}

	public function delete_loan_type($id)
	{

		$delete = $this->loanModel->delete_loan_type($id);
		$this->session->set_flashdata('success', 'danger');

		if ($delete) {
			$this->session->set_flashdata('message', 'Loan type has been deleted!');
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. This Loan type cannot be deleted!');
		}
		redirect('loan_type', 'refresh');
	}

	public function loan_details($id)
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['title'] = 'Payment Management';
		$data['borrower'] = $this->loanModel->getloans($id);
		$data['loans'] = $this->paymentModel->getPayment($id);
		$data['trans'] = $this->paymentModel->getTrans($id);

		$this->base->load('default', 'loans/loan_details', $data);
	}

	public function agreement($id)
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['title'] = 'Personal Loan Agreement';
		$data['borrower'] = $this->loanModel->getborrowers($id);

		$data['loans'] = $this->loanModel->getloans($id);

		$this->base->load('default', 'loans/agreement', $data);
	}
	public function authority($id)
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['title'] = 'Letter of Authority';
		$data['borrower'] = $this->loanModel->getborrowers($id);

		$data['loans'] = $this->loanModel->getloans($id);

		$this->base->load('default', 'loans/authority', $data);
	}

	public function ledger($id)
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['title'] = 'Borrowers Loan';
		$data['borrower'] = $this->loanModel->getborrowers($id);

		$data['loans'] = $this->loanModel->getloans($id);
		$data['payments'] = $this->paymentModel->getPayment($id);

		$this->base->load('default', 'loans/ledger', $data);
	}

	public function getLoanType()
	{

		$validator = array('success' => false, 'msg' => array());

		$type = $this->input->post('type');

		$get = $this->loanModel->getType($type);

		if ($get) {
			$validator['success'] = true;
			$validator['msg'] = $get;
		} else {
			$validator['msg'] = $type;
		}
		echo json_encode($validator);
	}
}
