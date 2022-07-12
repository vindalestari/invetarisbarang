<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelola_barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Kelola_barang_model');
        $this->load->model('Kelola_barang_keluar_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'kelola_barang?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kelola_barang?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kelola_barang';
            $config['first_url'] = base_url() . 'kelola_barang';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kelola_barang_model->total_rows($q);
        $kelola_barang = $this->Kelola_barang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kelola_barang_data' => $kelola_barang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Kelola Barang';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Kelola Barang' => '',
        ];

        $data['page'] = 'kelola_barang/kelola_barang_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->Kelola_barang_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama_barang' => $row->nama_barang,
                'jumlah' => $row->jumlah,
                'merk' => $row->merk,
            );
            $data['title'] = 'Kelola Barang';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'kelola_barang/kelola_barang_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kelola_barang'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kelola_barang/create_action'),
            'id' => set_value('id'),
            'nama_barang' => set_value('nama_barang'),
            // 'jumlah' => set_value('jumlah'),
            'merk' => set_value('merk'),
        );
        $data['title'] = 'Kelola Barang';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kelola_barang/kelola_barang_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'jumlah' => 0,
                'merk' => $this->input->post('merk', TRUE),
            );

            $this->Kelola_barang_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('kelola_barang'));
        }
    }
    public function distribusi($id)
    {
        $row = $this->Kelola_barang_model->get_by_id($id);

        $data = array(
            'button' => 'Distribusi',
            'action' => site_url('kelola_barang/distribusi_action'),
            'id' => $row->id,
            'nama_barang' => $row->nama_barang,
            'jumlah' => $row->jumlah,
            'merk' => $row->merk,

            // 'nama_barang' => set_value('nama_barang'),
            // 'jumlah' => set_value('jumlah'),
            // 'merk' => set_value('merk'),
        );
        $data['title'] = 'Kelola Barang';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kelola_barang/distribusi_form';
        $this->load->view('template/backend', $data);
    }

    public function distribusi_action()
    {


        $data = array(
            'id_user' => $this->session->userdata('user_id'),
            'id_barang' => $this->input->post('id', TRUE),
            'jml_barang_keluar' => $this->input->post('jml_barang_keluar', TRUE),
            'tgl_keluar' => date('Y-m-d'),
            'tujuan' => $this->input->post('tujuan', TRUE),
        );

        // insert ke kelola_barang_keluar
        $this->db->insert('kelola_barang_keluar', $data);

        // get jumlah dari kelola barang
        $jml_barang = $this->db->get_where('kelola_barang', ['id' => $this->input->post('id', TRUE)])->row()->jumlah;
        $data_barang = array(
            'jumlah' => $jml_barang - $this->input->post('jml_barang_keluar', TRUE),
        );

        // update jumlah barang di kelola_barang    
        $this->db->where('id', $this->input->post('id', TRUE));
        $this->db->update('kelola_barang', $data_barang);

        $this->session->set_flashdata('success', 'Create Record Success');
        redirect(site_url('kelola_barang'));
    }

    public function update($id)
    {
        $row = $this->Kelola_barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelola_barang/update_action'),
                'id' => set_value('id', $row->id),
                'nama_barang' => set_value('nama_barang', $row->nama_barang),
                'jumlah' => set_value('jumlah', $row->jumlah),
                'merk' => set_value('merk', $row->merk),
            );
            $data['title'] = 'Kelola Barang';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'kelola_barang/kelola_barang_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kelola_barang'));
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
                'jumlah' => $this->input->post('jumlah', TRUE),
                'merk' => $this->input->post('merk', TRUE),
            );

            $this->Kelola_barang_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('kelola_barang'));
        }
    }

    public function delete($id)
    {
        $row = $this->Kelola_barang_model->get_by_id($id);

        if ($row) {
            $this->Kelola_barang_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('kelola_barang'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kelola_barang'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Kelola_barang_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
        // $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
        $this->form_validation->set_rules('merk', 'merk', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Kelola_barang.php */
/* Location: ./application/controllers/Kelola_barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-06-30 10:22:11 */
/* http://harviacode.com */