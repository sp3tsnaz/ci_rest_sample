<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->database();
	}

	function index()
	{
		if($this->session->userdata('auth')=='1')
		{
			 //success page .. already logged in
			 redirect('profile/index/'.$this->session->userdata('user'));
		}
		else
		{
			$this->load->view('register');
		}
	}
	
	function sub()
	{
		if ($_POST['usr'] && $_POST['pwd'])
		{
			$result = $this->db->query('SELECT max(team_id) as max FROM team ');
				if ( $result->num_rows() > 0 )
				{
					$r1 = $result->row();
					//print_r($r1);
					$r1->max++;
					$this->db->query('INSERT INTO team (team_id,team_name,team_is_registered,team_user_ID,team_password) VALUES ('.$r1->max.',"'.$_POST['usr'].'",1,"'.$_POST['usr'].'","'.$_POST['pwd'].'")');
					redirect('login');
				}
			
		}
		redirect('register');
	}
}
	
	