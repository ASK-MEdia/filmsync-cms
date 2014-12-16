<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class myclass  
{
    public $CI;
    public $logged_in = FALSE;
    public function  __construct() {
      
       $this->CI = & get_instance();

       $this->is_logged_in();
    }
    public function is_logged_in()
    {
       $logged =$this->CI->session->userdata('user_data');
       $this->logged_in = ($logged) ? TRUE : FALSE;
    }
}
?>