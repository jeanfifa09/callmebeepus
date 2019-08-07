<?php
//Initialize the session
session_start();
// Connexion à la base de données
require_once('bdd.php');
require_once('config.php');
//echo $_POST['title'];
$object = json_decode(file_get_contents('php://input'),true);

if ($_SERVER["REQUEST_METHOD"] == "POST"){

			$response = new \stdClass();
			$msg = $object['msg'];
			$time = $object['time'];
			$loop= $object['loops'];
			$loop_every=$object['loop_every'];
			$user = $_SESSION["username"];
			$title=$object['title'];
			$start = $object['start'];
			$end = $object['end'];
			$color = $object['color'];
	$sql = "INSERT INTO notif(notif_msg, notif_time, notif_repeat, notif_loop,username,title,start,end,color) values ('$msg', '$time', '$loop', '$loop_every','$user','$title','$start','$end','$color')";
	//$req = $bdd->prepare($sql);
	//$req->execute();

	$query = $bdd->prepare( $sql );
	if ($query == false) {
		$response->check = 0;
		$response->sql = $sql;
		$response->query = $query;
	 //print_r($bdd->errorInfo());
	 //die ('Erreur prepare');
	}
	$sth = $query->execute();
	$response->sth = $sth;
	if ($sth == false) {
		$response->check = 2;
	 //print_r($query->errorInfo());
	 //die ('Erreur execute');
	}

}
//header('Location: '.$_SERVER['HTTP_REFERER']);
$response->check = 1;
echo json_encode($response);
exit();

?>
