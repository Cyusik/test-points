<?php
if($_SESSION['names']) {
	if($_SESSION['role'] == 1) {
		$names = $_SESSION['names'];
		$role = $_SESSION['role'];
	} else {
		echo "Access is denied";
		exit;
	}
}
else {
	echo "Access is denied";
	exit;
}
?>