<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	
	public function index()
	{
		$data['title'] = 'User Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->db->order_by('submenu_sequence');
		$data['menu'] = $this->db->get_where('user_sub_menu', ['menu_id' => 2, 'submenu_sequence >' => 1])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function profile()
	{
		$data['title'] = 'My Profile';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['detail'] = $this->db->get_where('user_detail', ['email' => $this->session->userdata('email')])->row_array();
		$data['prov'] = $this->db->get_where('reg_provinces', ['id' => $data['user']['province_id']])->row_array();
		$data['kab'] = $this->db->get_where('reg_regencies', ['id' => $data['user']['regency_id']])->row_array();
		$data['kec'] = $this->db->get_where('reg_districts', ['id' => $data['user']['district_id']])->row_array();
		$data['desa'] = $this->db->get_where('reg_villages', ['id' => $data['user']['village_id']])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('user/profile', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['detail'] = $this->db->get_where('user_detail', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');

			// cek jika ada gambar (file) yang akan diupload
			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']      = '2048';
				$config['upload_path']   = './assets/img/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					// cek dulu gambar lamanya apakah default
					$old_image = $data['user']['image'];
					if ( $old_image != 'default.jpg') {
						// jika bukan, maka hapus saja agar tidak terjadi penumpukan file
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$this->db->set('date_modified', time());
			$this->db->set('name', $name);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your profile has been updated!</div>');
			redirect('user');
		}
	}

	public function file_check()
	{
        $allowed_type_file = array('application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.documen', 'application/pdf', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $mime = get_mime_by_extension($_FILES['file']['name']);

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            if (in_array($mime, $allowed_type_file)) {
                if ($_FILES['file']['size'] > 6144000) {
                    $this->form_validation->set_message('file_check', 'Ukuran file terlalu besar! Pastikan kurang dari 5MB!');
                    return FALSE;
                } else {
                return TRUE;                    
                }
            } else {
                $this->form_validation->set_message('file_check', 'Jenis file tidak diizinkan!');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Pilih file untuk diupload!');
                return FALSE;
        }
    }

    public function changePassword()
	{
		$data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');
		if ($this->form_validation->run() == false) {
			# code...
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('user/changepassword', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Wrong current password!</div>');
				redirect('user/changepassword');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> New password cannot be the same as current password!</div>');
					redirect('user/changepassword');
				} else {
					// password sudah ok
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');

					$this->session->unset_userdata('email');
					$this->session->unset_userdata('role_id');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password changed! Please login with new password.</div>');
					redirect('auth');
				}
			}
		}
	}

	public function mutabaah()
	{
		$data['title'] = 'Data Mutabaah';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->select('*');
		$this->db->from('upa');
		$this->db->join('user', 'user.upa_id = upa.upa_id');
		$this->db->where('user.email', $this->session->userdata('email'));
		$data['anggota'] = $this->db->get()->row_array();

		$data['mutabaah'] = $this->db->get_where('mutabaah', ['email' => $this->session->userdata('email')])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/mutabaah', $data);
		$this->load->view('templates/footer');

	}

	public function inputMutabaah()
	{
		$data['title'] = 'Data Mutabaah';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('tgl_upa', 'Tanggal pelaksanaan UPA', 'required|trim');
		$this->form_validation->set_rules('liqo', 'Kehadiran UPA', 'required|trim');
		$this->form_validation->set_rules('berjamaah', 'Shalat berjamaah', 'required|trim');
		$this->form_validation->set_rules('tilawah', 'Tilawah', 'required|trim');
		$this->form_validation->set_rules('dzikir_pagi', 'Dzikir pagi', 'required|trim');
		$this->form_validation->set_rules('dzikir_petang', 'Dzikir petang', 'required|trim');
		$this->form_validation->set_rules('dzikir_lain', 'Dzikir Tasbih', 'required|trim');
		$this->form_validation->set_rules('shalawat', 'Shalawat', 'required|trim');
		$this->form_validation->set_rules('qiyamullail', 'Qiyamullail', 'required|trim');
		$this->form_validation->set_rules('dhuha', 'Shalat Dhuha', 'required|trim');
		$this->form_validation->set_rules('bantu_prt', 'Pekerjaan rumah', 'required|trim');
		$this->form_validation->set_rules('infaq', 'Infaq', 'required|trim');
		$this->form_validation->set_rules('shaum_sunnah', 'Shaum sunnah', 'required|trim');
		$this->form_validation->set_rules('olah_raga', 'Olah raga', 'required|trim');

		if( $this->form_validation->run() == false ) {
		
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('user/input-mutabaah', $data);
			$this->load->view('templates/footer');
		
		} else {

			$dzikir_lain = $this->input->post('dzikir_lain')*100;
			$shalawat = $this->input->post('shalawat')*100;
			$data = [
						'tanggal' => time(),
						'email' => $this->input->post('email'),
						'upa_id' => $this->input->post('upa_id'),
						'tgl_upa' => strtotime($this->input->post('tgl_upa')),
						'liqo' => $this->input->post('liqo'),
						'qiyamullail' => $this->input->post('qiyamullail'),
						'dhuha' => $this->input->post('dhuha'),
						'tilawah' => $this->input->post('tilawah'),
						'bantu_prt' => $this->input->post('bantu_prt'),
						'dzikir_pagi' => $this->input->post('dzikir_pagi'),
						'infaq' => $this->input->post('infaq'),
						'shaum_sunnah' => $this->input->post('shaum_sunnah'),
						'dzikir_petang' => $this->input->post('dzikir_petang'),
						'olah_raga' => $this->input->post('olah_raga'),
						'dzikir_lain' => $dzikir_lain,
						'berjamaah' => $this->input->post('berjamaah'),
						'shalawat' => $shalawat,
						'jumlah' => $this->input->post('liqo')+$this->input->post('qiyamullail')+$this->input->post('dhuha')+$this->input->post('tilawah')+$this->input->post('bantu_prt')+$this->input->post('dzikir_pagi')+$this->input->post('infaq')+$this->input->post('shaum_sunnah')+$this->input->post('dzikir_petang')+$this->input->post('olah_raga')+$dzikir_lain+$this->input->post('berjamaah')+$shalawat
			];

			$this->db->insert('mutabaah', $data);
			$this->session->set_flashdata('message', '<div class="alert col-sm-6 alert-success" role="alert"> Data berhasil ditambahkan.</div>');
			redirect('user/mutabaah');
		}
	}

	public function detailmutabaah($id)
	{
		$data['title'] = 'Data Mutabaah';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->select('*');
		$this->db->from('upa');
		$this->db->join('user', 'user.upa_id = upa.upa_id');
		$this->db->where('user.email', $this->session->userdata('email'));
		$data['anggota'] = $this->db->get()->row_array();

		$data['mutabaah'] = $this->db->get_where('mutabaah', ['mtb_id' => $id])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/detail-mutabaah', $data);
		$this->load->view('templates/footer');

	}

}
