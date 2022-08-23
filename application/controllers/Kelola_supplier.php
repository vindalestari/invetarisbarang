<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelola_supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Kelola_supplier_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kelola_supplier?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kelola_supplier?q=' . urlencode($q);
            
        } else {
            $config['base_url'] = base_url() . 'kelola_supplier';
            $config['first_url'] = base_url() . 'kelola_supplier';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kelola_supplier_model->total_rows($q);
        $kelola_supplier = $this->Kelola_supplier_model->get_limit_data($config['per_page'], $start, $q);
        // print_r($kelola_supplier);die;

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kelola_supplier_data' => $kelola_supplier,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Kelola Supplier';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Kelola Supplier' => '',
        ];

        $data['page'] = 'kelola_supplier/kelola_supplier_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Kelola_supplier_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'telepon' => $row->telepon,
		'alamat' => $row->alamat,
	    );
        $data['title'] = 'Kelola Supplier';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kelola_supplier/kelola_supplier_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kelola_supplier'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kelola_supplier/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'telepon' => set_value('telepon'),
	    'alamat' => set_value('alamat'),
	);
        $data['title'] = 'Kelola Supplier';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kelola_supplier/kelola_supplier_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'telepon' => $this->input->post('telepon',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->Kelola_supplier_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('kelola_supplier'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kelola_supplier_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelola_supplier/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'telepon' => set_value('telepon', $row->telepon),
		'alamat' => set_value('alamat', $row->alamat),
	    );
            $data['title'] = 'Kelola Supplier';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kelola_supplier/kelola_supplier_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kelola_supplier'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'telepon' => $this->input->post('telepon',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->Kelola_supplier_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('kelola_supplier'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kelola_supplier_model->get_by_id($id);

        if ($row) {
            $this->Kelola_supplier_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('kelola_supplier'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kelola_supplier'));
        }
    }

    public function deletebulk(){
        $delete = $this->Kelola_supplier_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('success', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('telepon', 'telepon', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kelola_supplier.php */
/* Location: ./application/controllers/Kelola_supplier.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-06-30 10:22:20 */
/* http://harviacode.com */