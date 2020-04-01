<?php
class DATA_Class 
{
// connessione privata passata output dal metodo get_conn()
private $conn;
// parametri per la connessione al database
private $servername = "localhost";
private $username = "root";
private $password = "";
public $dbname = "corso";
  
// funzione per la connessione a MySQL
public function __construct()
{
  // attenzione al carattere ` nel SQL 
  try {
    $this->conn = new PDO("mysql:host=$this->servername;$this->dbname",$this->username,$this->password);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->conn->exec("
    CREATE TABLE IF NOT EXISTS $this->dbname.`utenti` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `nome` varchar(255) NOT NULL,
      `cognome` varchar(255) NOT NULL,
      `email` varchar(255),
      `anno_nascita` year(4),
	  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
    ");
} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die();
}
  
} // end construct

public function get_conn() {
return $this->conn;
}
} // end class


// istanzio classe Iscrizioni che a sua volta istanzia classe DATA_Class 
  $data = new DATA_Class();
// dalla DATA_Class mi faccio restituire l'oggetto connessione 
  $db = $data->get_conn();

  try {
    $db->beginTransaction();
    $db->exec("INSERT INTO $data->dbname.utenti(nome, cognome) VALUES('nome1', 'cognome1') ");
    $db->exec("INSERT INTO $data->dbname.utenti(nome, cognome) VALUES('nome1', 'cognome1') ");
    $db->exec("INSERT INTO $data->dbname.utenti(nome, cognome) VALUES('nome2', 'cognome2') ");
    $db->commit();
} catch (PDOException $e) {
    $db->rollBack();
   echo $e->getMessage();
}

  ?>
  