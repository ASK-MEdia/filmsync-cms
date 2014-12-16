<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Nidhin N
 * Description: Projects model class
 */
class M_Projects extends CI_Model{
	
	public function saveProjects(){

		$userdetails = $this->session->userdata('user_data');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
        $hashtag = $this->input->post('hashtag');
		$url = $this->input->post('url');
             	$date = date('Y-m-d H:i:s');
		$sql="insert into projects (`userid`,`title`, `description`,`hashtag`, `url`, `date`) values 
		('".$userdetails['id']."','".mysql_real_escape_string($title)."','".mysql_real_escape_string($description)."','".mysql_real_escape_string($hashtag)."','".mysql_real_escape_string($url)."','".mysql_real_escape_string($date)."')";
		$query = $this->db->query($sql);
		$insertId = $this->db->insert_id();
                if(!empty($url))
                {
                    $thumbnail_image=$this->getThumbnailimage($this->input->post('url'),$insertId);
                }
                else 
                {
                    $thumbnail_image= 'no-image.png';
                }
                $update_sql="update projects set image_name='$thumbnail_image' where id=$insertId";
                $update_query = $this->db->query($update_sql);
		return $insertId;
	}
        public function getThumbnailimage($url,$insertId)
        {
            $parsed = parse_url($url);
            if (empty($parsed['scheme'])) 
            {
                $url = 'http://' . ltrim($url, '/');
            }
			
             $video_type=$this->get_video_type($url); 
            if($video_type!=0)
            {
                if($video_type==1)
                {                 
                  $thumbnail=$this->youtube_thumbnail_url($url);
                		    
                }
                else if($video_type==2)
                {                                      
                    $values = parse_url($url);
                    $url_path = explode('/',$values['path']);
                    $num = (count($url_path) - 1);
                    $videoid=$url_path[$num]; 
                    $xml ="http://vimeo.com/api/v2/video/".$videoid."/php";
                    if($this->get_http_response_code($xml) != "404")
                    {
                        $contents = file_get_contents($xml);
                        $array = unserialize(trim($contents));

                        if(!empty($array))
                        {
                         $thumbnail=$array[0]['thumbnail_small'];

                        }
                        else 
                        {             
                            $no_thumbnail=  'no-image.png';
                            return $no_thumbnail;
                        }
                    }  
                    else 
                    {             
                        $no_thumbnail=  'no-image.png';
                        return $no_thumbnail;
                    }
                }
                
                if($thumbnail!='')
                {                     
                    if($this->get_http_response_code($thumbnail) != "404"){
                    $time = time();
                    $imagename=basename($thumbnail);
                    $thumbnail_imagename ='img_'.$insertId.$time.$imagename;
                    $img = BASE_PATH.'images/thumbnail/'.$thumbnail_imagename;
                    file_put_contents($img,file_get_contents($thumbnail));
                   
                    }
                    else
                    {                        
                      $thumbnail_imagename= 'no-image.png';
                    }                   
                    return $thumbnail_imagename;
                }
                else 
                {           
                    $no_thumbnail= 'no-image.png';
                    return $no_thumbnail;
                }
            } 
            else
            {             
               $no_thumbnail=  'no-image.png';
               return $no_thumbnail;
            }
        }
     
        
        function get_http_response_code($url)
        {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
        }
        function youtube_thumbnail_url($url)
        {
            if(!filter_var($url, FILTER_VALIDATE_URL)){
            // URL is Not valid
            return false;
            }
            $domain=parse_url($url,PHP_URL_HOST);
            if($domain=='www.youtube.com' OR $domain=='youtube.com') // http://www.youtube.com/watch?v=t7rtVX0bcj8&feature=topvideos_film
            {
            if($querystring=parse_url($url,PHP_URL_QUERY))
            {   
            parse_str($querystring);
            if(!empty($v)) return "http://img.youtube.com/vi/$v/1.jpg";
            else return false;
            }
            else return false;

            }
            elseif($domain == 'youtu.be') // something like http://youtu.be/t7rtVX0bcj8
            {
            $v= str_replace('/','', parse_url($url, PHP_URL_PATH));
            return (empty($v)) ? false : "http://img.youtube.com/vi/$v/1.jpg" ;
            }

            else

            return false;
        }
        public function get_video_type($url)
        {
            $youtube_result=preg_match('/youtu\.be/i', $url) || preg_match('/youtube\.com\/watch/i', $url);
            if($youtube_result==1)
            {
                return 1;//reurn as youtube
            }
            else 
            {
                $vimeo_result=preg_match('/vimeo\.com/i', $url);
                if($vimeo_result==1)
                {                 
                  return 2;//return as vimeo
                } 
            }
            return 0;
        }
        

