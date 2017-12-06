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
			$query_string .= "AND cust.id_customer in ($id) ";
		}

		$query = $this->_db->query($query_string);

		echo "<pre>";print_r($query->fetch_all(MYSQLI_ASSOC)); exit;
		while($row = $query->fetch_all()){
			echo $row['id_contract'],"<br>";
			echo $row['date_sign'],"<br>";
		}
	}

    public function __destruct(){
        mysqli_close($this->_db);
    }

}

$db = new DB();
$db->getData(['id'=>1]);

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
				<td >[name_customer]</td>
 			 </tr>
 			 <tr>
 				 <td >компания</td>
 				<td >[ company]</td>
 			 </tr>
 			 <tr>
 				 <td colspan=2><b>информация про договор</b></td>
 			 </tr>
			<tr>
 				 <td >номер договора</td>
 				<td >[ number]</td>
 			 </tr>
 			 <tr>
 				 <td >дата подписания</td>
 				<td >[ date_sign]</td>
 			 </tr>
 			 <tr>
 				 <td colspan=2><b>информация про сервисы</b></td>
 			 </tr>
 			 <tr>
 				 [services_name]
				<!-- в services_name вывести название сервисов через <br> --> 
			</tr>
		</table>
	</body>
</html>