<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function Index()
	{
    echo "Hello World! This is the Profile";
		// $this->load->view('welcome_message');
	}
  
  public function uploads()
	{
    echo "Hello World! This is the Profile Uploads";
		// $this->load->view('welcome_message');
	}
}