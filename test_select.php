<?php
$conn = new mysqli('localhost', 'root', '', 'corso');
if ($conn->connect_error) {
    die('Errore di connessione (' . $conn->connect_errno . ') '. $conn->connect_error);
}

$id=1;
//$sql='SELECT * FROM utenti WHERE id='.$id;
//$result = $conn->query($sql);


$sql="SELECT * FROM utenti WHERE id=1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$result=$stmt->execute();
if ($stmt->execute()) {
    $result=$stmt->get_Result();
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["nome"]. " " . $row["cognome"]." ".$row['email'];
    }
} else {
    echo "0 results";
}
$conn->close();
?>