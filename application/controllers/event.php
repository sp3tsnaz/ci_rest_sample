<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->database();
	}

	function index($name)
	{
		if(!$name) { redirect('/event/allevents'); }
		else
		{
			$data['event'] = $this->db->query('SELECT * from event WHERE event_id='.$name);
			$data['uname'] = $this->db->query('SELECT user_name FROM user WHERE user_id ='.$this->session->userdata('id'));
			$data['id'] = $this->session->userdata('id');
			$this->load->view('event',$data);
		}
	}
	
	function do_upload($id,$eid)
	{
		if( ($this->session->userdata('auth') == '1') && $id == $this->session->userdata('id') )
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
				$error['id'] = $id;
				$this->load->view('upload', $error);
			}
			else
			{
				/*$result = $this->db->query('SELECT max(screen_id) as max FROM screens WHERE team_id='.$teamID);
				if ( $result->num_rows() > 0 )
				{
					$r1 = $result->row();
					//print_r($r1);
					$r2 = $r1->max + 1;*/
					$udata = $this->upload->data();
					$this->db->query('INSERT into pic (event_id,pic_a_name,pic_rating) VALUES('.$eid.',\''.$udata['file_name'].'\','.'0)');
					//now resizing the pics.
					/*$config['image_library'] = 'gd2';
					$config['source_image'] = './uploads/'.$udata['file_name'];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 75;
					$config['height'] = 57;

					$this->load->library('image_lib', $config);
					$this->image_lib->resize();*/
				//}
				
				//$data = array('upload_data' => $this->upload->data());
				//$data['tid'] = $teamID;
				//$this->load->view('usuccess', $data);
				redirect('event/index/'.$eid);
			}
		}
		else
		{
			redirect('login');
		}
	}
	
	function allevents()
	{
		$data['event'] = $this->db->query('SELECT event_id,event_title from event');
		$data['id'] = $this->session->userdata('id');
		$this->load->view('allevents',$data);		
	}
	
	function create()
	{
		if($this->session->userdata('auth') == '1')
		{
			$this->load->view('create');
		}
	}
	
	function doCreate()
	{
		if($this->session->userdata('auth') == '1')
		{
			$this->db->query('INSERT into event (user_id,event_title,event_location,event_hype,event_date,event_start_time,event_end_time) VALUES('.$this->session->userdata('id').',"'.$_POST['title'].'","'.$_POST['location'].'",123,"'.$_POST['date'].'","'.$_POST['start'].'","'.$_POST['end'].'")');
			
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

