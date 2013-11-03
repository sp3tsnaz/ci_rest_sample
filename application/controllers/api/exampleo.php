<?php defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH.'/libraries/REST_Controller.php';

class Exampleo extends REST_Controller
{
	function mos_get()  
    {  
         $mos = array( 'id'=>1 , 'name'=>'mos');//$this->user_model->get_all();  
   
         if($mos)  
         {  
             $this->response($mos, 200);  
         }  
   
         else  
         {  
             $this->response(NULL, 404);  
         }  
    }  
	
	/*function nos_get()  
    {  
         $nos = 1;//$this->user_model->get_all();  
   
         if($nos)  
         {  
             $this->response($nos, 200);  
         }  
   
         else  
         {  
             $this->response(NULL, 404);  
         }  
    }  */
	
	function nos_get()  
    {
		$this->load->database();
		$result = $this->db->query('SELECT * FROM USER');
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