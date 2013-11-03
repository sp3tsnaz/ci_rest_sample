<?php defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH.'/libraries/REST_Controller.php';

class Profile extends REST_Controller
{
	function login_get()
	{
		if( (! $this->get('id')) || (!$this->get('pwd')) )
		{
			$this->response(array('error' => 'Username or password missing'), 404);
		}
		$this->load->database();
		$result = $this->db->query('SELECT user_password FROM user WHERE user_email="'.$this->get('id').'"');
		if ($result->num_rows() > 0)
		{
			$result = $result->row();
			if ( $result->user_password == $this->get('pwd') )
			{
				$response = 'success';
				$this->response($response,200);	
			}
			else
			{
				$response = 'failure';
				$this->response($response,200);	
			}
		}
		else
		{
			$this->response(array('error' => 'No such user. Please Register'),404);			
		}
	}
	
	function info_get()
	{
		if ( ! $this->get('id') )
		{
			$this->response(array('error' => 'Username missing'), 404);
		}
		$this->load->database();
		$result = $this->db->query('SELECT * FROM user WHERE user_email="'.$this->get('id').'"');
		if ( $result->num_rows() > 0 )
		{
			$result = $result->row();
			$this->response($result,200);
		}		
	}
}