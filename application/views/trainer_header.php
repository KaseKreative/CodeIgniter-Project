<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Gym Buddy</title>
  <link rel="stylesheet" href="<?=base_url()?>css/foundation.css" />
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/main.css" media="screen" />
  <script src="<?=base_url()?>js/vendor/modernizr.js"></script>
  <script src="<?=base_url()?>js/vendor/jquery.js"></script>  
  <script src="<?=base_url()?>js/foundation.min.js"></script>
  <style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0; padding: 0 }
  #map-canvas { height: 100% }
</style>
</head>
<body>
<script src="localhost:8888/Project2ASL/ASLProject2/js/foundation.min.js"></script>
  <nav class="top-bar" data-topbar role="navigation">
<ul class="title-area">
  <li class="name">
    <h1><a href="/Project2ASL/ASLProject2/main/">Gym Buddy</a></h1>
  </li>
   <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
  <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
</ul>

<section class="top-bar-section">
  <!-- Right Nav Section -->
  <ul class="right">
    <?php if($sessionExist) { ?>
    <li class=""><a href="/Project2ASL/ASLProject2/main/trainerMap">Map</a></li>
    <li class=""><a href="/Project2ASL/ASLProject2/main/inbox">Inbox</a></li>
    <li class=""><a href="/Project2ASL/ASLProject2/main/logout">logout</a></li>
    
    <li class="has-dropdown">
      
      <a href="#">Trainer or Trainee</a>
      <ul class="dropdown">
        <li><a href="/Project2ASL/ASLProject2/main/trainer?trainer=0">Trainee</a></li>
        <li><a href="/Project2ASL/ASLProject2/main/trainer?trainer=1">Trainer</a></li>
      </ul>
    </li>
  </ul>
  <? } ?>
</section>
</nav>
  


