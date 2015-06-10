<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function Index()
	{
		$this->home();
	}

	public function home()
	{

		$data = array();
		$data['sessionExist'] = $this->facebook->sessionExist();
		if($data['sessionExist']){
				redirect('http://localhost:8888/Project2ASL/ASLProject2/main/loggedmap');
		}
		$this->load->library('facebook');
		$login_url = $this->facebook->login_url();
		$data['login_url'] = $login_url;
		$this->load->view('view_header', $data);
		$this->load->view('home', $data);
		$this->load->view('footer');
	}

	public function Loggedmap()
	{
		$data = array();
		$this->load->model('get_db');
		$data['sessionExist'] = $this->facebook->sessionExist();
		$LL = array();
		$data['user'] = $this->facebook->get_user();
			foreach($data['user'] as $key=>$val) {
					$data[$key] = $val;
			}
			$user['facebookID'] = $data['id'];
			$LL['facebookID'] = $user['facebookID'];
			$LL['lat'] = 'null';
			$LL['long'] = 'null';
			$user['name'] = $data['name'];
			// Checking if the user is in the databse vv

			$userCheck = $this->get_db->userExist($user);
			// var_dump($userCheck);
			if(!$userCheck){
				$this->get_db->insertUser($user);
				$this->get_db->insertUserLL($LL);
				echo 'Inserted';
			}
		$this->load->library('googlemaps');
		$config = array();
		$config['center'] = 'Orlando, FL';
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		$trainer = $this->get_db->selectUserTrainer($user['facebookID']);
			if($trainer == 1){
			redirect('http://localhost:8888/Project2ASL/ASLProject2/main/trainerMap');
		} else {
		$this->load->view('view_mapHeader', $data);
		$this->load->view('map', $data);
		$this->load->view('footer');
	}
	}


	public function map()
	{
		$this->load->library('geoplugin');
		$ip = '72.238.70.235'; // This is changed in the Geoplugin page
		$geoPlugin = new geoPlugin();
		$geoPlugin->locate($ip);
		$lat = "{$geoPlugin->latitude}";
		$long = "{$geoPlugin->longitude}";
		// echo "Latitude : $lat";
		$data = array();
		$data['sessionExist'] = $this->facebook->sessionExist();
		$this->load->library('googlemaps');
		$config = array();
		$config['center'] = "$lat, $long";
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('view_mapHeader', $data);
		$this->load->view('map', $data);
		$this->load->view('footer');
	}

	public function GymSearch()
	{
		$this->load->library('facebook');
		$userID = $this->facebook->get_user_id();

		if(!$_POST['gymSearch']){
				redirect('http://localhost:8888/Project2ASL/ASLProject2/main/map');
		}
		$this->load->library('geoplugin');
		$this->load->library('curl');
		$this->load->library('googlemaps');
		$this->load->model('get_db');
		$data = array();
		$config = array();
		$marker = array();
		$ip = '72.238.70.235'; // This is changed in the Geoplugin page
		$geoPlugin = new geoPlugin();
		$geoPlugin->locate($ip);
		$lat = "{$geoPlugin->latitude}";
		$long = "{$geoPlugin->longitude}";
		$config['center'] = "$lat, $long";
		$config['zoom'] = 13;
		// $config['placesLocation'] = "$lat, $long";
		$config['placesType'] = 'gym';
		$config['placesRadius'] = 10000;
		// $config['placesName'] = $_POST['gymSearch'];
		$get_url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$lat,$long&radius=10000&types=gym&name=$_POST[gymSearch]&key=".$this->googlemaps->apiKey;
		// var_dump($get_url);
		$this->load->model('places');
		$placesInfo = $this->places->index($get_url);
		// var_dump($placesInfo);
		$x = 0;
		$this->load->model('html');
		$trainer = $this->get_db->selectUserTrainer($userID);
		foreach($placesInfo as $key=>$val){
				$coords[$x][$key] = $val;
				$coords[$x]['lat'] = $coords[$x][$x]['lat'];
				$coords[$x]['long'] = $coords[$x][$x]['long'];
				$coords[$x]['gymID'] = $coords[$x][$x]['gymId'];
				// echo '<br><br>';
				$htmlData = array(
						'gymID'=> $coords[$x]['gymID'],
						'gymSearch'=> $_POST['gymSearch'],
						'lat' => $coords[$x]['lat'],
						'long' => $coords[$x]['long']
				);
				$html = $this->html->index($htmlData);
				$marker['position'] = $coords[$x]['lat'].", ".$coords[$x]['long'];
				$marker['title'] = $_POST['gymSearch'];
				$marker['infowindow_content'] = "$html";
				$marker['onclick'] = "";
				$this->googlemaps->add_marker($marker);
				$x = $x+1;
			}
		// echo ($coords[0]['lat']);
		// echo ($coords[0]['long']);
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		$data['user'] = $this->facebook->get_user();
			foreach($data['user'] as $key=>$val) {
					$data[$key] = $val;
				}
			$data['sessionExist'] = $this->facebook->sessionExist();
				// echo $data['id'];
			$this->load->view('view_mapHeader', $data);
			$this->load->view('mapSearch', $data);
			$this->load->view('footer');
	}

	public function logout(){
	session_destroy();
	redirect('http://localhost:8888/Project2ASL/ASLProject2');
	}
	// TRAINER ROUTES --------------------------------------------------

	public function trainer(){
			$trainer = $_GET['trainer'];
			$this->load->model('trainer');
			$this->trainer->index($trainer);
			if($trainer == 1){
				redirect('http://localhost:8888/Project2ASL/ASLProject2/main/trainerMap');
			} else {
				redirect('http://localhost:8888/Project2ASL/ASLProject2/main/map');
			}
	}

	public function trainerMap(){
			$this->load->library('geoplugin');
			$ip = '72.238.70.235'; // This is changed in the Geoplugin page
			$geoPlugin = new geoPlugin();
			$geoPlugin->locate($ip);
			$lat = "{$geoPlugin->latitude}";
			$long = "{$geoPlugin->longitude}";
			// echo "Latitude : $lat";
			$data = array();
			$data['sessionExist'] = $this->facebook->sessionExist();
			$this->load->library('googlemaps');
			$config = array();
			$config['center'] = "$lat, $long";
			$this->googlemaps->initialize($config);
			$data['map'] = $this->googlemaps->create_map();
			$this->load->view('trainer_mapHeader', $data);
			$this->load->view('trainer_map', $data);
			$this->load->view('footer');
	}

	public function trainerSearch(){
			$this->load->library('facebook');
			$userID = $this->facebook->get_user_id();

			if(!$_POST['gymSearch']){
					redirect('http://localhost:8888/Project2ASL/ASLProject2/main/trainerMap');
			}
			$this->load->library('geoplugin');
			$this->load->library('curl');
			$this->load->library('googlemaps');
			$this->load->model('get_db');
			$data = array();
			$config = array();
			$marker = array();
			$ip = '72.238.70.235'; // This is changed in the Geoplugin page
			$geoPlugin = new geoPlugin();
			$geoPlugin->locate($ip);
			$lat = "{$geoPlugin->latitude}";
			$long = "{$geoPlugin->longitude}";
			$config['center'] = "$lat, $long";
			$config['zoom'] = 13;
			// $config['placesLocation'] = "$lat, $long";
			$config['placesType'] = 'gym';
			$config['placesRadius'] = 10000;
			// $config['placesName'] = $_POST['gymSearch'];
			$get_url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$lat,$long&radius=10000&types=gym&name=$_POST[gymSearch]&key=".$this->googlemaps->apiKey;
			// var_dump($get_url);
			$this->load->model('places');
			$placesInfo = $this->places->index($get_url);
			// var_dump($placesInfo);
			$x = 0;
			$this->load->model('html');
			$trainer = $this->get_db->selectUserTrainer($userID);
			foreach($placesInfo as $key=>$val){
					$coords[$x][$key] = $val;
					$coords[$x]['lat'] = $coords[$x][$x]['lat'];
					$coords[$x]['long'] = $coords[$x][$x]['long'];
					$coords[$x]['gymID'] = $coords[$x][$x]['gymId'];
					// echo '<br><br>';
					$gymData = array(
							'gymID'=> $coords[$x]['gymID'],
							'gymSearch'=> $_POST['gymSearch'],
							'lat' => $coords[$x]['lat'],
							'long' => $coords[$x]['long']
					);
					$html = $this->html->trainerMarker($gymData['gymID']);
					$marker['position'] = $coords[$x]['lat'].", ".$coords[$x]['long'];
					$marker['title'] = $_POST['gymSearch'];
					$marker['infowindow_content'] = "$html";
					$this->googlemaps->add_marker($marker);
					$x = $x+1;
				}
			// echo ($coords[0]['lat']);
			// echo ($coords[0]['long']);
			$this->googlemaps->initialize($config);
			$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();
			$data['user'] = $this->facebook->get_user();
				foreach($data['user'] as $key=>$val) {
						$data[$key] = $val;
					}
				$sess['sessionExist'] = $this->facebook->sessionExist();
				$sess['map'] = $data['map'];
					// echo $data['id'];
				$this->load->view('view_mapHeader', $sess);
				$this->load->view('mapSearch', $data);
				$this->load->view('footer');
	}

		public function traineeList(){
			$sess['sessionExist'] = $this->facebook->sessionExist();
			$this->load->view('trainer_header', $sess);
			$this->load->view('traineeList', $_POST);
			$this->load->view('footer');
		}


		public function inbox(){
		$this->load->model('messages');
		$sess['sessionExist'] = $this->facebook->sessionExist();

		$this->load->view('trainer_header', $sess);
		$this->load->view('inbox');
		$this->load->view('footer');
		}

		public function delete(){
			$id = $_GET['id'];
			$this->load->model('messages');
			$this->messages->delete($id);
			redirect('http://localhost:8888/Project2ASL/ASLProject2/main/inbox');
		}

		public function sendRequest(){
			$sess['sessionExist'] = $this->facebook->sessionExist();
			$_GET['usersID'] = $this->facebook->get_user_id();
			$this->load->view('trainer_header', $sess);
			$this->load->view('sendRequest', $_GET);
			$this->load->view('footer');
		}


		public function sendMail(){
		$_POST['user'] = $this->facebook->get_user_name();
		$_POST['userID'] = $this->facebook->get_user_id();
		// var_dump($_POST);
		$this->load->model('messages');
		$this->messages->sendMessage($_POST);
		redirect('http://localhost:8888/Project2ASL/ASLProject2/main/');
		}


		public function acceptTrainer(){
		// var_dump($_GET);
		$data = array(
			"traineeId" =>$_GET['traineeId'],
		  "trainerId" =>$_GET['trainerId'],
		  "user1" => $_GET['user1'],
		  "user2" => $_GET['user2'],
		  "message"=> "You Both have agreed to meet!",
		  "paymentAmount"=> $_GET['paymentAmount'],
			"accepted" => 1
		);
		$this->load->model('messages');
		$this->messages->acceptMessage($data);
		redirect('http://localhost:8888/Project2ASL/ASLProject2/main/inbox');
		}


	public function venmo(){
		$this->load->library('facebook');
		$userID = $this->facebook->get_user_id();
		// var_dump($_GET);
		$dbUpdate = array(
		'gymID' => $_GET['gymID'],
		'facebookID' => $userID,
		'timeIn' => $_GET['timeIn'],
		'timeOut' => $_GET['timeOut'],
		'paymentAmount' => $_GET['paymentAmount'],
		'lat' => $_GET['lat'],
		'long' => $_GET['long'],
		'weekDay'=> $_GET['weekDay']
 		);
		$quotes = array('"', '"');

		foreach($dbUpdate as $key=>$val){
			// echo $key .'<br>'. $val;
			$key = str_replace($quotes, "", "$key");
			$val = str_replace($quotes, "", "$val");
			// echo $key.' : '.$val.'<br>';
			$dbUpdate[$key] = $val;
		}
		$this->load->model('get_db');
		$this->get_db->insertTrainee($dbUpdate);
		redirect('https://api.venmo.com/v1/oauth/authorize?client_id=2649&scope=make_payments%20access_profile&response_type=token');
	}

	public function venmoTransaction(){
		$data = array();
		$this->load->library('facebook');
		$data['facebookID'] = $this->facebook->get_user_id();
		$data['code'] = $_GET[ 'access_token'];
		$this->load->model('venmo');
		$userData = $this->venmo->userData($data['code']);
		// var_dump($userData);
		$data['displayName'] = $userData['data']->user->display_name;
		$data['venmoId'] = $userData['data']->user->id;
		$this->venmo->venmoCode($data);
	}
}
