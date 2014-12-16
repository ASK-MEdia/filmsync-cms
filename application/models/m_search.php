<?php
Class M_Search extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'projects';
    }
   
    
    function getAllProjectsAndCards($limit=0,$offset=0,$projects=0,$cards=0,$keyword,$userid)
    {   
        
        $union_query='';
        if($keyword!=''){ 

        if(($projects==0&&$cards==0)||($projects==1&&$cards==1))  
            {
                $union_query="SELECT projects.id AS proId, projects.title AS protitle,  NULL  AS cardId,  NULL  AS cardtitle
                FROM ( `projects` )
                WHERE   projects.userid=$userid AND `projects`.`title`  LIKE  '%$keyword%'
                UNION  
                SELECT  projects.id  AS proId,  NULL  AS protitle, cards.id AS cardId, cards.cardtitle
                FROM ( `cards` )
                JOIN `projects` ON projects.id=cards.projectid 
                WHERE projects.userid=$userid AND `cards`.`cardtitle`   LIKE  '%$keyword%' LIMIT $offset,$limit";
             }
           
        elseif($projects==1&&$cards==0)
            {  
                $union_query ="SELECT projects.id AS proId, projects.title AS protitle
                FROM ( `projects` )
                WHERE   projects.userid=$userid AND `projects`.`title`  LIKE  '%$keyword%'LIMIT $offset,$limit";
            }
            
        elseif($projects==0&&$cards==1) 
            {
                $union_query ="SELECT  projects.id  AS proId, cards.id AS cardId, cards.cardtitle
                FROM ( `cards` )
                JOIN `projects` ON projects.id=cards.projectid 	
                WHERE  projects.userid=$userid AND `cards`.`cardtitle`  LIKE  '%$keyword%' LIMIT $offset,$limit";
            } 
           
        $result1=$this->db->query($union_query);
        return $result1->result(); 
      }
    }
     
    function count_all_search_result($projects,$cards,$keyword=NULL,$userid)
    {
         
        if($keyword!=''){ 
            
        if(($projects==1&&$cards==1)||($projects==0&&$cards==0)) 
        {
            $union_query="SELECT projects.id AS proId, projects.title AS protitle,  NULL  AS cardId,  NULL  AS cardtitle
            FROM ( `projects` )
            WHERE   projects.userid=$userid AND `projects`.`title`  LIKE  '%$keyword%'
            UNION  
            SELECT  NULL  AS proId,  NULL  AS protitle, cards.id AS cardId, cards.cardtitle
            FROM ( `cards` )
            JOIN `projects` ON projects.id=cards.projectid 
            WHERE projects.userid=$userid  AND `cards`.`cardtitle`   LIKE  '%$keyword%'";
        }
        elseif($projects==1&&$cards==0) 
        {
            
            $union_query ="SELECT projects.id AS proId, projects.title AS protitle
            FROM ( `projects` )
            WHERE   projects.userid=$userid AND `projects`.`title`  LIKE  '%$keyword%'";

        }
        elseif($projects==0&&$cards==1) 
        {
            $union_query ="SELECT  cards.id AS cardId, cards.cardtitle
            FROM ( `cards` )
            JOIN `projects` ON projects.id=cards.projectid 	
            WHERE  projects.userid=$userid AND `cards`.`cardtitle`  LIKE  '%$keyword%' ";
        }
           
       $result1=$this->db->query($union_query);
       return $result1->num_rows(); 
       }
    }
    
    
}