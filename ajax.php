<?php
SESSION_START();
include "isLogin.php";
include "dbconn.php";
include "sql.php";
$sql = new sql();
$array=array();
$rows=array();
$listnotif = $sql->listNotifUser($_SESSION['username']);
foreach ($listnotif[1] as $key) {
	$data['title'] = $key['title'];
	$data['msg'] = $key['notif_msg'];
	$data['icon'] = 'http://callmebeepus.world/avatar2.png';
	$data['url'] = 'http://callmebeepus.world/index.php';
	$rows[] = $data;
	// update notification database
	$nextime = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s'))+($key['notif_repeat']*60));
	$sql->updateNotif($key['id'],$nextime);
}
$array['notif'] = $rows;
$array['count'] = $listnotif[2];
$array['result'] = $listnotif[0];
echo json_encode($array);
?>