<?php

// Connexion à la base de données
require_once('bdd.php');
require_once('config.php');

$object = json_decode(file_get_contents('php://input'),true);

if ($_SERVER["REQUEST_METHOD"] == "POST"){


	$id = $object['id'];
	$start = $object['start'];
	$end = $object['end'];

	$sql = "UPDATE events SET  start = '$start', end = '$end' WHERE id = $id ";


	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 //print_r($bdd->errorInfo());
	 //die ('Erreur prepare');
	 $response->check = 0;
	}
	$sth = $query->execute();
	if ($sth == false) {
		$response->check = 0;
	 //print_r($query->errorInfo());
	 //die ('Erreur execute');
	}

}
//header('Location: '.$_SERVER['HTTP_REFERER']);
$response->check = 1;
echo json_encode($response);
exit();

?>
