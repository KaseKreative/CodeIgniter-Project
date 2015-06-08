
<h1>Trainee List</h1>
<?
$ci =& get_instance();
$ci->load->model('get_db');
$ci->load->library('facebook');
$name = $ci->facebook->get_user_name();
$gymTrainees = $ci->get_db->selectGymTrainees($_POST['gymID']);

$trainees = array();
foreach($gymTrainees as $trainee){
  
  ?><ul><?
    $trainees = array(
    "gymID"=> $trainee->gymID,
    "facebookID"=> $trainee->facebookID,
    "timeIn"=> $trainee->timeIn,
    "timeOut"=> $trainee->timeOut,
    "paymentAmount"=> $trainee->paymentAmount,
    "lat" => $trainee->lat,
    "long"=> $trainee->long,
    "weekDay" => $trainee->weekDay,
    "name" => $name
    );
    
       ?>
        <li>Payment Amount : <?=$trainees['paymentAmount']?></li>
        <li>Name : <?=$trainees['name']?></li>
        <li>Time In : <?=$trainees['timeIn']?></li>
        <li>Time Out : <?=$trainees['timeOut']?></li>
        <li>Week Day : <?=$trainees['weekDay']?></li>
        <li><a href='sendRequest?facebookID=<?=$trainees["facebookID"]?>&name=<?=$trainees["name"]?>&timeOut=<?=$trainees['timeOut']?>&timeIn=<?=$trainees['timeIn']?>&paymentAmount=<?=$trainees['paymentAmount']?>' class='button tiny'>Message</a></li>
        <?
    
        ?></ul><?  
    
};

 

?>
