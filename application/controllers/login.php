<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(BASE_PATH."/assets/composer/mailgun.php");

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form'));
        $this->load->library('session');
        $this->load->library('myclass');
        //$this->load->library('MY_Usession');
        $this->load->library( 'email' );
        $this->load->library('form_validation');
        $this->load->model('M_Login', '', TRUE);
        $this->mailgun = new mailgunclass;
       
    }

     public function __call($method, $args='')
      {
        $this->mailgun->$method($args);
      }


	public function index()
	{
           //$loggedin= $this->MY_Usersession->logged_in();
          /// print_r($loggedin);
             //if ($this->my_usession->logged_in)
             if ($this->myclass->logged_in)
                {
                redirect('dashboard');
                }
                else{
            $this->load->view('v_login');
                }
	}
        public function authenticate()
        {
             $data = array();
            $data['title'] = 'Login Form';
            $data['header'] = $this->load->view('includes/v_header',$data, true);
            $data['footer'] = $this->load->view('includes/v_footer',$data, true);
		
             if ($this->input->post('submit')) 
             {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
              if ($this->form_validation->run() == FALSE) {
                $this->load->view('v_login',$data);
                return false;
                   } 
             else {
                       
                    $userdetails=$this->M_Login->fetch_password($this->input->post('username'));
                    
                    //if(empty($userdetails)){echo "ff";exit;}
                    if(!empty($userdetails)){

                    $pasword_indb=$userdetails[0]->password; 
                    $result= $this->check_password($pasword_indb,$this->input->post('password'));
                    
                    if($result!=1){
                        //print_r($this->session);
                        //$this->session->sess_create();
                       
                    $this->session->set_flashdata('error', 'Authentication Failed,No such password');
                     redirect('login');
                     }
                    else {
                        
                        
                   $user_data=array("user_data"=>array(
                'id'          => $userdetails[0]->id,
                'username'    => $userdetails[0]->username,
                'email'       => $userdetails[0]->email,
                'profile_pic' => $userdetails[0]->profile_pic,
                'status'      => $userdetails[0]->status
                ));

                  $session_details=   $this->session->set_userdata($user_data);
                  
                 
                
                // $details = $this->session->userdata('user_data');
      
                   //   print_r($details);exit;  
                        redirect('dashboard');
                       }
                    }
                    else {
                       
                    $this->session->set_flashdata('error', 'Authentication Failed,No such username');
                    redirect('login');
                    }
                 }
             }

        }
        
        function check_password($hash, $password) 
        {

            // first 29 characters include algorithm, cost and salt
            // let's call it $full_salt
            $full_salt = substr($hash, 0, 29);

            // run the hash function on $password
            $new_hash = crypt($password, $full_salt);

            // returns true or false
            return ($hash == $new_hash);
        }
        public function registration()
        {
                
            if ($this->myclass->logged_in)
                {
                redirect('dashboard');
                }
             else{
             if ($this->input->post('submit')) {


            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback_username_check');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');
            $this->form_validation->set_rules('organization', 'Organization', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[cpassword]');
            $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|xss_clean');


            $data['username']         = $this->input->post('username');
            $data['email']            = $this->input->post('email');
            $data['organization']     = $this->input->post('organization');
            $data['password']         = $this->input->post('password');
            
            
           
            if ($this->form_validation->run() == FALSE) {
                
                $this->load->view('v_registration',$data);
                return false;
            } else {
                
            $accestoken = md5(microtime().rand());
            $hash_password=$this->myhash($this->input->post('password'));
                
                $datas = array(
                    
                    'username'       => $this->input->post('username'),
                    'email'          => $this->input->post('email'),
                    'organization'   => $this->input->post('organization'),
                    'password'       => $hash_password,
                    'acces_token'    => $accestoken,
                    'status'         => 0
                );
                
           $inserid=  $this->M_Login->save_userdetails($datas);
             

        /*    $data_message='
            Dear '.$this->input->post('username').'
           
            Your Registration in FilmSync is successfully completeted,Please activate your account using the following link'.
           base_url().'login/activation_check/'.$inserid.'/'.$accestoken.'" 
          
            Thank You';
*/
            $message1 = 'Before you go out and play on FilmSync, please verify your email address.';
            $message2 = "<a href='".base_url()."login/activation_check/".$inserid."/".$accestoken."'>Click Here</a> to verify";

           /* $data=  base_url().'login/activation_check/'.$inserid.'/'.$accestoken;     
            $this->email->from( 'sender@gmail.com', 'Admin' );
            $this->email->to( $this->input->post('email'));
            $this->email->subject( 'Activation Link' );
            $this->email->message($data_message);
            //$this->email->message( $this->load->view( 'emails/message', $data, true ) );
            //$this->email->send();*/

            $this->sendMail($this->input->post('username'),$this->input->post('email'), 'Activation Link', $message1,$message2);
              
            $this->session->set_flashdata('message', 'Registration completed,Please check the verification link in your mail');
            redirect('login/registration');
            }
        }
        
        $this->load->view('v_registration');
        
        } 
    }  
    
    
    
    function forgotpassword()
    {
        
         if ($this->myclass->logged_in)
                {
                redirect('dashboard');
                }
             else{
        if ($this->input->post('submit'))
        {

            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_check_email_in_db');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[cpassword]');
            $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|xss_clean');

            $data['email']            = $this->input->post('email');
            $data['password']         = $this->input->post('password');
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('v_forgot_password',$data);
                return false;
            } 
            else
            {
                $userdetails=$this->M_Login->fetch_userdetails_from_email($this->input->post('email'));
                if(!empty($userdetails))
                {
                    $user_id=$userdetails[0]->id; 
                    $hash_password=$this->myhash($this->input->post('password'));
                    $datas = array(
                    'id'             => $user_id,
                    'password'       => $hash_password
                    );
                    $userid=  $this->M_Login->update_password($datas);
                    $this->session->set_flashdata('message', 'Password Updated');
                    redirect('dashboard');
                }
                else
                {
                    $this->session->set_flashdata('error', 'No such email in data base');
                    redirect('login/forgotpassword'); 
                }
            }
        }
         $this->load->view('v_forgot_password');
      }
    }
    
    function myhash($password)
    {
        $unique_salt=substr(sha1(mt_rand()),0,22);
        $hashval= crypt($password, '$2a$10$'.$unique_salt);
        return $hashval;
    }
    
    
    
    function activation_check($userid,$accestoken)
    {       
       $user_details=  $this->M_Login->validate_accesstoken($accestoken,$userid);
       if(!empty($user_details))
       {
            if($user_details[0]->status==0)
            {
                $random_app_key=$this->randomPassword();
                $updated_details=  $this->M_Login->update_accesstoken($user_details[0]->id,$random_app_key);
                if($updated_details!='')
                {
                    
                    $user_data=array("user_data"=>array(
                      'id'          => $user_details[0]->id,
                      'username'    => $user_details[0]->username,
                      'email'       => $user_details[0]->email,
                      'profile_pic' => $userdetails[0]->profile_pic,
                      'status'      => $user_details[0]->status
                      ));

                    $id=   $this->session->set_userdata($user_data);

                    redirect('dashboard');  

                       //$details = $this->session->userdata('user_data');print_r($details);
                } 
                
            }  
            
            
        }
        else{
            echo "invalid accestoken";exit;
        }
        
    }
    
    function logout() 
    {
        $array_items = array('user_data' => '');
        $this->session->unset_userdata($array_items);
        //force expire the cookie
       // $this->generateCookie('[]', time() - 3600);
        redirect('home');
    }

    
    function username_check($username)
    {
        $count_val=$this->M_Login->check_value_in_db('username',$username);
             
        if($count_val!=0)
        {
            $this->form_validation->set_message('username_check', 'Username exists');
            return false;
        }
        else 
        { 
            return true;
           
        }
    }
    function email_check($email)
    {
        $count_val=$this->M_Login->check_value_in_db('email',$email);
        if($count_val!=0)
        {
            $this->form_validation->set_message('email_check', 'Email exists');
            return false;
        }
        else 
        { 
            return true;
            
        }
    }
    function check_email_in_db($email)
    {
        $count_val=$this->M_Login->user_check_with_email($email);
        if($count_val==0)
        {
            $this->form_validation->set_message('check_email_in_db', 'Email doesnot exists');
            return false;
        }
        else 
        { 
            return true;
            
        }
    }
    
    function randomPassword() 
    {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 18; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
    }
    
}
