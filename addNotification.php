<?php
	//continue existing session
	session_start();
	

	$inData = getRequestInfo();
	
	$id = $_SESSION["id"];
	$username = $inData["username"];
	$title = $inData["title"];
	$start = $inData["start"];
	$end= $inData["end"];
	$notif_repeat = $inData["notif_repeat"];
	$notif_time = $inData["notif_time"];
	$publish_date = $inData["publish_date"];
	$color = $inData["color"];
	
    $error_occurred = false;
	$conn = new mysqli("localhost", "Vicindy", "Fun101", "calendar");
	if ($conn->connect_error) 
	{
		$error_occurred = true;
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$sql = "insert into notif (id,username, title, start, end, notif_repeat, notif_time,notif_msg,color)
			VALUES ('" . $id . "', '". $username . "', '" . $title . "', '" . $start . "', '". $end . "','" . $notif_repeat . "','" . $notif_time . "','" . $notif_msg . "','" . $color . "')";
		if( $result = $conn->query($sql) != TRUE )
		{
			$error_occurred = true;
			returnWithError( $conn->error );
		}
		$conn->close();
	}
	if(!$error_occurred){
	returnWithError("");
	}
	
	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
		exit();
	}
	
?>