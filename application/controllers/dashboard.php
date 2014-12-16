<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('myclass');
        $this->load->library('pagination');
        $this->load->library( 'email' );
        $this->load->library('form_validation');
        $this->load->model('M_Dashboard', '', TRUE);
        $this->load->model('M_Tweets', '', TRUE);
        $this->load->model('M_Login', '', TRUE);
      
    }
    
    public function index()
    {

        if ($this->myclass->logged_in)
        {
            $data = array();
            $data['title'] = 'Dash Board';
            $data['header'] = $this->load->view('includes/v_header',$data, true);
            $data['sidebar'] = $this->load->view('includes/v_leftsidemenu',$data, true);
            $data['footer'] = $this->load->view('includes/v_footer',$data, true);
            $details = $this->session->userdata('user_data');
            $userid=$details['id'];
            $data['projects']= $this->M_Dashboard->get_latest_projects($userid);
            $search_item=NULL;
            $data['projects_count'] = $this->M_Dashboard->count_all_user_projects($search_item,$userid);
            $data['cards_count'] = $this->M_Dashboard->count_all_cards($userid);
            $data['cards_viewed'] = $this->M_Dashboard->countCardViews($userid);
            $data['tweets'] =$this->M_Tweets->get_tweets($userid);
            

            $this->load->view('v_dashboard',$data);
        }
        else
        {
            redirect('login');
        }
    }
       


  public function allprojects($projects=0,$cards=0,$search_item=0,$page = 0) 
    {
       
        if ($this->myclass->logged_in)
        {  
            
        $details = $this->session->userdata('user_data');
        $userid=$details['id'];
        $data = array();
        $count=count($this->uri->segment_array());
        if(isset($_POST['keyword']))
        {
            $search_item=$_POST['keyword'];
        }
        
        else
        {
            if($count==6)
            {
                $secondLastKey = count($this->uri->segment_array())-1;
                $search_item=$this->uri->segment($secondLastKey);
                $search_item= urldecode ( $search_item );
                $page_1=$this->uri->segment($count);
                if(is_numeric($page))
                {
                    $page=$this->uri->segment($count);
                }
             else {
                   redirect('dashboard/allprojects'); 
                }
                $projects=0;
                $cards=0;
            } 
            else
            {
                $search_item= urldecode ( $search_item );
                $projects=0;
                $cards=0;
            }
        }  
       
        $data['projects']= $this->M_Dashboard->get_all_projects(8, $page,$search_item,$userid);
        $this->load->library('pagination');

           $config['total_rows'] = $this->M_Dashboard->count_all_user_projects($search_item,$userid);
            if($search_item=='')
            {
                $search_item=0;
            }
            
        if($search_item=='')
        {
        $config['base_url'] = base_url() . '/dashboard/allprojects/'.$projects.'/'.$cards.'/';
        }
        else
        {     
              
        $config['base_url'] = base_url() . '/dashboard/allprojects/'.$projects.'/'.$cards.'/'. urlencode($search_item).'/';
        }
        $config['per_page'] = 8;
        if($count==6)
        {
            $config['uri_segment'] = 6;
        }

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);
        $data['page'] = $page;

        $output='';
	if(isset($_POST['keyword']))
            {
                $search_item=$_POST['keyword'];
                $page_links = $this->pagination->create_links($config);
                if(count($data['projects']) < 1)
                {
                 $output.= '<span>No Result</span>';
                }
                else
                {
                   $output.= '<div class="row">';
                   foreach ($data['projects'] as $latest_projects)
                   {
                                              
                    $output.='<div class="col-lg-3 col-md-3 col-sm-4 prj-items">
                             <div class="text-center"><span class="latest-projects-list-image"><a href="'. base_url()."projects/index/".$latest_projects->id.'">
                             <img class="profile-img" width="200" height="150" src="'.base_url()."images/thumbnail/".$latest_projects->image_name.'" alt="">
                            </a>
                            <span class="badge bg-blue latest-projects-list-badge">'. $latest_projects->card_count.'</span>
                            <span class="latest-projects-list-title">'. $latest_projects->title.'</span>
                            </div>
                            </div>';
                   }    
                   if($page_links != '')
                   {
                        $output.='<div class="col-lg-12">
                                  <div class="col">'.$page_links.'</div></div>';
                    }
                }
                echo $output;
            }
        else
        {    
            if (empty($search_item))
            {
                $data['search_item']='';
            }
            else 
            {
                $data['search_item']=$search_item;
            }
           
            $data['title'] = 'Dash Board';
            $data['header'] = $this->load->view('includes/v_header',$data, true);
            $data['sidebar'] = $this->load->view('includes/v_leftsidemenu',$data, true);
            $data['footer'] = $this->load->view('includes/v_footer',$data, true);
            $this->load->view('v_dashboard_detail',$data);
        }
       }
        else
        {
            redirect('login');
        }
    }
    
    public function accountsettings()
    {
        
         if ($this->myclass->logged_in)
        {
            $data = array();
            $data['title'] = 'Account Settings';
            $data['header'] = $this->load->view('includes/v_header',$data, true);
            $data['sidebar'] = $this->load->view('includes/v_leftsidemenu',$data, true);
            $data['footer'] = $this->load->view('includes/v_footer',$data, true);
            $details = $this->session->userdata('user_data');
            
            $userid=$details['id'];
            $email=$details['email'];
            
            $data['userdetails']= $this->M_Dashboard->get_userdetails($userid);
                      
                       
             if($this->input->post('submit'))
              {  
                 
                 $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback_username_check');
           
           

            $data['userdetails'][0]->username      = $this->input->post('username');
            $data['userdetails'][0]->organization  = $this->input->post('organization');
            if ($this->form_validation->run() == FALSE) {
                 $this->load->view('v_account_settings', $data);
                return false;
            } else{
                    if(!empty($_FILES['profile_pic']['name']))
                    {
                        $curtime=time();
                        
                        $config['upload_path']   = BASE_PATH.'images/profilepic/';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['file_name']     =  'profile_'.$userid.'_'.$curtime.'_'.$_FILES['profile_pic']['name'];
                        $config['max_size']	 = '10000';
                        $config['max_width']     = '1400';
                        $config['max_height']    = '1400';
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('profile_pic'))
		         {
                             $data['messages']=  $this->upload->display_errors(); 
                        }
                        else 
                        {                          
                            $profile_pic=$config['file_name'];
                        
                        }
                        
                    }
                     else {
                         
                         $profile_pic=$data['userdetails'][0]->profile_pic;
                     }
                    $datas = array(                            
                             'username'    =>$this->input->post('username'),
                             'organization'=>$this->input->post('organization'),
                             'profile_pic'=>$profile_pic,
                             'userid'     =>$userid
                            );
                             
                    
                            
                            $array_items = array('user_data' => '');
                            $this->session->unset_userdata($array_items);
                            
                       $user_data=array("user_data"=>array(
                      'id'          => $userid,
                      'username'    => $this->input->post('username'),
                      'email'       => $email,
                      'profile_pic' => $profile_pic,
                      'status'      => 1
                      ));

                    $detailss= $this->session->set_userdata($user_data);
                            //$detailss = $this->session->userdata('user_data');
                           
                            
                         $result =$this->M_Dashboard->update_profile_data($datas);
                         redirect('dashboard/accountsettings');
                    
                     }
                  }
                  
                  
            $this->load->view('v_account_settings',$data);
        }
        else
        {
            redirect('login');
        }
    }
    
    
 function username_check($username)
    {
        $details = $this->session->userdata('user_data');
            
        $userid=$details['id'];
        $count_val=$this->M_Dashboard->check_username_in_db($username,$userid);
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


    
    
}
