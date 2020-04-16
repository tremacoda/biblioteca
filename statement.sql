CREATE TABLE `utenti`
                           ( `id` INT(5) NOT NULL AUTO_INCREMENT ,
                             `nome` VARCHAR(255) NOT NULL ,
                             `cognome` VARCHAR(255) NOT NULL ,
                             `email` VARCHAR(255) NOT NULL ,
                             PRIMARY KEY (`id`));
							 
							 
$sql = 'SELECT * FROM utenti ORDER BY id DESC LIMIT '.$primo.','.$perpage.' ';

$sql = 'INSERT INTO utenti(nome, cognome, email) VALUES(?, ?, ?)';
		$result = $mysqli->prepare($sql);
		$result->bind_param('sss', $nome, $cognome, $email);
		$result->execute();

$sql = 'UPDATE utenti SET nome=?, cognome=?, email=? WHERE id=? LIMIT 1  ';
		$result = $mysqli->prepare($sql);
		$result->bind_param('sssi', $nome, $cognome, $email, $id);
		$result->execute();

$sql="SELECT * FROM utenti WHERE id=?";

$sql='DELETE FROM utenti WHERE id=? LIMIT 1  ';
	$result = $mysqli->prepare($sql);
	$result->bind_param('i', $id);
	$result->execute();
