<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Borrowers extends CI_Controller {

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
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['title'] = 'Borrowers Management';
		$data['borrowers'] = $this->borrowersModel->borrowers();

		$this->base->load('default', 'borrowers/manage', $data);
	}

	public function borrowers_profile($id)
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['title'] = 'Borrowers Profile';
		$data['borrowers'] = $this->borrowersModel->borrowers();
		$data['borrower'] = $this->borrowersModel->getborrowers($id);

		$data['loans'] = $this->borrowersModel->getloans($id);
		$data['transac'] = $this->paymentModel->getTransac($id);

		$this->base->load('default', 'borrowers/borrowers_profile', $data);
	}

	public function create_borrowers(){

		$config['upload_path'] = 'assets/uploads/borrowers/';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);

		$this->session->set_flashdata('success', 'danger');

		$this->form_validation->set_rules('name','Full Name', 'trim|required');
		$this->form_validation->set_rules('gender','Gender', 'trim|required');
		$this->form_validation->set_rules('bdate','Birth Date', 'trim|required');
		$this->form_validation->set_rules('number','Contact Number', 'trim|required');
		$this->form_validation->set_rules('occupation','Occupation', 'trim|required');
		$this->form_validation->set_rules('em_address',"Employer's Address", 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        if ($this->form_validation->run() == FALSE){

			$this->session->set_flashdata('message', validation_errors());

        }else{

            if(empty($this->input->post('profileimg')) && !$this->upload->do_upload('avatar')){
				$data = array(
					'name' => $this->input->post('name'),
					'gender' => $this->input->post('gender'),
					'birthdate' => $this->input->post('bdate'),
					'number' => $this->input->post('number'),
					'occupation' => $this->input->post('occupation'),
					'employer_address' => $this->input->post('em_address'),
					'spouse_name' => $this->input->post('spouse_name'),
					'spouse_occupation' => $this->input->post('spouse_occu'),
					'spouse_em_address' => $this->input->post('spouse_em_address'),
					'address' => $this->input->post('address'),
				);
    
            } else if(!empty($this->input->post('profileimg')) && !$this->upload->do_upload('avatar')){
    
				$data = array(
					'name' => $this->input->post('name'),
					'gender' => $this->input->post('gender'),
					'birthdate' => $this->input->post('bdate'),
					'number' => $this->input->post('number'),
					'occupation' => $this->input->post('occupation'),
					'employer_address' => $this->input->post('em_address'),
					'spouse_name' => $this->input->post('spouse_name'),
					'spouse_occupation' => $this->input->post('spouse_occu'),
					'spouse_em_address' => $this->input->post('spouse_em_address'),
					'address' => $this->input->post('address'),
					'avatar' => $this->input->post('profileimg'),
				);
    
            }else{
    
                $file = $this->upload->data();
                //Resize and Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'assets/uploads/avatar/'.$file['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['new_image'] = 'assets/uploads/avatar/'.$file['file_name'];
    
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data = array(
					'name' => $this->input->post('name'),
					'gender' => $this->input->post('gender'),
					'birthdate' => $this->input->post('bdate'),
					'number' => $this->input->post('number'),
					'occupation' => $this->input->post('occupation'),
					'employer_address' => $this->input->post('em_address'),
					'spouse_name' => $this->input->post('spouse_name'),
					'spouse_occupation' => $this->input->post('spouse_occu'),
					'spouse_em_address' => $this->input->post('spouse_em_address'),
					'address' => $this->input->post('address'),
					'avatar' => $file['file_name'],
				);
            }

            $insert =  $this->borrowersModel->add($data);
    
            if($insert){
                $this->session->set_flashdata('success', 'success');
				$this->session->set_flashdata('message', 'Borrowers has been added!');
            }else{
                $this->session->set_flashdata('message', 'Something went wrong. Please refresh the page and try again!');
            }
        }

		redirect('borrowers', 'refresh');
	}

	public function update_borrowers(){

		$config['upload_path'] = 'assets/uploads/borrowers/';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);

		$this->session->set_flashdata('success', 'danger');

		$this->form_validation->set_rules('name','Full Name', 'trim|required');
		$this->form_validation->set_rules('gender','Gender', 'trim|required');
		$this->form_validation->set_rules('bdate','Birth Date', 'trim|required');
		$this->form_validation->set_rules('number','Contact Number', 'trim|required');
		$this->form_validation->set_rules('occupation','Occupation', 'trim|required');
		$this->form_validation->set_rules('em_address',"Employer's Address", 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        if ($this->form_validation->run() == FALSE){

			$this->session->set_flashdata('message', validation_errors());

        }else{

			$id = $this->input->post('id');

            if(empty($this->input->post('profileimg')) && !$this->upload->do_upload('avatar')){
				$data = array(
					'name' => $this->input->post('name'),
					'gender' => $this->input->post('gender'),
					'birthdate' => $this->input->post('bdate'),
					'number' => $this->input->post('number'),
					'occupation' => $this->input->post('occupation'),
					'employer_address' => $this->input->post('em_address'),
					'spouse_name' => $this->input->post('spouse_name'),
					'spouse_occupation' => $this->input->post('spouse_occu'),
					'spouse_em_address' => $this->input->post('spouse_em_address'),
					'address' => $this->input->post('address'),
				);
    
            } else if(!empty($this->input->post('profileimg')) && !$this->upload->do_upload('avatar')){
    
				$data = array(
					'name' => $this->input->post('name'),
					'gender' => $this->input->post('gender'),
					'birthdate' => $this->input->post('bdate'),
					'number' => $this->input->post('number'),
					'occupation' => $this->input->post('occupation'),
					'employer_address' => $this->input->post('em_address'),
					'spouse_name' => $this->input->post('spouse_name'),
					'spouse_occupation' => $this->input->post('spouse_occu'),
					'spouse_em_address' => $this->input->post('spouse_em_address'),
					'address' => $this->input->post('address'),
					'avatar' => $this->input->post('profileimg'),
				);
    
            }else{
    
                $file = $this->upload->data();
                //Resize and Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'assets/uploads/avatar/'.$file['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['new_image'] = 'assets/uploads/avatar/'.$file['file_name'];
    
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data = array(
					'name' => $this->input->post('name'),
					'gender' => $this->input->post('gender'),
					'birthdate' => $this->input->post('bdate'),
					'number' => $this->input->post('number'),
					'occupation' => $this->input->post('occupation'),
					'employer_address' => $this->input->post('em_address'),
					'spouse_name' => $this->input->post('spouse_name'),
					'spouse_occupation' => $this->input->post('spouse_occu'),
					'spouse_em_address' => $this->input->post('spouse_em_address'),
					'address' => $this->input->post('address'),
					'avatar' => $file['file_name'],
				);
            }

            $insert =  $this->borrowersModel->update($data, $id);
    
            if($insert){
                $this->session->set_flashdata('success', 'success');
				$this->session->set_flashdata('message', 'Borrowers has been updated!');
            }else{
                $this->session->set_flashdata('message', 'No changes has been made!');
            }
        }

		redirect('borrowers', 'refresh');
	}

	public function delete($id){

		$delete = $this->borrowersModel->delete($id);
		$this->session->set_flashdata('success', 'danger');

        if($delete){
            $this->session->set_flashdata('message', 'Borrowers has been deleted!');
        }else{
            $this->session->set_flashdata('message', 'Something went wrong. This borrower cannot be deleted!');
        }
		redirect('borrowers', 'refresh');
	}
}
