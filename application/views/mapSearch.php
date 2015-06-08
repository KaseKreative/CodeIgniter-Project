
<script>
var ll = [''];
  function getLocation(){
    if(navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(coords);
    }
  }
  function coords(position){
    ll['lat'] = position.coords.latitude;
    ll['long'] = position.coords.longitude;
  }
  </script>
  
<?php
echo $map['html'];
?>
<?php
$inputInfo = array(
'name'      => 'gymSearch',
'id'        => 'gymSearchInput',
'class'     => '',
'placeholder'     => 'LA Fitness',
'maxlength' => '100'
);
?><div class="row">
    <div class="small-10 small-centered columns"><?
        echo form_open('main/gymSearch');
        echo form_input($inputInfo);
        
    ?></div>
  </div>
  <? $data = array(
    'name'        => 'submit',
    'id'          => 'gymSearchButton',
    'value'       => 'Search',
    'class'       => 'button expand');
  
  ?>
  <div class='row'>
    <div class='small-5 small-centered columns'><?echo form_submit($data);?></div>
  </div>

