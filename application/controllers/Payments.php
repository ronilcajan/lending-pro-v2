<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payments extends CI_Controller
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

	public function transactions()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['transac'] = $this->paymentModel->getTransactions();

		$data['title'] = 'Transactions History';

		$this->base->load('default', 'payments/transactions', $data);
	}

	public function reports()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['reports'] = $this->paymentModel->reports();

		$data['title'] = 'Loan Reports';

		$this->base->load('default', 'report/manage', $data);
	}

	public function save_payment()
	{
		$this->session->set_flashdata('success', 'danger');

		$this->form_validation->set_rules('pment_id', 'Payment ID', 'trim|required');

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('message', validation_errors());
		} else {

			$payment_id = $this->input->post('pment_id');
			$amount = $this->input->post('amount');
			$notes = $this->input->post('notes');
			$date = $this->input->post('date');
			$skip = $this->input->post('skip');
			$terms = $this->input->post('terms');
			$next_pay = $payment_id + 1;

			$loan = $this->paymentModel->getLoan($payment_id);

			$to_pay = $loan->due + $loan->p_interest + $loan->p_penalty;

			if ($loan) {
				// when payment skip for a month
				if ($skip == 'Skip') {

					$data = array(
						'remarks' => 'Skip Payment',
						'status' => 'Unpaid',
						'date' => $date,
					);

					$this->paymentModel->updatePayment($data, $payment_id);

					$due = $loan->due + ($loan->principal / $loan->terms);
					$interest = $loan->p_interest + ($loan->principal * ($loan->interest / 100));
					$penalty = ($due + $interest) * ($loan->penalty / 100);

					$data1 = array(
						'due' => $due,
						'p_interest' => $interest,
						'p_penalty' => $penalty,
						'status' => 'Processing'
					);

					$this->paymentModel->updatePayment($data1, $next_pay);
					$this->session->set_flashdata('message', 'Payment has been skip!');
				} else {

					// When payment is exact as monthly payment
					if ($amount == $to_pay) {
						$data = array(
							'remarks' => $notes,
							'status' => 'Paid',
							'amount' => $amount,
							'date' => $date,
						);

						$this->paymentModel->updatePayment($data, $payment_id);

						// check if this payment is the last to pay
						if ($terms != $loan->terms) {
							$due = ($loan->principal / $loan->terms);
							$interest = ($loan->principal * ($loan->interest / 100));

							$data1 = array(
								'due' => $due,
								'p_interest' => $interest,
								'status' => 'Processing'
							);
							$this->paymentModel->updatePayment($data1, $next_pay);
						} else {

							$loan_d = array(
								'status' => 'Paid',
							);

							$this->loanModel->update_loan($loan_d, $loan->loan_id);
						}

						$this->session->set_flashdata('message', 'Payment successful!');

						// when payment is more than the monthly amount
					} elseif ($amount > $to_pay) {
						$data = array(
							'remarks' => $notes,
							'status' => 'Paid',
							'amount' => $amount,
							'date' => $date,
						);

						$this->paymentModel->updatePayment($data, $payment_id);


						$total = $amount - $to_pay; #calculate the excess payment and add to the due
						$due = ($loan->principal / $loan->terms) - $total;
						$interest = ($loan->principal * ($loan->interest / 100));

						$data1 = array(
							'due' => $due,
							'p_interest' => $interest,
							'status' => 'Processing'
						);

						$this->paymentModel->updatePayment($data1, $next_pay);
						$this->session->set_flashdata('message', 'Payment successful!');

						// when payment is lacking
					} else {

						$data = array(
							'remarks' => $notes,
							'status' => 'Partial',
							'amount' => $amount,
							'date' => $date,
						);
						$this->paymentModel->updatePayment($data, $payment_id);

						$penalty = $amount - $loan->p_penalty;
						$interest = $penalty - $loan->p_interest;
						$remaining = $loan->due - $interest;

						$due = ($loan->principal / $loan->terms) + $remaining;
						$interest = ($loan->principal * ($loan->interest / 100));
						$penalty = ($due + $interest) * ($loan->penalty / 100);

						$data1 = array(
							'due' => $due,
							'p_interest' => $interest,
							'p_penalty' => $penalty,
							'status' => 'Processing'
						);

						$this->paymentModel->updatePayment($data1, $next_pay);
						$this->session->set_flashdata('message', 'Payment successful!');
					}

					$transac = array(
						'loan_id' => $loan->loan_id,
						'username' => $this->session->username,
						'trans_date' => $date,
						'total_amount' => $amount
					);

					$this->paymentModel->insert_transaction($transac);
					$this->session->set_flashdata('success', 'success');
				}
			} else {
				$this->session->set_flashdata('message', 'Something went wrong. Please refresh the page and try again!');
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
}
