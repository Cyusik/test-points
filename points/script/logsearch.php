<?php
if ($table == 'points' && $logresult != '') {
	$logsearchinsert = "INSERT INTO logtablesearch (nickname, usertable, result) VALUES ('$logsearch', '$table', '$logresult')";
	$logresultsearch = mysqli_query($link, $logsearchinsert) or die ('Error ' .mysqli_error($link));
}
if ($table == 'results' && $logresult != '') {
	$logresultsinsert = "INSERT INTO logtablesearch (nickname, usertable, result) VALUES ('$logsearch', '$table', '$logresult')";
	$logresultres = mysqli_query($link, $logresultsinsert) or die ('Error ' .mysqli_error($link));
}
?>