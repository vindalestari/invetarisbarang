<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
	}

	public function index()
	{

		$data['title'] = 'Dashboard';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Dashboard' => '',
		];

		// count users
		$data['count_users'] = $this->db->get('users')->num_rows();

		// count kelola barang masuk
		$data['count_barang_masuk'] = $this->db->get('Kelola_barang_masuk')->num_rows();

		// count kelola barang keluar
		$data['count_barang_keluar'] = $this->db->get('Kelola_barang_keluar')->num_rows();

		// count supplier
		$data['count_supplier'] = $this->db->get('kelola_supplier')->num_rows();



		//$this->layout->set_privilege(1);
		$data['page'] = 'Dashboard/Index';
		$this->load->view('template/backend', $data);
	}
}
