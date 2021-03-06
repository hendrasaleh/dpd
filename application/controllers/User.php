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

		$this->form_validation->set_rules('qiyamullail', 'Qiyamullail', 'required|trim');
		$this->form_validation->set_rules('subuh_berjamaah', 'Shalat subuh berjamaah', 'required|trim');
		$this->form_validation->set_rules('tilawah_murojaah', 'Tilawah dan Murojaah', 'required|trim');
		$this->form_validation->set_rules('shalat_dhuha', 'Shalat Dhuha', 'required|trim');
		$this->form_validation->set_rules('dzuhur_berjamaah', 'Shalat Dzuhur berjamaah', 'required|trim');
		$this->form_validation->set_rules('ashar_berjamaah', 'Shalat Ashar berjamaah', 'required|trim');
		$this->form_validation->set_rules('maghrib_berjamaah', 'Shalat Maghrib berjamaah', 'required|trim');
		$this->form_validation->set_rules('isya_berjamaah', 'Shalat Isya berjamaah', 'required|trim');
		$this->form_validation->set_rules('baca_matsurat_1', 'Membaca Matsurot pagi', 'required|trim');
		$this->form_validation->set_rules('bantu_ortu', 'Membantu orang tua', 'required|trim');
		$this->form_validation->set_rules('belajar_daring', 'Mengikuti Pembelajaran Jarak Jauh', 'required|trim');
		$this->form_validation->set_rules('qoilulah', 'Qoilulah', 'required|trim');
		$this->form_validation->set_rules('liqo', 'Kegiatan Liqo', 'required|trim');
		$this->form_validation->set_rules('baca_matsurat_2', 'Membaca Matsurot petang', 'required|trim');
		$this->form_validation->set_rules('baca_buku', 'Murojaah dan membaca buku', 'required|trim');
		$this->form_validation->set_rules('tidur_jam_10', 'Tidur sebelum jam 22.00', 'required|trim');

		if( $this->form_validation->run() == false ) {
		
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('user/input-mutabaah', $data);
			$this->load->view('templates/footer');
		
		} elseif (date('Y-m-d', time()) == date('Y-m-d', $data['mutabaah']['tanggal'])) {
			$this->session->set_flashdata('message', '<div class="alert col-sm-6 alert-danger" role="alert"> Data hari ini sudah diinput.</div>');
			redirect('mutabaah');
		} else {
			
			$data = [
						'tanggal' => time(),
						'cbt_user_name' => $this->input->post('cbt_user_name'),
						'cbt_user_grup_id' => $this->input->post('cbt_user_grup_id'),
						'pondok_kamar_id' => $this->input->post('pondok_kamar_id'),
						'qiyamullail' => $this->input->post('qiyamullail'),
						'subuh_berjamaah' => $this->input->post('subuh_berjamaah'),
						'baca_matsurat_1' => $this->input->post('baca_matsurat_1'),
						'bantu_ortu' => $this->input->post('bantu_ortu'),
						'shalat_dhuha' => $this->input->post('shalat_dhuha'),
						'belajar_daring' => $this->input->post('belajar_daring'),
						'dzuhur_berjamaah' => $this->input->post('dzuhur_berjamaah'),
						'qoilulah' => $this->input->post('qoilulah'),
						'liqo' => $this->input->post('liqo'),
						'ashar_berjamaah' => $this->input->post('ashar_berjamaah'),
						'baca_matsurat_2' => $this->input->post('baca_matsurat_2'),
						'maghrib_berjamaah' => $this->input->post('maghrib_berjamaah'),
						'tilawah_murojaah' => $this->input->post('tilawah_murojaah'),
						'isya_berjamaah' => $this->input->post('isya_berjamaah'),
						'baca_buku' => $this->input->post('baca_buku'),
						'tidur_jam_10' => $this->input->post('tidur_jam_10'),
						'jumlah' => $this->input->post('qiyamullail')+$this->input->post('subuh_berjamaah')+$this->input->post('baca_matsurat_1')+$this->input->post('bantu_ortu')+$this->input->post('shalat_dhuha')+$this->input->post('belajar_daring')+$this->input->post('dzuhur_berjamaah')+$this->input->post('qoilulah')+$this->input->post('liqo')+$this->input->post('ashar_berjamaah')+$this->input->post('baca_matsurat_2')+$this->input->post('maghrib_berjamaah')+$this->input->post('tilawah_murojaah')+$this->input->post('isya_berjamaah')+$this->input->post('baca_buku')+$this->input->post('tidur_jam_10')
			];

			$this->db->insert('pondok_mutabaah', $data);
			$this->session->set_flashdata('message', '<div class="alert col-sm-6 alert-success" role="alert"> Data berhasil ditambahkan.</div>');
			redirect('mutabaah');
		}
	}

	public function detailMutabaah($id)
	{
		$data['title'] = 'Data Mutabaah';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->select('*');
		$this->db->from('pondok_asrama');
		$this->db->join('pondok_kamar', 'pondok_kamar.asrama_id = pondok_asrama.id');
		$this->db->join('cbt_user', 'cbt_user.pondok_kamar_id = pondok_kamar.id');
		$this->db->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id');
		$this->db->where('cbt_user.user_name', $this->session->userdata('email'));
		$data['santri'] = $this->db->get()->row_array();

		$data['mutabaah'] = $this->db->get_where('pondok_mutabaah', ['id' => $id])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('mutabaah/detail', $data);
		$this->load->view('templates/footer');

	}

}
