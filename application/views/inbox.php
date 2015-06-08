<h1>Inbox</h1>
<?$this->load->library('facebook');
$usersID = $this->facebook->get_user_id();
$messages = $this->messages->getMessages($usersID);


// var_dump($messages);
$messagePieces = array();
foreach($messages as $key=>$val){
    $messagePieces[$key] = $val;
    // var_dump($messagePieces[$key]);
    // echo '<br><br>';		
    $accepted = $messagePieces[$key]->accepted;
  $messagePieces = array(
    "id" => $messagePieces[$key]->id,
    "traineeId"=> $messagePieces[$key]->traineeId,
    "trainerId"=> $messagePieces[$key]->trainerId,
    "user1"=> $messagePieces[$key]->user1,
    "user2"=> $messagePieces[$key]->user2,
    "messages"=> $messagePieces[$key]->message,
    "timestamp"=> $messagePieces[$key]->timestamp,
    "paymentAmount"=> $messagePieces[$key]->paymentAmount,
    "accepted"=> $accepted,
    "length" => sizeof($messagePieces)
  );
  
?>
<ul>
    <li>Trainee ID : <?=$messagePieces['traineeId']?></li>
    <li>Trainer ID : <?=$messagePieces['trainerId']?></li>
    <li>Trainee : <?=$messagePieces['user1']?></li>
    <li>Trainer : <?=$messagePieces['user2']?></li>
    <li>Payment Amount : $<?=$messagePieces['paymentAmount']?></li>
    <li>Time : <?=$messagePieces['timestamp']?></li>
    <li>Message : <?=$messagePieces['messages']?></li>
    <?if(!$accepted){?>
      <li><a class='button tiny' id='accept' href="http://localhost:8888/Project2ASL/ASLProject2/main/acceptTrainer?traineeId=<?=$messagePieces['traineeId']?>&trainerId=<?=$messagePieces['trainerId']?>&user1=<?=$messagePieces['user1']?>&user2=<?=$messagePieces['user2']?>&paymentAmount=<?=$messagePieces['paymentAmount']?>">Accept</a></li><?
    ?><li><a class='button tiny' href="http://localhost:8888/Project2ASL/ASLProject2/main/delete?id=<?=$messagePieces['id']?>">Delete</a></li><?
    } else {
    ?><li><a class='button tiny' href="http://localhost:8888/Project2ASL/ASLProject2/main/delete?id=<?=$messagePieces['id']?>">Delete</a></li><?
  
?></ul><?
  }
}?>