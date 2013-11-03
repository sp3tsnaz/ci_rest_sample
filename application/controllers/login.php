<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
			$this->load->view('login');
		}
	}
	
	function checkLogin()
	{
		if ($_POST['usr'] && $_POST['pwd'])
		{
			$result = $this->db->query('SELECT user_password FROM user WHERE user_email='.'"'.$_POST['usr'].'"');
			//$r1 = $result->result();			
			if($result->num_rows() > 0)
			{
				$r1 = $result->row();
				if($r1->user_password == $_POST['pwd'])
				{
					$this->session->set_userdata('auth','1');
					$this->session->set_userdata('user',$_POST['usr']);
					$result2 = $this->db->query('SELECT user_id FROM user WHERE user_email='.'"'.$_POST['usr'].'"');
					if($result2->num_rows() > 0)
					{
						$r2 = $result2->row();
						$this->session->set_userdata('id',$r2->user_id);
					}
					else
					{
						redirect('/login/index');
					}
					
					//success .. redirect to person's profile page.					
					redirect('profile/index/'.$this->session->userdata('user'));
				}
				else 
				{
					redirect('/login/index');
				}
			}
			else
			{
				redirect('/login/index');
			}
		}
		else
		{
			redirect('/login/index');
		}		
	}
	
	function logOut()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */