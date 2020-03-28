<?php
class DATA_Class 
{
// connessione privata passata output dal metodo get_conn()
private $conn;
// parametri per la connessione al database
private $servername = "localhost";
private $username = "root";
private $password = "";
private $dbname = "biblioteca";
  
// funzione per la connessione a MySQL
public function __construct()
{
  $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
 
  /* check connection */
  if ($this->conn->connect_errno) {
  printf("Connect failed: %s\n", $this->conn->connect_error);
  exit();
}
  
} // end construct

public function get_conn() {
return $this->conn;
}
} // end class


// istanzio classe Iscrizioni che a sua volta istanzia classe DATA_Class 
  $data = new DATA_Class();
// dalla DATA_Class mi faccio restituire l'oggetto connessione 
  $mysqli = $data->get_conn();

// creazione della tabella per il login
  if ($mysqli->query("
  CREATE TABLE `login`( 
  `id` INT ( 5 ) NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(40) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`id`))") === TRUE) {
    printf("Table login successfully created.\n");
}
  
// creazione della tabella per i libri
  if ($mysqli->query("
  CREATE TABLE `libri`(
  `id` INT(5) NOT NULL AUTO_INCREMENT,
  `autore` VARCHAR(40) NOT NULL,
  `titolo` TEXT NOT NULL,
  `editore` VARCHAR(40) NOT NULL,
  `anno` SMALLINT(2) NOT NULL,
  PRIMARY KEY (`id`))") === TRUE) {
    printf("Table libri successfully created.\n");
}

// creazione della tabella per gli utenti
   if ($mysqli->query("
   CREATE TABLE `utenti`( 
     `id` INT(5) NOT NULL AUTO_INCREMENT ,
     `nome` VARCHAR(30) NOT NULL ,
     `cognome` VARCHAR(30) NOT NULL ,
     `indirizzo` TEXT NOT NULL ,
     `nascita` DATE NOT NULL ,
     PRIMARY KEY (`id`))") === TRUE) {
       printf("Table utenti successfully created.\n");
}

// creazione della tabella per i prestiti
  if ($mysqli->query("
  CREATE TABLE `prestiti`( 
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_utente` INT NOT NULL ,
  `id_libro` INT NOT NULL ,
  `data` DATE NOT NULL ,
  `restituito` ENUM('0','1') NOT NULL ,
  PRIMARY KEY (`id`))") === TRUE) {
       printf("Table prestiti successfully created.\n");
}


  ?>
  