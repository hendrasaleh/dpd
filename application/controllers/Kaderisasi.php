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
		$data['title'] = 'Data SPU';
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

	public function level()
	{
		$data['title'] = 'Level Anggota';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->order_by('kode_level');
		$data['level'] = $this->db->get('level')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('kaderisasi/level', $data);
		$this->load->view('templates/footer');
	}

	public function tambahLevel()
	{
		$data['title'] = 'Level Anggota';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('kode_level', 'Kode Level', 'required|trim');
		$this->form_validation->set_rules('nama_level', 'Nama Level', 'required|trim');
		
		if ( $this->form_validation->run() == false ) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('kaderisasi/tambah-level', $data);
			$this->load->view('templates/footer');
		} else {

			$data = [
				'kode_level' => $this->input->post('kode_level'),
				'nama_level' => $this->input->post('nama_level')
			];

			$this->db->insert('level', $data);
			$this->session->set_flashdata('message', '<div class="alert col-sm-6 alert-success" role="alert"> Data berhasi ditambahkan.</div>');
			redirect("kaderisasi/level");
		}
	}

	public function editLevel($id)
	{
		$data['title'] = 'Level Anggota';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['level'] = $this->db->get_where('level', ['id' => $id])->row_array();

		$this->form_validation->set_rules('kode_level', 'Kode Level', 'required|trim');
		$this->form_validation->set_rules('nama_level', 'Nama Level', 'required|trim');
		
		if ( $this->form_validation->run() == false ) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('kaderisasi/edit-level', $data);
			$this->load->view('templates/footer');
		} else {
			
			$data = [
				'kode_level' => $this->input->post('kode_level'),
				'nama_level' => $this->input->post('nama_level')
			];

			$this->db->where('id', $id);
			$this->db->update('level', $data);
			$this->session->set_flashdata('message', '<div class="alert col-sm-6 alert-success" role="alert"> Data berhasil diperbaharui.</div>');
			redirect("kaderisasi/level");
		}
	}

	public function hapusLevel($id)
	{
		
		$this->db->delete('level', ['id' => $id]);
		$this->db->delete('upa', ['level_id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert col-sm-6 alert-danger" role="alert"> Data berhasil dihapus!</div>');
		redirect('kaderisasi/level');
	}

	public function upa()
	{
		$data['title'] = 'Data UPA';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['level'] = $this->db->get('level')->result_array();

		$this->db->select('*');
		$this->db->from('spu');
		$this->db->join('upa', 'upa.spu_id = spu.id');
		$this->db->join('level', 'level.id = upa.level_id');
		$this->db->where('upa.level_id', 5);
		$this->db->order_by('upa.nama_ketua');
		$data['upa'] = $this->db->get()->result_array();

		$this->form_validation->set_rules('level_id', 'Kode Level', 'required|trim');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');

		if ($this->form_validation->run() == false) {	
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('kaderisasi/upa', $data);
			$this->load->view('templates/footer');
		} else {
			$level = $this->input->post('level_id');
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$this->db->select('*');
			$this->db->from('spu');
			$this->db->join('upa', 'upa.spu_id = spu.id');
			$this->db->join('level', 'level.id = upa.level_id');
			$this->db->where('upa.level_id', $level);
			$this->db->where('upa.jenis_kelamin', $jenis_kelamin);
			$this->db->order_by('upa.nama_ketua');
			$data['upa'] = $this->db->get()->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('kaderisasi/upa', $data);
			$this->load->view('templates/footer');
		}
	}

	public function tambahUPA()
	{
		$data['title'] = 'Data UPA';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['spu'] = $this->db->get('spu')->result_array();
		$data['level'] = $this->db->get('level')->result_array();

		$this->form_validation->set_rules('level_id', 'Nama Level', 'required|trim');
		$this->form_validation->set_rules('spu_id', 'Nama SPU', 'required|trim');
		$this->form_validation->set_rules('nama_upa', 'Nama Grup', 'required|trim');
		$this->form_validation->set_rules('nama_ketua', 'Ketua UPA', 'required|trim');
		$this->form_validation->set_rules('jenis_kelamin', 'Kelompok', 'required|trim');
		
		if ( $this->form_validation->run() == false ) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('kaderisasi/tambah-upa', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'level_id' => $this->input->post('level_id'),
				'spu_id' => $this->input->post('spu_id'),
				'nama_upa' => $this->input->post('nama_upa'),
				'nama_ketua' => $this->input->post('nama_ketua'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin')
			];

			$this->db->insert('upa', $data);
			$this->session->set_flashdata('message', '<div class="alert col-sm-6 alert-success" role="alert"> Data berhasi ditambahkan.</div>');
			redirect("kaderisasi/upa");
		}
	}

	public function editUPA($id)
	{
		$data['title'] = 'Data UPA';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['spu'] = $this->db->get('spu')->result_array();
		$data['level'] = $this->db->get('level')->result_array();

		$this->db->select('*');
		$this->db->from('spu');
		$this->db->join('upa', 'upa.spu_id = spu.id');
		$this->db->join('level', 'level.id = upa.level_id');
		$this->db->where('upa.upa_id', $id);
		$data['upa'] = $this->db->get()->row_array();

		$this->form_validation->set_rules('level_id', 'Nama Level', 'required|trim');
		$this->form_validation->set_rules('spu_id', 'Nama SPU', 'required|trim');
		$this->form_validation->set_rules('nama_upa', 'Nama Grup', 'required|trim');
		$this->form_validation->set_rules('nama_ketua', 'Ketua UPA', 'required|trim');
		$this->form_validation->set_rules('jenis_kelamin', 'Kelompok', 'required|trim');
		
		if ( $this->form_validation->run() == false ) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('kaderisasi/edit-upa', $data);
			$this->load->view('templates/footer');
		} else {
			
			$data = [
				'level_id' => $this->input->post('level_id'),
				'spu_id' => $this->input->post('spu_id'),
				'nama_upa' => $this->input->post('nama_upa'),
				'nama_ketua' => $this->input->post('nama_ketua'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin')
			];

			$this->db->where('upa_id', $id);
			$this->db->update('upa', $data);
			$this->session->set_flashdata('message', '<div class="alert col-sm-6 alert-success" role="alert"> Data berhasil diperbaharui.</div>');
			redirect("kaderisasi/upa");
		}
	}

	public function hapusUPA($id)
	{
		$this->db->delete('upa', ['upa_id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert col-sm-6 alert-danger" role="alert"> Data berhasil dihapus!</div>');
		redirect('kaderisasi/upa');
	}

	public function tampilSPU()
	{
		$data['title'] = 'Mutabaah Anggota';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->order_by('id');
		$data['spu'] = $this->db->get('spu')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('kaderisasi/tampil-spu', $data);
		$this->load->view('templates/footer');
	}

	public function tampilUPA($id)
	{
		$data['title'] = 'Mutabaah Anggota';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->select('*');
		$this->db->from('spu');
		$this->db->join('upa', 'upa.spu_id = spu.id');
		$this->db->join('level', 'level.id = upa.level_id');
		$this->db->where('upa.spu_id', $id);
		$this->db->order_by('upa.level_id, upa.nama_ketua');
		$data['upa'] = $this->db->get()->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('kaderisasi/tampil-upa', $data);
			$this->load->view('templates/footer');
	}

	public function detailMutabaah($id)
	{
		$data['title'] = 'Mutabaah Anggota';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('range', 'Periode', 'required|trim');

		if( $this->form_validation->run() == false ) {
			$awal = strtotime('first day of '.date('M').' '.date('Y'))-10;
			$akhir = 86400+strtotime(date('Y-m-d'));
			$data['bulan'] = "Bulan " . nama_bulan(date('Y-m-d'));
			$data['awal'] = $awal;
			$data['akhir'] = $akhir;
		} else {
			$input = str_replace(" ", "", $this->input->post('range'));
			$array = explode("-", $input);
			$awal = strtotime($array[0])-10;
			$akhir = 86400+strtotime($array[1]);
			$data['bulan'] = tanggal_indo(date('Y-m-d', strtotime($array[0]))) . " s.d. " . tanggal_indo(date('Y-m-d', strtotime($array[1])));
			$data['awal'] = $awal;
			$data['akhir'] = $akhir;
		}

		$this->db->select('user.email, user.name');
		$this->db->select_sum('jumlah');
		$this->db->from('user');
		$this->db->join('mutabaah', 'mutabaah.email = user.email');
		$this->db->join('upa', 'upa.upa_id = mutabaah.upa_id');
		$this->db->where('upa.upa_id', $id);
		$this->db->where('mutabaah.tanggal >', $awal);
		$this->db->where('mutabaah.tanggal <', $akhir);
		$this->db->group_by('email');
		$data['mutabaah'] = $this->db->get()->result_array();

		$data['upa'] = $this->db->get_where('upa', ['upa_id' => $id])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('kaderisasi/mutabaah', $data);
		$this->load->view('templates/footer');

	}

}