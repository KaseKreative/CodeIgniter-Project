<?php

class Get_db extends CI_Model{

    public function userExist($user){
        $query = $this->db->query("select name from users where facebookID = $user[facebookID]");
        $results = $query->result();
        $data = array();
        foreach($results as $key=>$val){
        $data[$key] = $val;
        }
        return $data;
    }
    
    public function insertUser($user){
        $this->db->insert('users', $user);
    }

    public function currentUser($user){
      $this->db->query("select * from users where facebookID = $user[facebookID]");
      $results = $query->result();
      foreach($results as $key=>$val){
          $data[$key] = $val;
      }
      return $data;
    }
    
    public function insertUserLL($user){
      $this->db->insert('LL', $user);
    }
    
    public function selectUserTrainer($user){
            $query = $this->db->query('select trainer from users where facebookID = '.$user.'');
            $results = $query->result();
            $results = $results[0]->trainer;
            return $results;
    }
    
    public function exists($data){
        if($this->db->query('select * from users where facebookID ='.$data["facebookID"]) != null){
        return 1;  
      } else {
          return 0;
      }
    }
    
    public function insertTrainee($user){
      $this->db->insert('gymTrainee', $user);
    }
    
    public function updateGymTrainee($user){
      $userID = $user['facebookID'];
      if(!$this->db->update('gymTrainee', $user, "facebookID = $user[facebookID]")){
        
      }
    }
    
    public function selectGymTrainees($gymID){
      $query = $this->db->query("select * from gymTrainee where gymID = '$gymID'");
      $results = $query->result();
      return $results;
      
    }
    
    public function updateUser($user){
      $this->db->update('users', $user, "facebookID = $user[facebookID]" );
    }
}

?>
