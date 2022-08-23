<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelola_barang_keluar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Kelola_barang_keluar_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'kelola_barang_keluar?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kelola_barang_keluar?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kelola_barang_keluar';
            $config['first_url'] = base_url() . 'kelola_barang_keluar';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kelola_barang_keluar_model->total_rows($q);
        $kelola_barang_keluar = $this->Kelola_barang_keluar_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kelola_barang_keluar_data' => $kelola_barang_keluar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Daftar Barang Keluar';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Daftar Barang Keluar' => '',
        ];

        $data['page'] = 'kelola_barang_keluar/kelola_barang_keluar_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->Kelola_barang_keluar_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'id_user' => $row->id_user,
                'id_barang' => $row->id_barang,
                'nama_barang' => nama_barang($row->id_barang),
                'jml_barang_keluar' => $row->jml_barang_keluar,
                'tgl_keluar' => $row->tgl_keluar,
                'tujuan' => $row->tujuan,
            );
            $data['title'] = 'Daftar Barang Keluar';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'kelola_barang_keluar/kelola_barang_keluar_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kelola_barang_keluar'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kelola_barang_keluar/create_action'),
            'id' => set_value('id'),
            'id_user' => set_value('id_user'),
            'id_barang' => set_value('id_barang'),
            'nama_barang' => set_value('nama_barang'),
            'jml_barang_keluar' => set_value('jml_barang_keluar'),
            'tgl_keluar' => set_value('tgl_keluar'),
            'tujuan' => set_value('tujuan'),
        );
        $data['title'] = 'Kelola Barang Keluar';
        $data['barang'] = $this->db->query("SELECT * FROM barang where jumlah != 0")->result();
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kelola_barang_keluar/kelola_barang_keluar_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_user' => $this->input->post('id_user', TRUE),
                'id_barang' => $this->input->post('id_barang', TRUE),
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'jml_barang_keluar' => $this->input->post('jml_barang_keluar', TRUE),
                'tgl_keluar' => $this->input->post('tgl_keluar', TRUE),
                'tujuan' => $this->input->post('tujuan', TRUE),
            );

            $this->Kelola_barang_keluar_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('kelola_barang_keluar'));
        }
    }

    public function update($id)
    {
        $row = $this->Kelola_barang_keluar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelola_barang_keluar/update_action'),
                'id' => set_value('id', $row->id),
                'id_user' => set_value('id_user', $row->id_user),
                'id_barang' => set_value('id_barang', $row->id_barang),
                'nama_barang' => set_value('nama_barang', $row->nama_barang),
                'jml_barang_keluar' => set_value('jml_barang_keluar', $row->jml_barang_keluar),
                'tgl_keluar' => set_value('tgl_keluar', $row->tgl_keluar),
                'tujuan' => set_value('tujuan', $row->tujuan),
            );
            $data['title'] = 'Kelola Barang Keluar';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'kelola_barang_keluar/kelola_barang_keluar_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kelola_barang_keluar'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_user' => $this->input->post('id_user', TRUE),
                'id_barang' => $this->input->post('id_barang', TRUE),
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'jml_barang_keluar' => $this->input->post('jml_barang_keluar', TRUE),
                'tgl_keluar' => $this->input->post('tgl_keluar', TRUE),
                'tujuan' => $this->input->post('tujuan', TRUE),
            );

            $this->Kelola_barang_keluar_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('kelola_barang_keluar'));
        }
    }

    public function delete($id)
    {
        $row = $this->Kelola_barang_keluar_model->get_by_id($id);

        if ($row) {
            $this->Kelola_barang_keluar_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('kelola_barang_keluar'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kelola_barang_keluar'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Kelola_barang_keluar_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_user', 'id user', 'trim|required');
        $this->form_validation->set_rules('id_barang', 'id barang', 'trim|required');
        $this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
        $this->form_validation->set_rules('jml_barang_keluar', 'jml barang keluar', 'trim|required');
        $this->form_validation->set_rules('tgl_keluar', 'tgl keluar', 'trim|required');
        $this->form_validation->set_rules('tujuan', 'tujuan', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Kelola_barang_keluar.php */
/* Location: ./application/controllers/Kelola_barang_keluar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-06-30 10:22:14 */
/* http://harviacode.com */