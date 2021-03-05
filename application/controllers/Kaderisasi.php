<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kaderisasi extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Data SPU';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->select('*');
		$this->db->from('reg_regencies');
		$this->db->join('spu', 'spu.regency_id = reg_regencies.id');
		$this->db->order_by('spu.id');
		$data['spu'] = $this->db->get()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('kaderisasi/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambahSPU()
	{
		$data['title'] = 'Tambah SPU';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['kabupaten'] = $this->db->get_where('reg_regencies', ['province_id' => 32])->result_array();

		$this->form_validation->set_rules('nama_spu', 'Nama SPU', 'required|trim');
		$this->form_validation->set_rules('ketua_spu', 'Ketua SPU', 'required|trim');
		
		if ( $this->form_validation->run() == false ) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('kaderisasi/tambah-spu', $data);
			$this->load->view('templates/footer');
		} else {

			$data = [
				'nama_spu' => $this->input->post('nama_spu'),
				'ketua_spu' => $this->input->post('ketua_spu'),
				'regency_id' => $this->input->post('kabupaten')
			];

			$this->db->insert('spu', $data);
			$this->session->set_flashdata('message', '<div class="alert col-sm-6 alert-success" role="alert"> Data berhasi ditambahkan.</div>');
			redirect("kaderisasi");
		}
	}

	public function editSPU($id)
	{
		$data['title'] = 'Data SPU';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->select('*');
		$this->db->from('reg_regencies');
		$this->db->join('spu', 'spu.regency_id = reg_regencies.id');
		$this->db->where('spu.id', $id);
		$data['spu'] = $this->db->get()->row_array();
		$data['kabupaten'] = $this->db->get_where('reg_regencies', ['province_id' => 32])->result_array();

		$this->form_validation->set_rules('nama_spu', 'Nama SPU', 'required|trim');
		$this->form_validation->set_rules('ketua_spu', 'Ketua SPU', 'required|trim');
		
		if ( $this->form_validation->run() == false ) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('kaderisasi/edit-spu', $data);
			$this->load->view('templates/footer');
		} else {
			
			$data = [
				'nama_spu' => $this->input->post('nama_spu'),
				'ketua_spu' => $this->input->post('ketua_spu'),
				'regency_id' => $this->input->post('kabupaten')
			];

			$this->db->where('id', $id);
			$this->db->update('spu', $data);
			$this->session->set_flashdata('message', '<div class="alert col-sm-6 alert-success" role="alert"> Data berhasil diperbaharui.</div>');
			redirect("kaderisasi");
		}
	}

	public function hapusSPU($id)
	{
		
		$this->db->delete('spu', ['id' => $id]);
		$this->db->delete('upa', ['spu_id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert col-sm-6 alert-danger" role="alert"> Data berhasil dihapus!</div>');
		redirect('kaderisasi');
	}


}
