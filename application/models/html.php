<?php

class Html extends CI_Model{


public function index($data){
  $html = 
  '<div style="padding:5px;">'.
  '<h4>'.$data['gymSearch'].'</h4>'.
  '<form action="venmo?" method="GET">'.
  '<div>'.
    '<label">Time In : </label>'.
    '<input type="text" name="timeIn"  required="required" />'.
  '</div>'.
  '<div>'.
    '<label >Time Out : </label>'.
    '<input type="text" name="timeOut"" required="required" />'.
  '</div>'.
  '<div>'.
    '<label>Weekday : </label>'.
    '<select name="weekDay" required="required" />'.
    '<option value="Sunday">Sunday</option>'.
    '<option value="Monday">Monday</option>'.
    '<option value="Tuesday">Tuesday</option>'.
    '<option value="Wednesday">Wednesday</option>'.
    '<option value="Thursday">Thursday</option>'.
    '<option value="Friday">Friday</option>'.
    '<option value="Saturday">Saturday</option>'.
    '<select/>'.
  '</div>'.
  '<div>'.
    '<input type="hidden" name="gymID" value='.$data['gymID'].'" />'.
    '<input type="hidden" name="lat" value='.$data['lat'].'" />'.
    '<input type="hidden" name="long" value='.$data['long'].'" />'.
    '<label>Payment Amount : </label>'.
    '<input type="text" name="paymentAmount" />'.
  '</div>'.
    '<input type="submit" value="Proceed" class="button tiny" />'.
    '</form>'.
    '</div>'; 
  return $html;
}

  public function trainerMarker($gymID){
    $html =
    '<form action="traineeList" method="POST">'.
    '<input type="hidden" value="'.$gymID.'" name="gymID" />'.
    '<input type="submit" class="button tiny" value="View Trainees"/>'.
    '</form>';
    return $html;
  
  }
  
}

?>