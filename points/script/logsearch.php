<?php
if ($table != '' && $logresult != '') {
	$logsearchinsert = "INSERT INTO srh_usr_log (nickname, ip_user, usertable, result) VALUES ('$logsearch','$ip_search', '$table', '$logresult')";
	$logresultsearch = mysqli_query($link, $logsearchinsert) or die ('Error ' .mysqli_error($link));
}
?>