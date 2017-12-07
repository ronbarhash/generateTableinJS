<?php
require_once "db.inc.php";

$db = new DB();
$client = $db->getData()[0];

?>
<html>
	<head>
		<title>тестовое задание</title>
		<script
			src="https://code.jquery.com/jquery-3.2.1.min.js"
			integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			crossorigin="anonymous">
		</script>
		<script src="data.js"></script>
	</head>
	<body>
		<form  id="form">
			<input type="text" name="search" >
			<input type="checkbox" name="work" id="">
			<input type="checkbox" name="connecting" id="">
			<input type="checkbox" name="disconnected" id="">
			<input type="submit" value="Search">
		</form>
		<span></span>
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