<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->database();
	}

	function index($name)
	{
		if(!$name) { redirect(base_url()); }
		else
		{
			$teamID;
			$data;
			$data['is_auth'] = $this->session->userdata('auth');
			$teamIDRaw = $this->db->query('SELECT user_id FROM user WHERE user_email="'.$name.'"');
			if($teamIDRaw->num_rows() > 0)
			{
				$teamIDRow = $teamIDRaw->row();
				$data['tid'] = $teamID = $teamIDRow->user_id;
			}
			else
			{
				redirect(base_url());
			}			
			$data['tname'] = $this->db->query('SELECT user_name FROM user WHERE user_id='.$teamID);
			//$data['tmem'] = $this->db->query('SELECT member_name FROM members WHERE team_id='.$teamID);
			//$data['pics'] = $this->db->query('SELECT screen_file_name FROM screens WHERE team_id='.$teamID);
			//$data['cmnts'] = $this->db->query('SELECT * FROM comments WHERE team_id='.$teamID);
			//$data['sub'] = $this->db->query('SELECT * FROM submission WHERE team_id='.$teamID);
			$data['events'] = $this->db->query('SELECT event_id,event_title FROM event WHERE user_id='.$teamID);
			
			$this->load->view('profile',$data);
		}
	}
	
	function upload($teamID)
	{
		if (($this->session->userdata('auth') == '1') && $teamID == $this->session->userdata('id'))
		{
			$data['is_auth'] = '1';
			$data['teamID'] = $teamID;
			$this->load->view('upload',$data);
		}
		else
		{
			redirect('login');
		}
	}
	
	function do_upload($teamID)
	{
		if( ($this->session->userdata('auth') == '1') && $teamID == $this->session->userdata('id') )
		{		
			$config['upload_path'] = './uploads/'; //path should be in ./ form only .. other types of paths are not recognized
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']	= '1024';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$error['teamID'] = $teamID;
				$this->load->view('upload', $error);
			}
			else
			{
				$result = $this->db->query('SELECT max(screen_id) as max FROM screens WHERE team_id='.$teamID);
				if ( $result->num_rows() > 0 )
				{
					$r1 = $result->row();
					//print_r($r1);
					$r2 = $r1->max + 1;
					$udata = $this->upload->data();
					$this->db->query('INSERT into screens (screen_id,screen_file_name,team_id) VALUES('.$r2.','.'"'.$udata['file_name'].'"'.','.$teamID.')');
					//now resizing the pics.
					$config['image_library'] = 'gd2';
					$config['source_image'] = './uploads/'.$udata['file_name'];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 75;
					$config['height'] = 57;

					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
				}
				
				$data = array('upload_data' => $this->upload->data());
				$data['tid'] = $teamID;
				$this->load->view('usuccess', $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	
	function gupload($teamID)
	{
		if (($this->session->userdata('auth') == '1') && $teamID == $this->session->userdata('id'))
		{
			$data['is_auth'] = '1';
			$data['teamID'] = $teamID;
			$this->load->view('gupload',$data);
		}
		else
		{
			redirect('login');
		}
	}
	
	function do_gupload($teamID)
	{
		if( ($this->session->userdata('auth') == '1') && $teamID == $this->session->userdata('id') )
		{
			$config['upload_path'] = './guploads/'; //path should be in ./ form only .. other types of paths are not recognized
			$config['allowed_types'] = 'zip|rar';
			$config['max_size']	= '100000';	//size around 100 MB max game upload size 	

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$error['teamID'] = $teamID;
				$this->load->view('gupload', $error);
			}
			else
			{			
				$udata = $this->upload->data();
				$result = $this->db->query('SELECT max(sub_id) as max FROM submission');
				if ( $result->num_rows() >0)
				{
					$mx = $result->row();
					$mx->max++;
				}
				$this->db->query('INSERT into submission (sub_id,team_id,sub_time,sub_file_name) VALUES('.$mx->max.','.$this->session->userdata('id').',NOW(),"'.$udata['file_name'].'")');	
				
				$data = array('upload_data' => $this->upload->data());
				$data['tid'] = $teamID;
				$this->load->view('gusuccess', $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	
	function comment()
	{
		if($this->session->userdata('auth') == '1')
		{
			$result = $this->db->query('SELECT max(c_id) as max FROM comments');
			if($result->num_rows() > 0)
			{
				$mx = $result->row();
				$mx->max++ ;
			}
			$this->db->query('INSERT into comments (c_id,team_id,c_text,c_time) VALUES ('.$mx->max.','.$this->session->userdata('id').',"'.$_POST['comment'].'",NOW())');
			redirect('login');
		}
	}

}

