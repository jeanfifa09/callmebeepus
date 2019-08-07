<?php
//Initialize the session
session_start();
// Connexion à la base de données
require_once('bdd.php');
//echo $_POST['title'];
if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
			$msg = $_POST['msg'];
			$time = $_POST['time'];
			$loop= $_POST['loops'];
			$loop_every=$_POST['loop_every'];
			$user = $_SESSION["username"];
			$title=$_POST['title'];
			$start = $_POST['start'];
			$end = $_POST['end'];
			$color = $_POST['color'];
	$sql = "INSERT INTO notif(notif_msg, notif_time, notif_repeat, notif_loop,username,title,start,end,color) values ('$msg', '$time', '$loop', '$loop_every','$user','$title','$start','$end','$color')";
	//$req = $bdd->prepare($sql);
	//$req->execute();
	
	echo $sql;
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
