<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model
{
	public function __construct()
    {

    }

	public function get_employees()
	{
		$query = $this->db->get('employees');
		return $query->result();
	}

	public function store_employee($data)
	{
		$this->db->insert('employees', $data);
		return $this->db->affected_rows();
	}

	public function show_employee($id)
	{
		$this->db->where('id', $id);
		$this->db->select()->from('employees');
		$query = $this->db->get();
		return $query->result();
	}
}