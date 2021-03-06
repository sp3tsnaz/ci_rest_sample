<?php defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH.'/libraries/REST_Controller.php';

class Eventinfo extends REST_Controller
{
	function eventall_get()  
    {
		$this->load->database();
		$result = $this->db->query('SELECT * FROM event');
		$result = $result->result();
		
		if ($result)
		{
			$this->response($result,200);
		}
		else
		{
			$this->response(NULL,404);
		}
	}
	
	function eventsearch_get()  
    {
		if(!$this->get('id'))
        {
        	$this->response(array('error' => 'Search Term not provided or Erroneous'), 404);
        }
		$this->load->database();
		$result = $this->db->query('SELECT * FROM event WHERE event_location Like \'%'.$this->get('id').'%\'');
		if ($result->num_rows() == 0)
		{
			$this->response(array('error' => 'No events found'), 200);
		}
		$result = $result->result();
		
		if ($result)
		{
			$this->response($result,200);
		}
		else
		{
			$this->response(NULL,404);
		}
	}
	
	function eventpics_get()
	{
		if ( ! $this->get('id') )
		{
			$this->response(array('error' => 'Pleae provide an event id'), 404);
		}
		else 
		{
			$this->load->database();
			$result = $this->db->query('SELECT pic_a_name as picname FROM pic WHERE event_id ='.$this->get('id'));
			if ($result->num_rows() == 0)
			{
				$this->response(array('error' => 'No pictures found for the event'), 200);
			}
			$result = $result->result();
		
			if ($result)
			{
				$this->response($result,200);
			}
			else
			{
				$this->response(NULL,404);
			}
		}
	}
	
	function eventvideos_get()
	{
		if ( ! $this->get('id') )
		{
			$this->response(array('error' => 'Pleae provide an event id'), 404);
		}
		else 
		{
			$this->load->database();
			$result = $this->db->query('SELECT video_a_name as videoname FROM video WHERE event_id ='.$this->get('id'));
			if ($result->num_rows() == 0)
			{
				$this->response(array('error' => 'No videos found for the event'), 200);
			}
			$result = $result->result();
		
			if ($result)
			{
				$this->response($result,200);
			}
			else
			{
				$this->response(NULL,404);
			}
		}
	}
	
}