	public function getProjectdetails($pid='')
	{
		$sql = "select * from projects where id = '".$pid."' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function updateProjects($projectid){

		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$url = $this->input->post('url');
        $hashtag = $this->input->post('hashtag');
		$date = date('Y-m-d H:i:s');
                if(!empty($url))
                {
                    $thumbnail_image=$this->getThumbnailimage($this->input->post('url'),$projectid);
                }
                else 
                {
                    $thumbnail_image= 'no-image.png';
                }
               $sql = "update projects set `title` = '".mysql_real_escape_string($title)."',
		`description`='".mysql_real_escape_string($description)."',
        `hashtag`='".mysql_real_escape_string($hashtag)."',
		`url`='".mysql_real_escape_string($url)."',
		        `image_name`='".mysql_real_escape_string($thumbnail_image)."',
		`date` = '".$date."' where id='".$projectid."' ";
               	$query = $this->db->query($sql);
		return $projectid;
	}

	public function saveCard()
	{
		$cardtitle = $this->input->post('cardtitle');
		$stime = $this->input->post('stime');
		$content = $this->input->post('content');
		
		//exit;
		$projectid = $this->input->post('projectid');
		$date = date('Y-m-d H:i:s');

		$sql1 = "select id from cards where projectid = '".$projectid."' and ( time = '".$stime."' OR cardtitle = '".$cardtitle."')";
		$query1 = $this->db->query($sql1);
		$result = $query1->row();

		if($result)
		{
			return false;
		}

		$sql="insert into cards (`projectid`,`cardtitle`, `time`, `content`, `date`) values 
		('".$projectid."','".mysql_real_escape_string($cardtitle)."','".mysql_real_escape_string($stime)."','".mysql_real_escape_string(rawurldecode($content))."','".mysql_real_escape_string($date)."')";
		$query = $this->db->query($sql);
		$insertId = $this->db->insert_id();
		return $insertId;
	}

