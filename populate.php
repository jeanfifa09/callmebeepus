<?php
	//continue existing session
	session_start();
	// Assumes the input is JSON in the format of {"userID":"", "contactID":""}
	$inData = getRequestInfo();
	
	// Server info for connection
	$servername = "localhost";
	$dbUName = "Vicindy";
	$dbPwd = "Fun101";
	$dbName = "calendar";
	
	//$UserID = $inData["UserID"];
	
	$error_occurred = false;
	
	// Connect to database
	$conn = new mysqli($servername, $dbUName, $dbPwd, $dbName);
	if ($conn->connect_error){
		$error_occurred = true;
		returnWithError($conn->connect_error);
	}
	else{
		$sql = "SELECT color from notif WHERE id = '$UserID'";//making sure the contact is in the table
		$result = $conn->query($sql);
		//sendAsJSON($result);
		//Initialize array variable
		  //$dbdata = array();

		//Fetch into associative array
		//while ( $row = $result->fetch_assoc()) 
		//{
			//$dbdata[]=$row;
		//}
		  
		//Print array in JSON format
		echo json_encode($result);
		$conn->close();
		exit();
	}
	
	if (!$error_occurred){
		returnWithError("");
	}
	
	// Removes whitespace at the front and back, and removes single quotes and semi-colons

	// Parse JSON file input
	function getRequestInfo(){
		return json_decode(file_get_contents('php://input'), true);
	}
	
	function sendAsJSON($obj){
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendAsJson( $retValue );
		exit();
	}
	
?>