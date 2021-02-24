<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Admin Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function role()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();

		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer');
		} else {
			$this->db->insert('user_role', ['role' => $this->input->post('role')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> New role added!</div>');
			redirect('admin/role');
		}
	}

	public function editrole($id)
	{
		$data['title'] = 'Edit Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('user_role',['id' => $id])->row_array();

		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('admin/editrole', $data);
			$this->load->view('templates/footer');
		} 
		else {
			$role = $this->input->post('role');

			$this->db->where('id', $id);
			$this->db->update('user_role', ['role' => $role]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Role edited!</div>');
			redirect('admin/role');
		}
	}

	public function deleterole($id)
	{
		
		$this->db->delete('user_role', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Role deleted!</div>');
		redirect('admin/role');
	}

	public function roleAccess($role_id)
	{
		$data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
	}

	public function users()
	{
		$data['title'] = 'User Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->select('*');
		$this->db->from('user_role');
		$this->db->join('user', 'user_role.id = user.role_id');
		$this->db->order_by('user_role.id', 'ASC');
		$this->db->order_by('user.name', 'ASC');
		$data['users'] = $this->db->get()->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('templates/footer');
		
	}

	public function manageuser($id)
	{
		$data['title'] = 'Manage User';
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_role', 'user_role.id = user.role_id');
		$this->db->where('user.id', $id);
		$this->db->order_by('user_role.id', 'ASC');
		$data['user'] = $this->db->get()->row_array();
		

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('role_id', 'Role', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('admin/manage-user', $data);
			$this->load->view('templates/footer');
		} else {
			$email = $this->input->post('email');
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'role_id' => $this->input->post('role_id'),
				'is_active' => $this->input->post('is_active'),
				'date_modified' => time()
			];

			$this->db->where('email', $email);
			$this->db->update('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> User edited!</div>');
			redirect('admin/users');
		}

	}

	public function deleteuser($id)
	{
		
		$this->db->delete('user', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> User deleted!</div>');
		redirect('admin/users');
	}
}