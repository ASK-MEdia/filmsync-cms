<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Nidhin N
 * Description: Api model class
 */
class M_Api extends CI_Model{
		
		public function getallCards($projectid='')
		{
			$subquery = "";
			$newresult= array();
			if($projectid)
			{
				$subquery = " where projectid = '".$projectid."' ";
			}

			$sql = "select id as card_id,cardtitle as title from cards ".$subquery." order by cardtitle asc";
			$query = $this->db->query($sql);
			$result = $query->result();
			foreach ($result as $key => $value) {
				
				$newresult['cards'][] = $value;
				$newresult['cards'][$key]->card_id = str_pad($value->card_id, 12, 0, STR_PAD_LEFT);
				$newresult['cards'][$key]->title = $value->title;
				$newresult['cards'][$key]->content = site_url('api/preview/'.$value->card_id);
			}

			return json_encode($newresult);
		}

		public function getCarddetails($cardid)
		{
			$sql = "select * from cards where id = '".$cardid."' ";
			$query = $this->db->query($sql);
			return $query->row();
		}

		public function getAcard($cardid)
		{
			$sql = "select cards.*,projects.hashtag from cards left join projects on cards.projectid = projects.id where cards.id = '".$cardid."' ";
			$query = $this->db->query($sql);
			$result = $query->row();
			$newresult = "";
			$newresult['session'] = 'active';
			$newresult['empty'] = 'yes';
			if($result)
			{
				$newresult['project_id'] = $result->projectid;
				$newresult['card_id'] = str_pad($result->id, 12, 0, STR_PAD_LEFT);
				$newresult['title'] = $result->cardtitle;
				$newresult['twittersearch'] = $result->hashtag;
				$newresult['content'] = site_url('api/preview/'.$result->id);
				$newresult['empty'] = 'no';
			}
			
			return json_encode($newresult);
		}

		public function trackCardview($cardId)
		{
			$sql = "update cards set cardviews = cardviews+1 where id = '".$cardId."' ";
			$this->db->query($sql);
		}


		public function getcardsforProject($projectid)
		{
			$sql1 = "select * from projects where id = '".$projectid."' ";
			$query1 = $this->db->query($sql1);
			$result1 = $query1->row();
			$newresult="";
			$newresult['session'] = 'active';
			$newresult['empty'] = 'yes';
			if($result1)
			{
				$newresult['project']['title'] = $result1->title;
				$newresult['project']['twittersearch'] = $result1->hashtag;
				$newresult['project']['description'] = $result1->description;
				$newresult['project']['project_id'] = $result1->id;
				$newresult['empty'] = 'no';
				$sql = "select * from cards where projectid = '".$projectid."' ";
				$query = $this->db->query($sql);
				$result = $query->result();
				foreach ($result as $key => $value) 
				{
					$newresult['cards'][$key]['card_id'] = str_pad($value->id, 12, 0, STR_PAD_LEFT);
					$newresult['cards'][$key]['title'] = $value->cardtitle;
					$newresult['cards'][$key]['content'] = site_url('api/preview/'.$value->id);
				}
			}
			
			return json_encode($newresult);
		}	


	function setHandshake($secretId)
	{
		$vaildAppSecret = $this->validateAppsecretid($secretId);
		if(!$secretId || !$vaildAppSecret)
		{
			return false;
		}
		$sessionid = $this->randomPassword();
		$datetime = date('Y-m-d H:i:s');
		$sql = "insert into apiauth (`appsecret`,`sessionid`,`datetime`) values ('".$secretId."','".$sessionid."','".$datetime."')";
		//$sql="update apiauth set sessionid = '".$sessionid."' where appsecret = '".$secretId."' ";
		$this->db->query($sql);
		$returnary['sessionid']= $sessionid;
		$returnary['status']= 'active';
		return json_encode($returnary);
	}

	function validateAppsecretid($secretId)
	{
		$sql = "select id from user where appsecret = '".$secretId."' and status = 1 ";
		$query = $this->db->query($sql);
		$result = $query->row();
		if($result)
		{
			return true;	
		}

		return false;
	}


	function randomPassword() {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 18; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	function validateApi($sessionid)
	{
		$sql = "select datetime from apiauth where sessionid = '".$sessionid."' ";
		$query = $this->db->query($sql);
		$result = $query->row();
		if($result)
		{
			$currenttime = date('Y-m-d H:i:s');
			if(strtotime('+1 day',strtotime($result->datetime)) < strtotime($currenttime))
			{
				return false;
			}

			return true;	
		}
		return false;
	}

}