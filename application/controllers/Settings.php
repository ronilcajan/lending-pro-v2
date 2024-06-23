<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

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
    **/

    public function backup(){

		$this->load->dbutil();

        $prefs = array(     
            'format'      => 'zip',             
            'filename'    => 'loanapp.sql',
            'ignore'        => array('users','groups','users_groups','login_attempts'),
        );

        $backup = $this->dbutil->backup($prefs); 

        $db_name = 'loanapp-backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = 'pathtobkfolder/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup); 

        $this->load->helper('download');
        force_download($db_name, $backup);

	}

    public function restore(){

        $config['upload_path'] = './assets/backup/';
		$config['allowed_types'] = '*';

		$this->load->library('upload',$config);

        if(!$this->upload->do_upload('backup_file')){
            
            $this->session->set_flashdata('errors',  $this->upload->display_errors());

        }else{
            $file = $this->upload->data();

            $sql = file_get_contents('./assets/backup/'.$file['file_name']);
            $string_query = rtrim( $sql, '\n;');
            $array_query = explode(';', $sql);

            foreach($array_query as $query){
                $this->db->query($query);
            }
            $this->session->set_flashdata('message', 'Database Restored!');
        }

        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }
}