	public function getAllcards($pid)
	{
		$sql = "select * from cards where projectid = '".$pid."' order by time asc ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function generateMarker($cardId)
	{

		$numbers = str_split((string)$cardId);

		$str = BASE_PATH.'soundfiles/header.wav ';


		$prefixcount = 12 - count($numbers);
		$prefixArray="";
		if($prefixcount>0)
		{
			for ($i=0; $i < $prefixcount ; $i++) 
			{ 
				$prefixArray[] = 0;
			}
			
		}
		$mergedArray = array_merge($prefixArray,$numbers);

		$i=0;
		foreach ($mergedArray as $key => $value) 
		{

			$str .= BASE_PATH.'soundfiles/'.$value.'.wav ';

			if($i < count($mergedArray)-1 )
			{
				$str .= BASE_PATH.'soundfiles/spacer.wav ';
			}

			$i++;
		}
		$str .= BASE_PATH.'soundfiles/tail.wav ';

		$escapedcommand = escapeshellcmd('sox '.$str. BASE_PATH.'soundfiles/output/'.$cardId.'.wav');
		exec($escapedcommand);
	}



	public function downloadMarker($filename,$projectname,$cardname,$time)
	{ 
		$filename=$filename.'.wav';

		if(!file_exists(BASE_PATH.'soundfiles/output/'.$filename))
		{
			return 'failed';
		}

		$cuetime =str_replace(':','-', str_replace('.','-',$time));
		$cuetime = $time;
		$fname=$cuetime;

		header("Content-Type: application/force-download");
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename="'.$projectname.'_'.$fname.'_'.$cardname.'.wav"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		ob_clean();
		flush();
		readfile(BASE_PATH.'soundfiles/output/'.$filename);

	}

        public function downloadcards($projectid,$projecttitle)
        {          
            $this->db->select('id');
            $this->db->select('time');
            $this->db->select('cardtitle');
            $this->db->from('cards');
            $this->db->where('projectid', $projectid);     
            $result = $this->db->get();            
            $result1 = $result->result();    
                
            if(empty($result1))
            {
                $ref = $this->input->server('HTTP_REFERER', TRUE);
                redirect($ref, 'location');  
            }

            /*     new changes      */

                mkdir(BASE_PATH.'zip/'.$projectid);
                mkdir(BASE_PATH.'zip/'.$projectid.'/'.$projecttitle);
                foreach($result1 as $res)
                {  
                    if(file_exists(BASE_PATH.'soundfiles/output/'.$res->id.'.wav'))
                    {

                        $cuetime =str_replace(':','-', str_replace('.','-',$res->time));
                        $fname=$cuetime;    
                        $newcardname = $projecttitle.'_'.$fname.'_'.$res->cardtitle;
                        copy(BASE_PATH.'soundfiles/output/'.$res->id.'.wav',BASE_PATH.'zip/'.$projectid.'/'.$projecttitle.'/'.$newcardname.'.wav');
                    }
                    
                }
                
                $allfiles = scandir(BASE_PATH.'zip/'.$projectid.'/'.$projecttitle);
             /*     new changes      */

            $files=array();
            foreach($allfiles as $result)
            {  
                if($result!= '.' && $result!= '..')
                $files[].= BASE_PATH.'zip/'.$projectid.'/'.$projecttitle.'/'.$result;
            }

            $valid_files = array();
            foreach($files as $file) 
            {
                if(file_exists($file)) 
                {
                    $valid_files[] = $file;
                }
            }

            if(empty($valid_files))
            {
                $ref = $this->input->server('HTTP_REFERER', TRUE);
                redirect($ref, 'location');  
            }
            else
            {
                if(count($valid_files > 0))
                {
                    $zip = new ZipArchive();
                    $zipname1=urldecode($projecttitle).".zip";
                    $zip_name =BASE_PATH.'soundfiles/output/'. $projecttitle.".zip";
                    if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)
                    {
                        $error .= "* Sorry ZIP creation failed at this time";
                    }

                    foreach($valid_files as $file)
                    {
                        $local=  explode('/', $file);
                        $array_index= count($local);
                        $localname=$local[$array_index-1];
                        $zip->addFile($file,$localname);
                    }
                    $zip->close();
                    if(file_exists($zip_name))
                    {
                        // force to download the zip
                        header("Pragma: public");
                        header("Expires: 0");
                        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                        header("Cache-Control: private",false);
                        header('Content-type: application/zip');
                        header('Content-Disposition: attachment; filename="'.$zipname1.'"');
                        readfile($zip_name);
                        // remove zip file from temp path
                        unlink($zip_name);
                    }
                    exec('rm -rf '.BASE_PATH.'zip/'.$projectid.'/'.$projecttitle);


                } 
                else 
                {
                    echo "No valid files to zip";
                    exit;
                }
            }
        }

        public function getCarddetails($cardid)
	{
		$sql = "select * from cards where id = '".$cardid."' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function updateCard($cardid,$cardtitle,$stime,$content)
	{
		$date = date('Y-m-d H:i:s');
		$sql="update cards set `cardtitle` = '".mysql_real_escape_string($cardtitle)."' , 
		`time` = '".mysql_real_escape_string($stime)."' , 
		`content` = '".mysql_real_escape_string(rawurldecode($content))."' , 
		`date`  = '".$date."' where id = '".$cardid."' ";		
		$query = $this->db->query($sql);
	}

	public function deleteCard($cardid)
	{
		$sql = "delete from cards where id = '".$cardid."' ";
		$this->db->query($sql);
	}

    public function deleteProject($projectid)
    {
        $sql = "delete from projects where id = '".$projectid."' ";
        $this->db->query($sql);

        $sql = "select id from cards where projectid = '".$projectid."' ";
        $query = $this->db->query($sql);
        $result=$query->result();
        foreach ($result as $key => $value) 
        {
            unlink(BASE_PATH.'soundfiles/output/'.$value->id.'.wav');
        }

        $sql1 = "delete from cards where projectid = '".$projectid."' ";
        $this->db->query($sql1);
    }


}
