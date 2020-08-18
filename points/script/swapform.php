<?php
include_once 'connect.php';
$query = "SELECT * FROM formobmen WHERE `open`";
$link->set_charset("utf8");
$result = mysqli_query($link, $query);
if (isset($_POST['nicknames5']) && isset($_POST['login5'])  && isset($_POST['priz5'])){
	while($row = $result->fetch_assoc()) {
		$open = $row['open'];
		if($open == '1') {
			//$result->free();
			$nicknames5 = trim(mysqli_real_escape_string($link, $_POST['nicknames5']));
			//echo $nicknames5;
			$login5 = trim(mysqli_real_escape_string($link, $_POST['login5']));
			/*foreach($_POST['priz5'] as $k=>$m) {
				if (!empty($m)) {
					$mass[$k] = $m;
				}
			}*/
			$data = array();
			foreach($_POST['priz5'] as $item){
				$item = explode('|', $item);
				$data[$item[0]] = $item[1];
			}
			$priz5 = implode("\r",$data);
			echo $priz5;
			//$priz5 = implode("\r",$mass);
			$link->query("INSERT INTO zapisform (nickname,account,priz) VALUES ('$nicknames5','$login5','$priz5')");
			if($result) {
				echo "<table class='table_dark2'>
						<tr>
						<td>
						<b style='color:red; text-align:center; display:block;'>Заявка успешно отправлена!</b>
						</td>
						</tr>
						</table>";
				//$link ->close();
			} else {
				echo "<div class='block'><b style='color:red;'>Упс! К сожалению опрос уже закрыт.</b></div>";
				//$link ->close();
			}
		}
		else if($open == '2') {

			echo "<table class='table_dark2'>
						<tr>
						<td>
						<b style='color:red; text-align:center; display:block;'>К сожалению, на момент отправки, опрос был закрыт.<br>
						Заявка не отправлена.</b>
						</td>
						</tr>
						</table>
					<meta http-equiv=\"refresh\" content=\"5;url=swap.php\">";
			//$link ->close();
		}
		//
	}
	//$result->free();
}

?>

