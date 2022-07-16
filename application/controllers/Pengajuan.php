<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Pengajuan_model');
        $this->load->model('Kelola_barang_masuk_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengajuan?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengajuan?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengajuan';
            $config['first_url'] = base_url() . 'pengajuan';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengajuan_model->total_rows($q);
        $pengajuan = $this->Pengajuan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengajuan_data' => $pengajuan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Pengajuan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Pengajuan' => '',
        ];

        $data['page'] = 'pengajuan/pengajuan_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->Pengajuan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama_barang' => nama_barang($row->id_barang),
                'jumlah_barang' => $row->jumlah_barang,
                'tanggal_pengajuan' => $row->tanggal_pengajuan,
                'status' => $row->status,
            );
            $data['title'] = 'Pengajuan';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'pengajuan/pengajuan_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('pengajuan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pengajuan/create_action'),
            'id' => set_value('id'),
            'id_barang' => set_value('id_barang'),
            'jumlah_barang' => set_value('jumlah_barang'),
            'harga_barang' => set_value('harga_barang'),
            'total_harga' => set_value('total_harga'),
            'id_supplier' => set_value('id_supplier'),
            //'status' => set_value('status'),
        );
        $data['title'] = 'Pengajuan';
        $data['subtitle'] = '';
        $data['barang'] = $this->db->query("SELECT * from kelola_barang")->result();
        $data['supplier'] = $this->db->query("SELECT * from kelola_supplier")->result();
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pengajuan/pengajuan_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_barang' => $this->input->post('id_barang', TRUE),
                'id_supplier' => $this->input->post('id_supplier', TRUE),
                'jumlah_barang' => $this->input->post('jumlah_barang', TRUE),
                'tanggal_pengajuan' => date('Y-m-d'),
                'status' => 0,
                'harga_barang' => $this->input->post('harga_barang', TRUE),
                'total_harga' => $this->input->post('harga_barang', TRUE) * $this->input->post('jumlah_barang', TRUE),
            );

            $this->Pengajuan_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('pengajuan'));
        }
    }

    public function setujui($id_pengajuan)
    {
        if ($this->Pengajuan_model->setujui($id_pengajuan)) {
            $pengajuan = $this->db->query("select * from pengajuan where id=$id_pengajuan")->row();
            $data = array(
                'id_user' => $this->session->userdata('user_id'),
                'id_pengajuan' => $pengajuan->id,
                'id_supplier' => $pengajuan->id_supplier,
                'harga_barang' => $pengajuan->harga_barang,
                'jml_barang_masuk' => $pengajuan->jumlah_barang,
                'total_harga' => $pengajuan->harga_barang * $pengajuan->jumlah_barang,
                'tgl_masuk' => date('Y-m-d')
            );
            $this->Kelola_barang_masuk_model->insert($data);
            $this->session->set_flashdata('success', 'data disetujui');
            redirect(site_url('pengajuan'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('pengajuan'));
        }
    }

    public function tidak_disetujui($id_pengajuan)
    {
        if ($this->Pengajuan_model->tidak_disetujui($id_pengajuan)) {
            $this->session->set_flashdata('success', 'data tidak disetujui');
            redirect(site_url('pengajuan'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('pengajuan'));
        }
    }

    public function update($id)
    {
        $row = $this->Pengajuan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengajuan/update_action'),
                'id' => set_value('id', $row->id),
                'nama_barang' => set_value('nama_barang', $row->nama_barang),
                'jumlah_barang' => set_value('jumlah_barang', $row->jumlah_barang),
                'tanggal_pengajuan' => set_value('tanggal_pengajuan', $row->tanggal_pengajuan),
                'status' => set_value('status', $row->status),
            );
            $data['title'] = 'Pengajuan';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'pengajuan/pengajuan_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('pengajuan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'jumlah_barang' => $this->input->post('jumlah_barang', TRUE),
                'tanggal_pengajuan' => $this->input->post('tanggal_pengajuan', TRUE),
                'status' => $this->input->post('status', TRUE),
            );

            $this->Pengajuan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('pengajuan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pengajuan_model->get_by_id($id);

        if ($row) {
            $this->Pengajuan_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('pengajuan'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('pengajuan'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Pengajuan_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_barang', 'id_barang', 'trim|required');
        $this->form_validation->set_rules('jumlah_barang', 'jumlah barang', 'trim|required');
        // $this->form_validation->set_rules('tanggal_pengajuan', 'tanggal pengajuan', 'trim|required');
        // $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Pengajuan.php */
/* Location: ./application/controllers/Pengajuan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-06-30 10:22:23 */
/* http://harviacode.com */