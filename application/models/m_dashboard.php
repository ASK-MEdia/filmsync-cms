<?php
Class M_Dashboard extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'projects';
    }
   
    
    
    function get_latest_projects($userid)
    {
        $this->db->select('projects.*');
        $this->db->from('projects');
         $this->db->where('userid', $userid);     
        $this->db->order_by('projects.date', 'desc');        
        $this->db->limit(6);
        $result = $this->db->get();
        $result1 = $result->result();
       
        $i=0;
        foreach($result1 as $result)
        {            
            $this->db->where('projectid', $result->id);
            $result = $this->db->get('cards');
            $resultcount1= $result->num_rows();
            $result1[$i]->card_count=$resultcount1;
            $i++;
          
        }
        
        return $result1; 
    }
    
    
    function get_all_projects($limit=0, $offset=0,$keyword,$userid)
    {
               
        $this->db->select('projects.*');
        $this->db->from('projects');
        $this->db->where('userid', $userid);
        if($keyword||$keyword!=0)
        {

         $this->db->like('projects.title', $keyword);
        }     
        $this->db->order_by('projects.date', 'desc');        
        if($limit>0)
        {
            $this->db->limit($limit, $offset);
        }
         
        $result = $this->db->get();
        $result1 = $result->result();
        
       $i=0;
        foreach($result1 as $result)
        {            
            $this->db->where('projectid', $result->id);
            $result = $this->db->get('cards');
            $resultcount1= $result->num_rows();
            $result1[$i]->card_count=$resultcount1;
            $i++;
          
        }
        return $result1; 
    }
    
    
     
    function count_all_user_projects($keyword=NULL,$userid)
    {
        $this->db->select('projects.*');
        $this->db->from('projects');
        $this->db->where('userid', $userid);
        if($keyword)
        {
          $this->db->like('projects.title', $keyword);
        }     
        $this->db->order_by('projects.date', 'desc');        
        
        $result = $this->db->get();
        return $result->num_rows(); 
      
    }
    
    function count_all_cards($userid)
    { 
        $this->db->select('cards.*');
        $this->db->from('cards');
        $this->db->join("projects", "projects.id=cards.projectid");
        $this->db->where('userid', $userid);
        $result = $this->db->get();
        return $result->num_rows(); 
    }

    function countCardViews($userid)
    { 
        $sql = "select SUM(cardviews) as views from cards left join projects on cards.projectid = projects.id where projects.userid = '".$userid."' ";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result->views;
    }

    function get_userdetails($userid)
    {
        $this->db->select('user.*');
        $this->db->where('user.id', $userid);
        $result = $this->db->get('user');
        $result1=$result->result();
        return $result1;
       
    }
    
    function update_profile_data($datas)
    {
        
            $data = array(
                'username'    =>$datas['username'],
                'organization'=>$datas['organization'],
                'profile_pic' => $datas['profile_pic']
                );

            $this->db->where('id', $datas['userid']);
            $this->db->update('user', $data); 
             return $datas['userid'];
    }
    function check_username_in_db($username,$userid)
    {
               
        $sql="SELECT * FROM (`user`)  WHERE username ='$username' AND id!=$userid";
        $query = $this->db->query($sql);
        $count=$query->num_rows();
        return $count;
    }
     
}