<?php

class Messages extends CI_Model{

public function getMessages($facebookID){
  
  $query = $this->db->query("SELECT * FROM pm where traineeId = '$facebookID'");
  $data = array();
  foreach ($query->result() as $key=>$val){
  $data[$key] = $val;
  
  }
  return $data;
  
}

public function sendMessage($message){
  $paymentAmount = $message['paymentAmount'];
  $theMessage = array(
  "traineeId"=>$message['facebookID'],
  "trainerId"=>$message['userID'],
  "user1"=> $message['name'],
  "user2"=> $message['user'],
  "message"=> $message['messageContent'],
  "paymentAmount"=> $paymentAmount
  );
  $this->db->insert('pm', $theMessage);
  
}

public function acceptMessage($data){
  $this->db->insert('pm', $data);
  $data = array(
    "traineeId" =>$data['trainerId'],
    "trainerId" =>$data['traineeId'],
    "user1" => $data['user2'],
    "user2" => $data['user1'],
    "message"=> "You Both have agreed to meet!",
    "paymentAmount"=> $data['paymentAmount'],
    "accepted" => 1
  );
  // var_dump($data);
  $this->db->insert('pm', $data);
}

public function delete($id){
  $this->db->delete('pm', 'id = '.$id.'');
}

}
?>