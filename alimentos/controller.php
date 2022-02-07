<?php
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

//Passo 1: Receber as variáveis do formulário	
$ID						= $_REQUEST['codigo'];
$action 				= $_REQUEST['action'];

if($action<>'excluir'){

	$Nome					= $_POST['Nome'];
	$Porcao					= $_POST['Porcao'];
	$Calorias				= $_POST['Calorias'];
	$GrupoID				= $_POST['GrupoID'];
	$Proteinas				= $_POST['Proteinas'];
	$Carboidratos			= $_POST['Carboidratos'];
	$Lipideos				= $_POST['Lipideos'];
	$FibraAlimentar			= $_POST['FibraAlimentar'];
	$Acucar					= $_POST['Acucar'];
	$Calcio					= $_POST['Calcio'];
	$Colesterol				= $_POST['Colesterol'];
	$Ferro					= $_POST['Ferro'];
	$GordMonoinsaturada		= $_POST['GordMonoinsaturada'];
	$GordPoliInsaturada		= $_POST['GordPoliInsaturada'];
	$GordSaturada			= $_POST['GordSaturada'];
	$GordTrans				= $_POST['GordTrans'];
	$Fosforo				= $_POST['Fosforo'];
	$Magnesio				= $_POST['Magnesio'];
	$Manganes				= $_POST['Manganes'];
	$Potassio				= $_POST['Potassio'];
	$Selenio				= $_POST['Selenio'];
	$Sodio					= $_POST['Sodio'];
	$VitaminaA				= $_POST['VitaminaA'];
	$VitaminaB1				= $_POST['VitaminaB1'];
	$VitaminaB2				= $_POST['VitaminaB2'];
	$VitaminaB3				= $_POST['VitaminaB3'];
	$VitaminaB6				= $_POST['VitaminaB6'];
	$VitaminaB9				= $_POST['VitaminaB9'];
	$VitaminaB12			= $_POST['VitaminaB12'];
	$VitaminaC				= $_POST['VitaminaC'];
	$VitaminaD				= $_POST['VitaminaD'];
	$VitaminaE				= $_POST['VitaminaE'];
	$Zinco					= $_POST['Zinco'];
	$Cobre					= $_POST['Cobre'];


//Tratamento devido a mascara:

	$Porcao 				= str_replace(",", ".", $Porcao);
	$Calorias 				= str_replace(",", ".", $Calorias);
	$Proteinas 				= str_replace(",", ".", $Proteinas);
	$Carboidratos 			= str_replace(",", ".", $Carboidratos);
	$Lipideos 				= str_replace(",", ".", $Lipideos);
	$FibraAlimentar 		= str_replace(",", ".", $FibraAlimentar);
	$Acucar 				= str_replace(",", ".", $Acucar);
	$Calcio 				= str_replace(",", ".", $Calcio);
	$Colesterol 			= str_replace(",", ".", $Colesterol);
	$Ferro 					= str_replace(",", ".", $Ferro);
	$GordMonoinsaturada 	= str_replace(",", ".", $GordMonoinsaturada);
	$GordPoliInsaturada 	= str_replace(",", ".", $GordPoliInsaturada);
	$GordSaturada 			= str_replace(",", ".", $GordSaturada);
	$GordTrans 				= str_replace(",", ".", $GordTrans);
	$Fosforo 				= str_replace(",", ".", $Fosforo);
	$Magnesio 				= str_replace(",", ".", $Magnesio);
	$Manganes 				= str_replace(",", ".", $Manganes);
	$Potassio 				= str_replace(",", ".", $Potassio);
	$Selenio 				= str_replace(",", ".", $Selenio);
	$Sodio 					= str_replace(",", ".", $Sodio);
	$VitaminaA 				= str_replace(",", ".", $VitaminaA);
	$VitaminaB1 			= str_replace(",", ".", $VitaminaB1);
	$VitaminaB2 			= str_replace(",", ".", $VitaminaB2);
	$VitaminaB3 			= str_replace(",", ".", $VitaminaB3);
	$VitaminaB6 			= str_replace(",", ".", $VitaminaB6);
	$VitaminaB9 			= str_replace(",", ".", $VitaminaB9);
	$VitaminaB12 			= str_replace(",", ".", $VitaminaB12);
	$VitaminaC 				= str_replace(",", ".", $VitaminaC);
	$VitaminaD 				= str_replace(",", ".", $VitaminaD);
	$VitaminaE 				= str_replace(",", ".", $VitaminaE);
	$Zinco 					= str_replace(",", ".", $Zinco);
	$Cobre 					= str_replace(",", ".", $Cobre);


	if(!$Porcao)
		$Porcao= 0;

	if(!$Calorias)
		$Calorias= 0;

	if(!$GrupoID)
		$GrupoID= 0;

	if(!$Proteinas)
		$Proteinas= 0;

	if(!$Carboidratos)
		$Carboidratos= 0;

	if(!$Lipideos)
		$Lipideos= 0;

	if(!$FibraAlimentar)
		$FibraAlimentar= 0;

	if(!$Acucar)
		$Acucar= 0;

	if(!$Calcio)
		$Calcio= 0;

	if(!$Colesterol)
		$Colesterol= 0;

	if(!$Ferro)
		$Ferro= 0;

	if(!$GordMonoinsaturada)
		$GordMonoinsaturada= 0;

	if(!$GordPoliInsaturada)
		$GordPoliInsaturada= 0;

	if(!$GordSaturada)
		$GordSaturada= 0;

	if(!$GordTrans)
		$GordTrans= 0;

	if(!$Fosforo)
		$Fosforo= 0;

	if(!$Magnesio)
		$Magnesio= 0;

	if(!$Manganes)
		$Manganes= 0;

	if(!$Potassio)
		$Potassio= 0;

	if(!$Selenio)
		$Selenio= 0;

	if(!$Sodio)
		$Sodio= 0;

	if(!$VitaminaA)
		$VitaminaA= 0;

	if(!$VitaminaB1)
		$VitaminaB1= 0;

	if(!$VitaminaB2)
		$VitaminaB2= 0;

	if(!$VitaminaB3)
		$VitaminaB3= 0;

	if(!$VitaminaB6)
		$VitaminaB6= 0;

	if(!$VitaminaB9)
		$VitaminaB9= 0;

	if(!$VitaminaB12)
		$VitaminaB12= 0;

	if(!$VitaminaC)
		$VitaminaC= 0;

	if(!$VitaminaD)
		$VitaminaD= 0;

	if(!$VitaminaE)
		$VitaminaE= 0;

	if(!$Zinco)
		$Zinco= 0;

	if(!$Cobre)
		$Cobre= 0;
}


