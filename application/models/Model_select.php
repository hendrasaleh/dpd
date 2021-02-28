<?php

Class Model_select extends CI_Model
{

	function __construct()
	{

		parent::__construct();

	}

	function provinsi()
	{
		$this->db->order_by('name','ASC');
		$provinces= $this->db->get('reg_provinces');

		return $provinces->result_array();
	}

	function kabupaten($provId)
	{

		$kabupaten="<option value='0'>--pilih--</pilih>";

		$this->db->order_by('name','ASC');
		$kab= $this->db->get_where('reg_regencies',array('province_id'=>$provId));

		foreach ($kab->result_array() as $data ){
			$kabupaten.= "<option value='$data[id]'>$data[name]</option>";
		}

		return $kabupaten;

	}

	function kecamatan($kabId)
	{
		$kecamatan="<option value='0'>--pilih--</pilih>";

		$this->db->order_by('name','ASC');
		$kec= $this->db->get_where('reg_districts',array('regency_id'=>$kabId));

		foreach ($kec->result_array() as $data ){
			$kecamatan.= "<option value='$data[id]'>$data[name]</option>";
		}

		return $kecamatan;
	}

	function kelurahan($kecId)
	{
		$kelurahan="<option value='0'>--pilih--</pilih>";

		$this->db->order_by('name','ASC');
		$kel= $this->db->get_where('reg_villages',array('district_id'=>$kecId));

		foreach ($kel->result_array() as $data ){
			$kelurahan.= "<option value='$data[id]'>$data[name]</option>";
		}

		return $kelurahan;
	}

}
