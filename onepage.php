<?php

$mysqli = new mysqli('localhost', 'root', '', 'corso');
if ($mysqli->connect_error) {
    die('Errore di connessione (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
}

$azioniAmmesse = array('lista', 'dettaglio', 'form', 'salva', 'elimina');
$azione='';
if(isset($_REQUEST['azione'])) {
	$azione = $_REQUEST['azione'];
	if(!in_array($azione, $azioniAmmesse)){
		$azione='';
	}
}

switch ($azione) {
	case "salva":
		salva();
		$azione = 'lista';
		break;
	case "elimina":
		elimina();
		$azione = 'lista';
		break;
	}
	
switch ($azione) {
	case 'lista':
		$contenuto = lista();
		break;
	case 'form':
		$contenuto = form();
		break;
	case 'dettaglio':
		$contenuto = dettaglio();
		break;
	default:
		$contenuto = lista();
		break;
	}
	
function lista() {
	global $mysqli;
	$out='<table class="table">';
	$out.='<thead>';
	$out.='<tr><td><a href="'.$_SERVER['PHP_SELF'].'?azione=form">Inserisci nuovo</a></td></tr>';
	$out.='<tr><th>Id</th><th>Nome</th><th>Cognome</th><th>Email</th>';
	$out.='</thead>';
	$result = $mysqli->query("SELECT COUNT(*) FROM utenti");
	$row = $result->fetch_row();
	$tot_records = $row[0];
	
	$perpage = 10;
	$page = 1;
	if(isset($_GET['page'])){$page = filter_var($_GET['page'],FILTER_SANITIZE_NUMBER_INT);}
	$tot_pagine = ceil($tot_records/$perpage);
 	$pagina_corrente = $page;
	$primo = ($pagina_corrente-1)*$perpage;
	$sql = 'SELECT * FROM utenti ORDER BY id DESC LIMIT '.$primo.','.$perpage.' ';
	$result = $mysqli->query($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$out.='<tr>';
		$out.='<td>'.$row['id'].'</td>';
		$out.='<td>'.$row['nome'].'</td>';
		$out.='<td>'.$row['cognome'].'</td>';
		$out.='<td>'.$row['email'].'</td>';
		$out.='<td><a href="'.$_SERVER['PHP_SELF'].'?azione=dettaglio&id='.$row['id'].'"><span class="glyphicon glyphicon-zoom-in"></span></a></td>';
		$out.='<td><a href="'.$_SERVER['PHP_SELF'].'?azione=form&id='.$row['id'].'"><span class="glyphicon glyphicon-pencil"></span></a></td>';
		$out.='<td><a href="'.$_SERVER['PHP_SELF'].'?azione=elimina&id='.$row['id'].'"><span class="glyphicon glyphicon-remove"></span></a></td>';
		$out.='</tr>';
		}
		
	$out.='<tr><td colspan="7"><nav><ul class="pagination">';
	for($i=1; $i<=$tot_pagine; $i++)
	{
	$out .='<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a></li>';
	}
	$out .= "</ul></nav></td></tr>";
	 $out.='</table>';
return($out);
	}
	
function salva() {
	global $id, $mysqli;
	$nome = $_REQUEST["nome"];
	$cognome = $_REQUEST["cognome"];
	$email = $_REQUEST["email"];
	if($id==0){
		$sql = 'INSERT INTO utenti(nome, cognome, email) VALUES(?, ?, ?)';
		$result = $mysqli->prepare($sql);
		$result->bind_param('sss', $nome, $cognome, $email);
		$result->execute();
		}
	else{
		$sql = 'UPDATE utenti SET nome=?, cognome=?, email=? WHERE id=? LIMIT 1  ';
		$result = $mysqli->prepare($sql);
		$result->bind_param('sssi', $nome, $cognome, $email, $id);
		$result->execute();
		}
	}

function elimina() {
	global $id, $mysqli;
	$id=0;
	if(isset($_REQUEST['id'])){$id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);}
	$sql='DELETE FROM utenti WHERE id=? LIMIT 1  ';
	$result = $mysqli->prepare($sql);
	$result->bind_param('i', $id);
	$result->execute();
	}
	
function form() {
	global $id, $mysqli;
	$id=0;
	if(isset($_REQUEST['id'])){$id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);}
	$sql="SELECT * FROM utenti WHERE id=?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$result=$stmt->get_result();	
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$out='';
	$out.='<form name="info" action="'.$_SERVER['PHP_SELF'].'" method="post">';
	$out.='<input type="hidden" id="id" name="id" value="'.$id.'">';
	$out.='<input type="hidden" id="azione" name="azione" value="salva">';
	$out.='<label for="nome">Nome</label><br><input type="text" id="nome" name="nome" value="'.$row['nome'].'"><br />';
	$out.='<label for="cognome">Cognome</label><br><input type="text" id="cognome" name="cognome" value="'.$row['cognome'].'"><br />';
	$out.='<label for="email">Email</label><br><input type="email" id="email" name="email" value="'.$row['email'].'"><br />';
	$out.='<input type="submit" class="btn btn-success" value="Salva">';
	$out.='</form>';
	return($out);
	}	

function dettaglio() {
	global $id, $mysqli;
	$id=0;
	if(isset($_REQUEST['id'])){$id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);}
	$sql="SELECT * FROM utenti WHERE id=?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param('i', $id);
	if ($stmt->execute()){
		$result=$stmt->get_result();
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$out='<table class="table">';
		$out.='<thead>';
		$out.='<tr><th>Id</th><th>Nome</th><th>Cognome</th><th>Email</th>';
		$out.='</thead>';
		$out.='<tr>';
		$out.='<td>'.$row['id'].'</td>';
		$out.='<td>'.$row['nome'].'</td>';
		$out.='<td>'.$row['cognome'].'</td>';
		$out.='<td>'.$row['email'].'</td>';
		$out.='</tr>';
		$out.='</table>';
		return($out);
	} else {
		echo "0 results";
	};
	
	}		
	
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<?php echo $contenuto; ?>
</div>
</body>
</html>