<?php
function generaStringaRandom($length) {
	$caratteri = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$password = '';
	for ($i = 0; $i < $length; $i++) {
		$password .= $caratteri[rand(0, strlen($caratteri) - 1)];
	}
	return $password;
}


//I dati da inserire sono invece i seguenti:

$user1='user1';
$pass1= hash('sha256', generaStringaRandom(20));
$user2='user2';
$pass2= hash('sha256', generaStringaRandom(20));
$user3='user3';
$pass3= hash('sha256', generaStringaRandom(20));
$sql='insert into login (user, password) Values("'.$user1.'", "'.$pass1.'");';
$sql.='insert into login (user, password) Values("'.$user2.'", "'.$pass2.'");';
$sql.='insert into login (user, password) Values("'.$user3.'", "'.$pass3.'");';

?>