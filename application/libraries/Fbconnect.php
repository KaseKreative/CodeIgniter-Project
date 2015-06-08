<?php

define('FACEBOOK_SDK_V4_SRC_DIR', '/path/to/fb-php-sdk-v4/src/Facebook/');
require __DIR__ . '/path/to/facebook-php-sdk-v4/autoload.php';

class Fbconnect extends Facebook {

  public function Fbconnect(){

    $ci =& get_instance();

    $ci->config->load('facebook', true);

    $config = $ci->config->item('facebook');

  }

  public function send_back($val){
    return $val;
  }

  public function test(){
    $ci =& get_instance();

    $ci->load->helper('url');

    echo base_url();
  }
}

?>
