<?php
Class M_Login extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }
    
    function save_userdetails($insert_data)
    {
        $this->db->insert($this->table, $insert_data);
        return $this->db->insert_id(); 
    }
    
    function check_value_in_db($fieldname,$value)
    {
        $this->db->where($fieldname, $value);
        $result = $this->db->get($this->table);
        $count=$result->num_rows();
        return $count;
    }
    function fetch_password($username)
    {
        $this->db->where(array('username'=>$username,'status '=>1));
        $result1 = $this->db->get($this->table);
        return $result1->result();

    }
    
    function validate_accesstoken($accesstoken,$userid)
    {
       
        $this->db->where(array('acces_token'=>$accesstoken,'id'=>$userid));
        $result1 = $this->db->get($this->table);
        return $result1->result();
        
    }
    function update_accesstoken($id,$random_app_key)
    {
        $data=array(
            'status'     =>'1',
            'appsecret'  =>$random_app_key,
            'acces_token' =>''       
                  );
        $this->db->where(array('id'=>$id));
        $this->db->update($this->table, $data);
        return $id;
    }
    
    function update_password($data)
    {
        
        $user_id=$data['id'];
        $new_password=$data['password'];
        $update_data=array(
                    'password' =>$new_password
             
                  );
        
        $this->db->where(array('id'=>$user_id));
        $this->db->update($this->table, $update_data);
        return $user_id;
    }
    
    function user_check_with_email($email)
    {
        $this->db->where(array('email'=>$email,'status '=>1));
        $result1 = $this->db->get($this->table);
        $count=$result1->num_rows();
        return $count;
    }
    
    function fetch_userdetails_from_email($email)
    {
        $this->db->where(array('email'=>$email,'status '=>1));
        $result1 = $this->db->get($this->table);
        return $result1->result();
       
    }
    
    function generate_appsecretkey($app_data)
    {
         $this->db->insert('apiauth', $app_data);
        return $this->db->insert_id(); 
    }
    
    
    
}