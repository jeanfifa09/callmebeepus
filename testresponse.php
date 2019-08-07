<?php
  include("config.php");

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $response = new \stdClass();

    $response->test = "we are testing";
    echo json_encode($response);

    exit();
  }
?>
