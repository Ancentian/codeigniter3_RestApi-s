<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class ApiEmployeeController extends RestController
{
	public function __construct() {
		parent:: __construct();
		$this->load->model('Employee_model');
	}

	public function index_get()
	{
			//echo "I am An Employee";
		$employees = new Employee_model();

		$result_emp = $employees->get_employees();

		$this->response($result_emp, 200);
	}

	public function storeEmployee_post()
	{
		$employee = new Employee_model();
		$data = [
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone')
		];

		$result = $employee->store_employee($data);

			//$this->response($result, 200);
		if ($result > 0) {
			$this->response([
				'status' => 1,
				'message' => 'Employee Created Successfully'
			], RestController::HTTP_OK);
		}else{
			$this->response([
				'status' => 0,
				'message' => 'Failed!! Try Again.'
			], RestController::HTTP_BAD_REQUEST);
		}
	}

	public function showEmployee_get($id)
	{
		$employee = new Employee_model();

		$result = $employee->show_employee($id);

			//$this->response($result, 200);

		if($result){
			$this->response([
				'status' => 1,
				'message' => $result,
			], RestController::HTTP_OK);
		}else{
			$this->response([
				'status' => 0,
				'message' => $id. 'Not Found'
			], RestController::HTTP_BAD_REQUEST);
		}
	}

	public function updateEmployee_put($id)
	{
		$employee = new Employee_model;
		$data = [
			'first_name' => $this->put('first_name'),
			'last_name' => $this->put('last_name'),
			'email' => $this->put('email'),
			'phone' => $this->put('phone')
		];
		$result = $employee->update_employee($id, $data);
		if($result > 0)
		{
			$this->response([
				'status' => true,
				'message' => 'EMPLOYEE UPDATED'
			], RestController::HTTP_OK); 
		}
		else
		{
			$this->response([
				'status' => false,
				'message' => 'FAILED TO UPDATE EMPLOYEE'
			], RestController::HTTP_BAD_REQUEST);
		}
	}

	public function deleteEmployee_delete($id)
	{
		$employee = new Employee_model;
		$result = $employee->delete_employee($id);
		if($result > 0)
		{
			$this->response([
				'status' => true,
				'message' => 'EMPLOYEE DELETED'
			], RestController::HTTP_OK); 
		}
		else
		{
			$this->response([
				'status' => false,
				'message' => 'FAILED TO DELETE EMPLOYEE'
			], RestController::HTTP_BAD_REQUEST);
		}
	}
}

?>