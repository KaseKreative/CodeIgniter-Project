
<body>

  <?php
    echo $map['html'];
  ?>
  
  <?php
  $inputInfo = array(
  'name'      => 'gymSearch',
  'id'        => 'gymSearchInput',
  'placeholder'     => 'LA Fitness',
  'maxlength' => '100'
  );
  $this->load->helper('form');
  ?><div class="row">
      <div class="small-10 small-centered columns"><?
          echo form_open('main/trainerSearch');
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
   