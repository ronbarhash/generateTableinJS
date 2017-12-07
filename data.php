<?php
require_once "db.inc.php";

$data = $_POST["id"];
$db = new DB();
$client = $db->getData(['id'=>$data])[0];
echo json_encode($client);