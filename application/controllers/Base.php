<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('csv_model');
		$this->load->library('csvimport');
	}

	function Index() {
		$data['contatos'] = $this->csv_model->get_contatos();
		$this->load->view('home', $data);
	}

	function ImportCsv() {
		$data['contatos'] = $this->csv_model->get_contatos();
		$data['error'] = '';    //initialize image upload error array to empty

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'csv';
		$config['max_size'] = '1000';

		$this->load->library('upload', $config);

		// If upload failed, display error
		if (!$this->upload->do_upload('csvfile')) {
			$data['error'] = $this->upload->display_errors();

			$this->load->view('home', $data);
		} else {
			$file_data = $this->upload->data();
			$file_path =  './uploads/'.$file_data['file_name'];

			if ($this->csvimport->get_array($file_path)) {
				$csv_array = $this->csvimport->get_array($file_path);
				foreach ($csv_array as $row) {
					$insert_data = array(
						'nome' => $row['nome'],
						'email' => $row['email']
					);
					$this->csv_model->insert_csv($insert_data);
				}
				$this->session->set_flashdata('success', 'Dados importados com sucesso!');
				redirect();
			} else
			$data['error'] = "Ocorreu um erro, desculpe!";
			$this->load->view('home', $data);
		}

	}
}
