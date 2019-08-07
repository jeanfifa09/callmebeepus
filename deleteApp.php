<?php

//delete.php
// Include config file
require_once "config.php";
$object = json_decode(file_get_contents('php://input'),true);
if($_SERVER["REQUEST_METHOD"] == "POST")
{
 $connect = new PDO('mysql:host=localhost;dbname=calendar', 'Vicindy', 'Fun101');
 $query = "
 DELETE from notif WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $object['id']
  )
 );
}

?>
