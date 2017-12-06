<?php
session_start();
require "power/conecta.php";

//treat data
function trataValor($valor){
	$valor = trim($valor); 
	$valor = stripslashes($valor);
	$valor = htmlspecialchars($valor);	 
	return $valor; 
}

//define variables and set to empty values
$Dados = $btnConectar = $login = $pass = $name = $desc = $attach = $task_id = "";
$login = trataValor($_REQUEST["login"]);
//variables
$pass = trataValor($_REQUEST["pass"]);
$name = trataValor($_REQUEST["name"]);
$desc = trataValor($_REQUEST["desc"]);
$attach = $_FILES["attach"];
$delete_attach = $_REQUEST["delete_attach"];
$task_id = $_REQUEST["id"];
$btnConectar = $_REQUEST["btnConectar"];

//begin: auth
if( ! session_is_registered("conectado")){	
	session_register("conectado");
	$_SESSION["conectado"]=false;
	}
	if ( $_REQUEST["logout"]){
		$_SESSION["conectado"]=false;			
}

if ( isset($btnConectar) && $login && $pass) {	
	$consulta = "SELECT * FROM users where user_email='$login' and user_pass='$pass'";
	$resultConsulta = $conn->query($consulta);

	if($resultConsulta->num_rows != 0){	
		while ($row = $resultConsulta->fetch_array()) {
			if ($row["user_pass"] == $pass) {
				$_SESSION["conectado"] = $row["user_id"];
			}
		}
		$_REQUEST["Dados"] = "tasks";
	}else{		
		$_REQUEST["Dados"] = "error";
	}	
}
//end:auth


$Dados = $_REQUEST["Dados"];
switch($Dados){
	
	case "tasks":
		if($_SESSION["conectado"]){		
			if($name == "") $name = "não informado";
			if($desc == "") $desc = "não informado";			
			//begin create tasks
			if(isset($_REQUEST["btnCreate"])){
				$pasta_dir = "arquivos/";
				if(!file_exists($pasta_dir)){
				 mkdir($pasta_dir);
				}
				if($attach['name']  != ""){
					preg_match("/\.(gif|bmp|png|jpg|jpeg|docx|doc|xlsx|xls|pdf|txt){1}$/i", $attach['name'], $ext);
					$attach_name = time() . "." . $ext[1];					
					$copied = move_uploaded_file($_FILES['attach']['tmp_name'], $pasta_dir . $attach_name);
				}else{
					$attach_name = "não informado";
				}	
				$inserTask = "INSERT INTO tasks (task_id, user_id, task_name, task_desc, task_attach) VALUES(NULL, ".$_SESSION['conectado'].",'$name','$desc','$attach_name')";
				$conn->query($inserTask);
			}
			//end create tasks
			//begin edit tasks
			if(isset($_REQUEST["btnEdit"])){				
				if($attach['name']  != ""){
					preg_match("/\.(gif|bmp|png|jpg|jpeg|docx|doc|xlsx|xls|pdf|txt){1}$/i", $attach['name'], $ext);
					$delete_attach = time() . "." . $ext[1];					
					$copied = move_uploaded_file($_FILES['attach']['tmp_name'], $pasta_dir . $delete_attach);
				}else{
					$delete_attach;
				}	
				$udateTask = "UPDATE tasks SET task_name = '$name', task_desc = '$desc', task_attach = '$delete_attach' WHERE task_id = $task_id";
				$conn->query($udateTask);
			}
			//end edit tasks
			//begin delete tasks
			if ( isset($_REQUEST["btnDelete"])) {
				if($delete_attach  != ""){
					unlink("arquivos/".$delete_attach);
				}
				$deleteTask = "DELETE FROM tasks WHERE task_id = $task_id";
				$conn->query($deleteTask);
			}
			//end delete tasks
			$Dados = "tasks.php";
		}else{
			$_REQUEST["Dados"] = "error";
		}	
		break;

	case "create-task":
		if($_SESSION["conectado"]){		
			$Dados = "create-task.php";
		}else{
			$_REQUEST["Dados"] = "error";
		}	
		break;

	case "edit-task":
		if($_SESSION["conectado"]){		
			$Dados = "edit-task.php";
		}else{
			$_REQUEST["Dados"] = "error";
		}	
		break;

	case "error":		
		$Dados = "login-error.php";		
		break;

	default:
		if($_SESSION["conectado"]){		
			$Dados = "tasks.php";
		}else{
			$Dados = "login.php";
		}	

	    break;
}

?>