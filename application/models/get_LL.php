<?php
class Get_ll extends CI_Model {
    
    $data = array()
    $data['Lat'] = $_REQUEST['lat'];
    $data['Long'] = $_REQUEST['long'];
    $data['facebookID'] = $_REQUEST['id'];
    $this->db->update('LL', $data, "facebookID = $data[facebookID]" );
  
}
?>
