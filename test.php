<?php
	
	require('./Ip.php');
	$obj = new Ip;
	$result1 = $obj->get_client_ip();
	$result2 = $obj->get_server_ip();
	echo $result1;
	echo $result2;
