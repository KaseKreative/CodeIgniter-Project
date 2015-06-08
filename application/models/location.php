<?php

class Location extends CI_Model{


    public function placesAPI($lat, $lon, $name){

      $api = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$lat,$lon&radius=5000&types=gym&name=$name&key=AIzaSyD7NEW_IbFCg9CxlbsfP5wIrS-cP085uXo'

      return $api;
    }
}
?>
