# tremacoda
biblioteca

CREATE TABLE IF NOT EXISTS `login`( 
`id` int(5) NOT NULL AUTO_INCREMENT,
`user` VARCHAR(40) NOT NULL,
`password` VARCHAR(64) NOT NULL,
PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

// creazione della tabella per il login
$mysqli->query("CREATE TABLE `login`
                           ( `id` INT ( 5 ) NOT NULL AUTO_INCREMENT,
                             `user` VARCHAR(40) NOT NULL,
                             `password` VARCHAR(64) NOT NULL,
                             PRIMARY KEY (`id`))");
// creazione della tabella per i libri
$mysqli->query("CREATE TABLE `libri`
					       ( `id` INT(5) NOT NULL AUTO_INCREMENT,
                             `autore` VARCHAR(40) NOT NULL,
                             `titolo` TEXT NOT NULL,
					         `editore` VARCHAR(40) NOT NULL,
					         `anno` SMALLINT(2) NOT NULL,
					         PRIMARY KEY (`id`))");
// creazione della tabella per gli utenti
$mysqli->query("CREATE TABLE `utenti`
                           ( `id` INT(5) NOT NULL AUTO_INCREMENT ,
                             `nome` VARCHAR(30) NOT NULL ,
                             `cognome` VARCHAR(30) NOT NULL ,
                             `indirizzo` TEXT NOT NULL ,
                             `nascita` DATE NOT NULL ,
                             PRIMARY KEY (`id`))");
// creazione della tabella per i prestiti
$mysqli->query("CREATE TABLE `prestiti`
		                   ( `id` INT NOT NULL AUTO_INCREMENT ,
		                     `id_utente` INT NOT NULL ,
		                     `id_libro` INT NOT NULL ,
		                     `data` DATE NOT NULL ,
		                     `restituito` ENUM("0","1") NOT NULL ,
		                     PRIMARY KEY (`id`))");