//Passo 2: Validacoes e tratamentos
$Erro = 0;

/*if (($Marca=="") and ($action<>'excluir')){
	$mensagemErro = "Marca não informada";
	$urlRedirecionamento = "cadastro.php?mensagemErro=$mensagemErro";
	$Erro = 1;	
}*/

if ($Erro==0)
{
	//Passo 2: Montar os mapeamentos
	switch ($action) {
		
			//query de insercao no banco de dados
		case 'inserir':
			$sql = "insert into alimentos (Nome, Porcao, Calorias, GrupoID, Proteinas, Carboidratos, Lipideos, FibraAlimentar, Acucar, Calcio, Colesterol, Ferro, GordMonoinsaturada, GordPoliInsaturada, GordSaturada, GordTrans, Fosforo, Magnesio, Manganes, Potassio, Selenio, Sodio, VitaminaA, VitaminaB1, VitaminaB2, VitaminaB3, VitaminaB6, VitaminaB9, VitaminaB12, VitaminaC, VitaminaD, VitaminaE, Zinco, Cobre) 
			values ('$Nome', $Porcao, $Calorias, $GrupoID, $Proteinas, $Carboidratos, $Lipideos, $FibraAlimentar, $Acucar, $Calcio, $Colesterol, $Ferro, $GordMonoinsaturada, $GordPoliInsaturada, $GordSaturada, $GordTrans, $Fosforo, $Magnesio, $Manganes, $Potassio, $Selenio, $Sodio, $VitaminaA, $VitaminaB1, $VitaminaB2, $VitaminaB3, $VitaminaB6, $VitaminaB9, $VitaminaB12, $VitaminaC, $VitaminaD, $VitaminaE, $Zinco, $Cobre)";
			$msg = "Cadastro efetuado com sucesso.";
			//$urlRedirecionamento = "cadastro.php?msg=$msg";
			// Após cadastrar alimento, sera redirecionado para area alimentos_medidas, não devemos retornar para o grid de alimentos.
			break;
			
			//query de atualização no banco de dados
		case 'alterar':
			$sql = "update alimentos set Nome='$Nome', Porcao='$Porcao', Calorias='$Calorias', GrupoID='$GrupoID', Proteinas='$Proteinas', Carboidratos='$Carboidratos', Lipideos='$Lipideos', FibraAlimentar='$FibraAlimentar', Acucar='$Acucar', Calcio='$Calcio', Colesterol='$Colesterol', Ferro='$Ferro', GordMonoinsaturada='$GordMonoinsaturada', GordPoliInsaturada='$GordPoliInsaturada', GordSaturada='$GordSaturada', GordTrans='$GordTrans', Fosforo='$Fosforo', Magnesio='$Magnesio', Manganes='$Manganes', Potassio='$Potassio', Selenio='$Selenio', Sodio='$Sodio', VitaminaA='$VitaminaA', VitaminaB1='$VitaminaB1', VitaminaB2='$VitaminaB2', VitaminaB3='$VitaminaB3', VitaminaB6='$VitaminaB6', VitaminaB9='$VitaminaB9', VitaminaB12='$VitaminaB12', VitaminaC='$VitaminaC', VitaminaD='$VitaminaD', VitaminaE='$VitaminaE', Zinco='$Zinco', Cobre='$Cobre' where ID=$ID";
			$urlRedirecionamento = "index.php";
			break;
			
			//query de exclusao no banco de dados
		case 'excluir':
			$sql = "delete from alimentos where ID=$ID";
			$urlRedirecionamento = "index.php";
			break;
	} 

	//Passo 4: Executar função responsavel por executar um query no banco "mysql_query"
	//echo $sql;
	$executarDB = mysql_query($sql);
}	

//Passo 5: Redirecionamento
if($action== "inserir"){
	// Redefinido o caminho de inclusão de alimentos para que seja possivel cadastrar a unidade em seguida da inclusão do alimento.
	$AlimentoID= mysql_insert_id();
	$urlRedirecionamento = "../alimentos_medidas/cadastro.php?codigoPai=$AlimentoID";
}

header("Location: $urlRedirecionamento");
?>
