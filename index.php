<?php
class DB {
    private $_db;

    public function __construct(){
        $this->_db = new mysqli("127.0.0.1", "root", "", "obj");
        if (!$this->_db) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        }
    }
//  `obj_customers`.`id_customer` = `obj_contracts`.`id_customer`,
//  ` obj_services`.`id_contract` = `obj_contracts`.`id_contract`.
    public function getData($params = ""){
		$query_string = "SELECT * FROM obj_contracts cont 
							JOIN obj_customers cust ON cust.id_customer = cont.id_customer
							JOIN obj_services serv ON serv.id_contract = cont.id_contract
							WHERE 1
						";
		if (!empty($params)) {
			$id = $params['id'];
			$query_string .= "AND cust.id_customer in ($id) LIMIT 1 ";
		}

		$query = $this->_db->query($query_string);

		$result = $query->fetch_all(MYSQLI_ASSOC);
		// echo "<pre>";print_r($query->fetch_all(MYSQLI_ASSOC)); exit;
		// while($row = $query->fetch_all(MYSQLI_ASSOC)){
		// 	echo $row['id_contract'],"<br>";
		// 	echo $row['date_sign'],"<br>";
		// }
		return $result;
	}

    public function __destruct(){
        mysqli_close($this->_db);
    }

}

$db = new DB();
$client = $db->getData(['id'=>1])[0];

?>
<html>
	<head>
		<title>тестовое задание</title>
	</head>
	<body>
		<table>
			<tr>
 				 <td colspan=2><b>информация про клиента</b></td>
 			 </tr>
 			 <tr>
 				 <td >название клиента</td>
				<td ><?php echo $client['name_customer']; ?></td>
 			 </tr>
 			 <tr>
 				 <td >компания</td>
 				<td ><?php echo $client['company']; ?></td>
 			 </tr>
 			 <tr>
 				 <td colspan=2><b>информация про договор</b></td>
 			 </tr>
			<tr>
 				 <td >номер договора</td>
 				<td ><?php echo $client['number']; ?></td>
 			 </tr>
 			 <tr>
 				 <td >дата подписания</td>
 				<td ><?php echo $client['date_sign']; ?></td>
 			 </tr>
 			 <tr>
 				 <td colspan=2><b>информация про сервисы</b></td>
 			 </tr>
 			 <tr>
 				 <td><?php echo $client['title_service']; ?></td>
				<!-- в services_name вывести название сервисов через <br> --> 
			</tr>
		</table>
	</body>
</html>