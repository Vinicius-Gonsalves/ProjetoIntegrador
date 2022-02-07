<?php
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

//Passo 1: Receber as variáveis do formulário	
$ID	= $_REQUEST['codigo'];
$action = $_REQUEST['action'];

$Nome = trim($_POST['Nome']);
$Login = trim($_POST['Login']);
$Senha = $_POST['Senha'];


// Passo 1.5 Validacao de dados
$Erro = 0;

if (($Nome=="") and ($action<>"excluir")){
	$mensagemErro = "Nome não informado";
	$urlRedirecionamento = "cadastro.php?mensagemErro=$mensagemErro";
	$Erro = 1;
}

//Passo 2: Montar os mapeamentos
if ($Erro == 0){
	switch ($action) {
		
			//query de insercao no banco de dados
		case 'inserir':
			$sql = "insert into usuario (Nome,Login,Senha) 
			values ('$Nome','$Login','$Senha')";
			
			$msg = "Cadastro efetuado com sucesso.";
			$urlRedirecionamento = "cadastro.php?msg=$msg";
			break;
			
			//query de atualização no banco de dados
		case 'alterar':
		
			$sql = "update usuario set Nome='$Nome', Login='$Login' ,Senha='$Senha' where ID=$ID";
			$urlRedirecionamento = "index.php";
			break;
			
			//query de exclusao no banco de dados
		case 'excluir':
			$sql = "delete from usuario where ID=$ID";
			$msg = "Usuário removido.";
			$urlRedirecionamento = "index.php?msg=$msg";
			break;
	} 


	//Passo 3: Executar função responsavel por executar um query no banco "mysql_query"
	$executarDB = mysql_query($sql);
}

//Passo 4: Redirecionamento
header("Location: $urlRedirecionamento");
?>
