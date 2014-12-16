<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form'));
        $this->load->library('session');
        $this->load->library('myclass');
        $this->load->library('pagination');
        $this->load->library( 'email' );
        $this->load->library('form_validation');
        $this->load->model('M_Search', '', TRUE);
      
    }
    
    public function index($projects=0,$cards=0,$search_item=NULL,$page = 0) 
    {

        if ($this->myclass->logged_in)
        {   
            
        $details = $this->session->userdata('user_data');
        $userid=$details['id'];
        $data = array();
        $count=count($this->uri->segment_array());
        
       
        if(isset($_GET['main_search']))
        {
            $search_item=$_GET['main_search'];
        }
        elseif(isset($_POST['sub_search']))
        {
            $search_item=$_POST['sub_search'];
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
                   redirect('dashboard'); 
                }
            } 
            else
            {
                $search_item= urldecode ( $search_item );
            }
            
        }  
        
        
        if(isset($_POST['projects']))
        {
            $projects = $_POST['projects'];
        }
        if(isset($_POST['cards']))
        {
            $cards= $_POST['cards'];
        }
        
        $data['search_result']= $this->M_Search->getAllProjectsAndCards(4,$page,$projects,$cards,$search_item,$userid);
        $this->load->library('pagination');
        $config['total_rows'] = $this->M_Search->count_all_search_result($projects,$cards,$search_item,$userid);
        if($search_item=='')
        {
        $config['base_url'] = base_url() . '/search/index/'.$projects.'/'.$cards.'/';
        }
        else
        {     
        $config['base_url'] = base_url() . '/search/index/'.$projects.'/'.$cards.'/'.urlencode($search_item).'/';
        }
        $config['per_page'] = 4;
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
       if(isset($_POST['sub_search']))
        {
           $search_item=$_POST['sub_search'];
           $page_links = $this->pagination->create_links($config);
           $output.= '<table class="table table-hover">';
           if(count($data['search_result']) < 1)
           {
            $output.= '<tr><td style="text-align:center;" colspan="2">No Results</td></tr>';
           }
           else
           {

              $i=1;
              foreach ($data['search_result'] as $search_result)
              {
                   if(isset($search_result->protitle)){
                   if($search_result->protitle!='')
                   {
                       $title=$search_result->protitle;
                       $id=$search_result->proId;
                       $card_id='';
                       $type="project";
                       $class="project-icon";
                   }
                   }
                   if(isset($search_result->cardtitle)){
                   if($search_result->cardtitle!='')
                   {
                        $title= $search_result->cardtitle;
                        $id=$search_result->proId;
                        $card_id=$search_result->cardId;
                        $type="card";
                        $class="card-icon";
                   }
                   }
                   $output.='<tr><td class="number text-center">'.$i++.'</td><td class="product"><strong><a  href="'.base_url()."projects/index/".$id.'/'.$card_id.'" >'. $title.'</a><br> </br></td><td class="text-right"><span class="'.$class.'">'.$type.'</span></td></tr>';                 


              }    
              if($page_links != '')
              {
                   $output.='<tr><td style="text-align:center;"colspan="3">'.$page_links.'</td></tr>';

               }
           }
           $output.= '</table>';
           echo $output;
        }
        else
        {       
            $data['projects_checkbox']=$projects;
            $data['cards_checkbox']=$cards;

            $data['main_search']=$search_item;
            $data['sub_search']=$search_item;

            $data['title'] = 'Search Result';
            $data['header'] = $this->load->view('includes/v_header',$data, true);
            $data['sidebar'] = $this->load->view('includes/v_leftsidemenu',$data, true);
            $data['footer'] = $this->load->view('includes/v_footer',$data, true);
            $this->load->view('v_search_result',$data);
        }

 
       }
        else
        {
            redirect('login');
        }
    }
    
  
   
}
