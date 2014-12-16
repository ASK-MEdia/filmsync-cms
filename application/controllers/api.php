<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('m_api');
		$this->load->library('session');
	}

	public function index()
	{

	}

	public function validateapi($secretId='')
	{
		$isvalid = $this->m_api->validateApi($secretId);
		if($isvalid)
		{
			return true;
		}

		return false;
	}

	public function handshake($secretId = "")
	{
		$sessionId = $this->m_api->setHandshake($secretId);
		if(!$sessionId)
		{
			$returnarray['status'] = 'invalid';
			echo json_encode($returnarray);
		}
		echo $sessionId;
	}

	public function getallcards($projectid = "")
	{
		$cards = $this->m_api->getallCards($projectid);
		echo $cards;
	}

	public function preview($cardid='')
	{
		$data['carddetails'] = $this->m_api->getCarddetails($cardid);
		$this->m_api->trackCardview($cardid);
		$this->load->view('v_api_preview',$data);
	}

	public function getacard($cardid='',$sessionId="")
	{
		$isvalidsession = $this->validateapi($sessionId);
		if(!$isvalidsession)
		{
			$returnarray['session'] = 'expired';
			echo json_encode($returnarray);
			return;
		}
		$carddetails = $this->m_api->getAcard($cardid);
		echo $carddetails;
	}

	public function getcardsforproject($projectid='',$sessionId="")
	{
		$isvalidsession = $this->validateapi($sessionId);
		if(!$isvalidsession)
		{
			$returnarray['session'] = 'expired';
			echo json_encode($returnarray);
			return;
		}
		$cards = $this->m_api->getcardsforProject($projectid);
		echo $cards;
	}

}

