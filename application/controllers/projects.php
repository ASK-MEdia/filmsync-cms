<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_projects');
		$this->load->library('session');
        $this->load->library('myclass');

        if (!$this->myclass->logged_in)
        {
        	redirect('login');
        }

	}

	/*public function index()
	{       
		//echo 'hello';exit;
		$data = array();
		$data['title'] = 'Add Project';
		$data['header'] = $this->load->view('includes/v_header',$data, true);
		$data['footer'] = $this->load->view('includes/v_footer',$data, true);
		$this->load->view('v_projects',$data);
	}
	*/

	public function index($pid="")
	{
		$data = array();
		$data['title'] = 'Add Project';
		$data['header'] = $this->load->view('includes/v_header',$data, true);
		$data['footer'] = $this->load->view('includes/v_footer',$data, true);
		$data['sidemenu'] = $this->load->view('includes/v_leftsidemenu',$data, true);
		$data['projectid'] = "";
		if($pid)
		{
			$projectDetails = $this->m_projects->getProjectdetails($pid);
            if(empty($projectDetails))
            {
                redirect('projects');
            }
			$data['projecttitle'] = $projectDetails->title;
			$data['description'] = $projectDetails->description;
			$data['url'] = $projectDetails->url;
			$data['projectid'] = $pid;
			$data['hashtag'] = $projectDetails->hashtag;
			$data['cards'] = $this->m_projects->getAllcards($pid);
		}
                
		$this->load->view('v_addproject',$data);
	}

	public function saveproject($projectid='')
	{
		if($projectid)
		{
            $projectDetails = $this->m_projects->getProjectdetails($projectid);
            $data['image_name'] = $projectDetails->image_name;
            $projectid = $this->m_projects->updateProjects($projectid);
            $path=BASE_PATH.'images/thumbnail/'.$data['image_name'];
            if(file_exists($path)) {
                unlink($path);
            }                        
		}
		else
		{
			$projectid = $this->m_projects->saveProjects();
		}
                
		
		redirect(site_url('projects/index/'.$projectid), 'refresh');
	}

	public function testtheme()
	{
		$data = array();
		$data['title'] = 'Add Project';
		$data['header'] = $this->load->view('includes/v_header',$data, true);
		$data['footer'] = $this->load->view('includes/v_footer',$data, true);
		$data['sidemenu'] = $this->load->view('includes/v_leftsidemenu',$data, true);
		//echo $data['sidemenu'];
		$this->load->view('v_test',$data);
	}

	public function addcards()
	{
		$cardId=$this->m_projects->saveCard();
		if($cardId)
		{
			$this->m_projects->generateMarker($cardId);
			echo $cardId;
		}
		else
		{
			echo 'exists';
		}
		
		
	}

	public function getallcards()
	{
		$pid = $this->input->post('projectid');
		$cards = $this->m_projects->getAllcards($pid);
		$items = "";
		foreach ($cards as $key => $value) {
			$items .= '<tr><td><a href="javascript:void(0);" class="md-trigger" data-modal="modal-2" onclick="editCard('.$value->id.')">'.$value->cardtitle.'</a></td><td>'.$value->time.'</td><td><a href="javascript:void(0);" onclick="preview('.$value->id.')"><i class="fa fa-external-link"></i></a><a href="javascript:void(0);" class="md-trigger" data-modal="modal-4" onclick="bindDelete('.$value->id.')"><i class="fa fa-trash-o"></i></a></td></tr>';
		}
		echo $items;
		//print_r($cards);
	}

	public function downloadmarker($projectname="",$cardname="",$time="",$filename="")
	{

		$result = $this->m_projects->downloadMarker($filename,$projectname,$cardname,$time);
		if($result == 'failed')
		{

		}
	}

    public function downloadcards($projectid,$projecttitle)
	{
            if($projectid!='')

            {
                $t=$this->m_projects->downloadcards($projectid,$projecttitle);
            }
            else {
                redirect('');
            }
	}

	public function deleteproject()
	{
		$projectid = $this->input->post('projectid');
		$this->m_projects->deleteProject($projectid);
	}

	public function getcarddetails()
	{
		$cardid = $this->input->post('cardid');
		$details = $this->m_projects->getCarddetails($cardid);
		echo json_encode($details);
	}

	public function updatecards()
	{
		$cardid = $this->input->post('cardid');
		$cardtitle = $this->input->post('cardtitle');
		$stime = $this->input->post('stime');
		$content = $this->input->post('content');
		$this->m_projects->updateCard($cardid,$cardtitle,$stime,$content);
	}

	public function preview($cardid='')
	{
		$data['carddetails'] = $this->m_projects->getCarddetails($cardid);
		$this->load->view('v_preview',$data);
	}

	public function iphonepreview($cardid='')
	{
		$data['carddetails'] = $this->m_projects->getCarddetails($cardid);
		$data['cardid'] = $cardid;
		$this->load->view('v_ipadpreview',$data);
	}

	public function deletecard()
	{
		$cardid = $this->input->post('cardid');
		$this->m_projects->deleteCard($cardid);
	}

	public function savepreviewdata()
	{
		$content = rawurldecode($this->input->post('content'));

		$this->session->set_userdata('previewContent', $content);
		echo $this->session->userdata('previewContent');
		//echo $content;
	}

	public function livepreview()
	{
		//echo $this->session->userdata('previewContent');
		$this->load->view('v_live_preview');
	}

	public function isfileexists()
	{
		$filename = $this->input->post('filename');
		if(!file_exists(BASE_PATH.'soundfiles/output/'.$filename.'.wav'))
		{
			echo "failed";
		}

	}


}

