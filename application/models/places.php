
<?php

class Places extends CI_Model {

    public function index($data){
      $placesData = array();
      $space = array(" ");
      $url = str_replace($space, "%", "$data");
      $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.0');
			$response = curl_exec($ch);
			curl_close ($ch);
      $response = json_decode($response);
      $lat = array();
      $long = array();
      $latAndLong[0] = array(
        'lat'=> 'something', 'long'=> 'something', 'gymId'=>'anID'
      );
      $response = $response->results;
      // var_dump($response);
      for($x=0;$x<sizeof($response);$x++){
      $latLongGymId[$x] = array('lat' => $response[$x]->geometry->location->lat,
                              'long' => $response[$x]->geometry->location->lng,
                              'gymId' => $response[$x]->id);
      
      }
      return $latLongGymId;
      // foreach($latAndLong as $coords){
      //     var_dump($coords);
      //     echo '<br><br>'; 
      // }
  }
}
// ?>