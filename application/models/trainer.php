<?php
class Trainer extends CI_Model {


    public function index($data){
      $this->load->library('facebook');
      $this->load->model('get_db');
      $trainer = $data;
      $userInfo = $this->facebook->get_user();
      $user = array();
      foreach($userInfo as $key=>$val){
        $user[$key] = $val;
      }
      $updatedUser = array(
        "name" => "$user[name]",
        "trainer" => "$trainer",
        "facebookID" => "$user[id]"
      );
      // var_dump($updatedUser);
      $this->get_db->updateUser($updatedUser);
      return 1;
      // var_dump($userInfo);
    }
}
?>