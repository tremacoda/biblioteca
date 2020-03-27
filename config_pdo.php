<?php
class DATA_Class 
{
// connessione privata passata output dal metodo get_conn()
private $mysqli;
// parametri per la connessione al database
private $servername = "localhost";
private $username = "root";
private $password = "";
private $dbname = "registrazione";
  
// funzione per la connessione a MySQL
public function __construct()
{
  $mysqli = new mysqli('localhost', 'root', 'password');
  if ($mysqli->connect_error) {
    die('Errore di connessione (' . $mysqli->connect_errno . ') . $mysqli->connect_error);
  }
} // end construct

public function get_conn() {
return $this->mysqli;
}
} // end class


// istanzio classe Iscrizioni che a sua volta istanzia classe DATA_Class 
  $data = new DATA_Class();
// dalla DATA_Class mi faccio restituire l'oggetto connessione 
  $conn = $data->get_conn();
  //var_dump($conn);
   // Creo il database
   $conn->query("CREATE DATABASE biblioteca");
   // Seleziono il database
   $conn->query("USE biblioteca");

  ?>
  