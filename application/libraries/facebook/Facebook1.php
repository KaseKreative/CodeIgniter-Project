<?
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}

require_once( APPPATH . 'libraries/facebook/Facebook/autoload.php' );

use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class Facebook  {
var $ci;
var $helper;
var $session;
var $permissions;

public function __construct() {
  $this->ci =& get_instance();
  $appId = $this->ci->config->item('appID');
  $appSecret = $this->ci->config->item('appSecret');
  FacebookSession::setDefaultApplication($appId, $appSecret);
  var_dump($appId);
  var_dump($appSecret);
  $helper = new FacebookRedirectLoginHelper('/map');
  try {

    $session = $helper->getSessionFromRedirect();
  } catch(FacebookRequestException $ex) {
    var_dump('Error' . $ex);
  } if($session){
    var_dump('Logged In');
  }

  }
}
?>
