<?php

class Venmo extends CI_Model{

  function venmoCode($data){
    $exists = $this->db->query('select * from venmoCodes where facebookID ='.$data['facebookID']);
    if (!$exists){
      $this->db->insert('venmoCodes', $data);
    } else {
      $this->db->update('venmoCodes', $data);
    }
  }

  function getCode($id){
    $query = $this->db->query('select code from venmoCodes where facebookID ='.$id);
    $results = $query->result();
    return $results;
  }

  function userData($accessToken){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://api.venmo.com/v1/me?access_token='.$accessToken);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.0');
  $response = curl_exec($ch);
  curl_close ($ch);
  $response = json_decode($response);
  foreach($response as $key=>$val){

    $data[$key] = $val;
  }
  return $data;
}
}
?>
